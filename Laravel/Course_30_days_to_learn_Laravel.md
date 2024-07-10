# 30 Days to learn Laravel Course Notes

Relevant notes taken from [30 Days to Learn Laravel](https://laracasts.com/series/30-days-to-learn-laravel-11).

[Laravel documentation](https://laravel.com/docs/11.x).

## Components

Laravel allows creating reusable components, with the help of blade. The `components` folder should go inside `resources/views`. When using Blade, component and view files should have `.blade.php` extension.

In order to use PHP syntax inside HTML, double curly brackets can be used: `<p>{{$myText}}<p/>` is equivalent to `<p><?= $myText ?><p/>`.

For *children* objects inside the component, slots are used.


```php
// resources/views/components/layout.blade.php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
```


### Props vs Attributes

## Database Handling

### Models

Taken from [Lesson 7: Autoloading, Namespaces and Models](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/7).

Models are the representation in PHP objects of database records. They allow us to access record columns as it they were object attributes.

If `$user` is a Model object, then
```php
$user->name;
```
gives us the value of the `name` column for that entry.

To manually create a custom Model, create a class extending `Illuminate\Database\Eloquent\Model`. This provides an interface for fetching data from the database, such as `find`, `all` and others.

To create a custom Model using Laravel's tools, the command is:

```bash
php artisan make:model
```

which can include flags to create related controllers, factories, migrations, etc., as this is normally the introduction of a new concept or feature to the application. To see all options:

```bash
php artisan help make
```

### Migrations

Taken from [Lesson 8: Introduction to migrations](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/8).

[Laravel documentation for Migrations](https://laravel.com/docs/11.x/migrations).

Operations to be applied to the database: create new table, modify some columns, etc.

Main command to run after creating a new migration file is:

```bash
php artisan migrate
```

To create a new migration:

```bash
php artisan make:migration
```

Normally, the migrations will be created at the same time with models, factories, controllers, etc. So the command usually will be:

```bash
php artisan make:model -m # and other flags required
```

### Eloquent ORM

Taken from [Lesson 9: Meet Eloquent](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/9).

[Laravel Documentation for Eloquent ORM](https://laravel.com/docs/11.x/eloquent).

The Eloquent Object-Relation Mapping implements the mapping between database records and Model objects.

**Important**: Eloquent relies on *convention over configuration*. This means that if the name of the model is `User`, Eloquent will search in the database table `users` by default, which follow the convention on naming the tables with the plural form of the nouns and the models with singular form of the nouns. To modify this behavior we can override the value of the attribute `$table` in the, in this example, `User` model class.

#### Mass assignment protection

By default, Eloquent does not allow statements like:

```php
App\Models\Job::create(['title' => 'Acme Director', 'salary' => '$1,000,000' ])
```

It throws the `Illuminate\Database\Eloquent\MassAssignmentException`, which is a protection to unwanted assignments. For example, if a form's goal is to modify a post's title, and the user includes a hidden 'author_id' field, it could allow to modify that value too, which is not desired.

So, in order specify which columns can be assigned, their names should be included in the `$fillable` attribute of the model class.


```php
class Post extends Model {
    // ...
    protected $fillable = ['title'];
}
```

### Model factories

Taken from [Lesson 10: Model Factories](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/10).

[Laravel documentation for Elequent Factories](https://laravel.com/docs/11.x/eloquent-factories).

Factories are used to populate database with example data using the model's shape. This is useful for testing situations, or for preview format when creating components and layotus.

To allow a model to use factories, the `HasFactory` trait needs to be inserted to the class:

```php
class Post extends Model {
    use HasFactory;
    //...
}
```

[PHP Documentation on Traits](https://www.php.net/manual/en/language.oop5.traits.php).

The data to be created by the factory is defined in the `definition` method of the factory class. The data can be randomized with specific formats using [FakerPHP API](https://fakerphp.org/).

```php
class UserFactory extends Model {
    //...
    public function definition():array {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            //...
        ]
    }
}

// to use this factory:
User::factory()->create();
```

For specific state of some fields, new methods can be created:

```php
class UserFactory extends Model {
    use HasFactory;
    //...

    public function definition() //...

    public function unverified(): static {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ])
    }
// to create records with this state:
User::factory()->unverified()->create();
}
```

### Relationships

#### Foreign key

Taken from [Lesson 10: Model Factories](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/10).

[Laravel Documentation for]https://laravel.com/docs/5.0/eloquent#one-to-one

A foreign key can be specified in the migration file. For example, if a `Comment` is related to a `Post`, the comments table should have a foreign key to a post's record.

```php
// inside migration file
Schema::create('comments', function (Blueprint $table) {
    $table->id();
    $table->foreignIdFor(\App\Models\Post::class); // creates the 'post_id' column
    $table->string('title');
    $table->text('body');
    $table->timestamps();
});
```

In the model, in order to access its comment as an attribute, a **method** post should be created, in which the relationship is defined:

```php
class Comment extends Model {
    use HasFactory;
    //...
    public funcion post() {
        return $this->belongsTo(Post::class);
    }
}

// the post attribute can be accessed with:
App\Models\Comment::first()->post; //as an attribute!
```

In the *owner* class, the relationship in this case is `hasMany`, so the same process is done and all the comments can be retrieved with:

```php
class Post extends Model {
    use HasFactory;
    //...
    public funcion comments() {
        return $this->hasMany(Comment::class);
    }
}
App\Models\Post::first()->comments; //as an attribute!
```

### Database Seeders

Taken from [Lesson 15: Understanding Database Seeders](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/15).

Seeders are helper classes that populate the tables of the database. They may or may not use related factories.

Usually the seeders will be run after a fresh migration or for testing purposes.

To fresh migrate and re-seed:
```bash
php artisan migrate:fresh --seed
```

To run the default seeder:
```bash
php artisan db:seed
```

To create a seeder class:

```bash
php artisan make:seeder PostSeeder
```

To run a specific seeder:

```bash
php artisan db:seed --class PostSeeder
```


## Pivot Tables

Taken from [Lesson 12: Pivot Tables and BelongsToMany relationships](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/12).

[Laravel Documentation for Many-to-Many relationships](https://laravel.com/docs/5.0/eloquent#many-to-many).

A pivot table is a way to implement many to many relationships. They are auxiliar tables with two foreign keys, each one of them referring to their respective model table.

So, if a `Post` has many `Tag`s, but a `Tag` can be related to many `Post`s, so the pivot table relates them.

| id | post_id | tag_id |
|----|---------|--------|
| 1  | 5       | 8      |
| 2  | 7       | 8      |
| 3  | 5       | 2      |

Here, the `Post` with id of 5 has the tags with id 2 and 8, and the `Tag` with id of 8 is related to the posts with id 5 and 7, and so on.

To build this, the migration should include the pivot table creation, wich by convention is called with the names of both tables in their singular form. In this case: `post_tag`.

In most cases a pivot table's foreign keys should be constrained to be deleted on one of their references being deleted.

Inside the migration file:
```php
Schema::create('post_tag', function (Blueprint $table) {
    $table->id();
    $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
    $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```

Then, in order to access the tags of a `Post`:

```php
class Post extends Model {
    use HasFactory;

    //...

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}

// to use it:
App\Models\Post::first()->tags; // as attribute!
```

and viceversa:

```php
class Tag extends Model {
    use HasFactory;

    //...

    public function comments() {
        return $this->belongsToMany(Comment::class);
    }
}
// to use it:
App\Models\Tag::first()->comments; // as attribute!
```

To attach a `Tag` to a `Post`:

```php
$tag->jobs()->attach($job_id); //jobs as a method!!
```


## Tinker

Artisan's tinker tool allows to interactively execute PHP code. This can be used to test different things, including queries to the database through model objects and much more.

The command to get into this *interpreter* is:

```bash
php artisan tinker
```

Important: the tinker needs to be reloaded (i.e. closed and started again) when changes are made to the code.


## Eager Loading vs Lazy Loading

Taken from [Lesson 13: Eager Loading and the N+1 Problem](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/13).

By default Laravel loads data from database in *lazy mode*, which means that it would perform the query only when that data is required. This could take to performance issues when using relationships between models, as fetching, for example, all posts will only get the posts and not their comments, so for fetching the comments new queries should be made.

The opposite of this is *eager loading*, in which the first query specifies all the data that should be loaded. In this case, the idea is to load all comments with the posts objects.

To eager load a resource, instead of

```php
$posts = Post::all();
```

the statement should be

```php
$posts = Post::with('comments')->get();
```

To prevent lazy loading behavior, the `Model` class should be configured like that in App\Providers\AppServiceProvider.php's `boot` method:

```php

public function boot() {
    Model::preventLazyLoading();
}
```

In this case, the `Post:all()` call throws an error.

## Pagination

Taken from [Lesson 14: All You Need to Know About Pagination](https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/14).

[Laravel Documentation on Pagination](https://laravel.com/docs/11.x/pagination).

When datasets become bigger, its a good idea to display them in chunks, or *pages*. Laravel supports this natively. To get paginated data, instead of

```php
$posts = App\Models\Posts::get();
```

the call should be

```php
$posts = App\Models\Posts::paginate(10); //show 10 posts per page
```

To include the default page navigator, in the view:

```php
<div>
    {{ $posts->links() }}
</div>
```

It uses tailwind by default. To customize, the command

```bash
php artisan vendor:publish #selecting pagination option
```

will copy the pagination blade components to the project's views folder, so now they're accesible and fully customizable.

Therea are also another options: `simplePaginate` and `cursorPaginate`.


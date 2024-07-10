# 30 Days to learn Laravel Course Notes

Relevant notes taken from [30 Days to Learn Laravel](https://laracasts.com/series/30-days-to-learn-laravel-11).

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


## Tinker

Artisan's tinker tool allows to interactively execute PHP code. This can be used to test different things, including queries to the database through model objects and much more.

The command to get into this *interpreter* is:

```bash
php artisan tinker
```

Important: the tinker needs to be reloaded (i.e. closed and started again) when changes are made to the code.
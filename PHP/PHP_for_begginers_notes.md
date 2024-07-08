# PHP for Beginners Course Notes

Relevant notes taken from [PHP for Beginners](https://laracasts.com/series/php-for-beginners-2023-edition) free course and language reference pages.

These notes aim to complement basic syntax instructions which can be found easily in different documentation and tutorial pages, like [PHP Tutorial - GeeksForGeeks](https://www.geeksforgeeks.org/php-tutorial/).

## Shorthands for combining PHP and HTML code

### `echo` shorthand
Taken from [PHP: PHP Tags - Manual](https://www.php.net/manual/en/language.basic-syntax.phptags.php).

```php
<?php echo 'if you want to serve PHP code in XHTML or XML documents, use these tags'; ?>

You can use the short echo tag to <?= 'print this string' ?>.
It's equivalent to <?php echo 'print this string' ?>.
```

### Loops and conditionals shorthands
Taken from [Lesson 6: Arrays](https://laracasts.com/series/php-for-beginners-2023-edition/episodes/6).

Instead of writing

```php
<ul>
<?php foreach ($books as $book) {
    echo "<li><div> some complex html structure - $book</div></li>"
}
?>
</ul>
```

is cleaner to write
```php
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <div>
            some complex html structure - <?php $book>
            <br />or <br />
            some complex html structure - <?= $book> /* shorthand for echoing */
        </div>
    </li>
<php endforeach; ?>
?>
</ul>
```

## Anonymous functions

Unlike programming languages like Python and Javascript, that can take *normal* functions as another function parameter, PHP requires callable parameters to be *anonymous* function. Those are functions with no 'explicit' name.

```php
<?php
function myFunction() { // 'normal' function
    echo "Hello World!";
}

function callFunction($someFunction) {
    $someFunction();
}
callFunction(myFunction); /* Fatal error: Uncaught Error: Undefined constant "myFunction" */
callFunction($myFunction); /* Warning: Undefined variable $myFunction */ 
```

An example of anonymous function (aka: closure):

```php
function callFunction($someFunction) {
    $someFunction();
}

callFunction(function(){ echo 'Hello World!';});
```

Anonymous functions can be assigned to a variable. Since this is a statement, it should end with a semicolon.

```php
$myFunction = function(){ echo 'Hello World!';};
function callFunction($someFunction) {
    $someFunction();
}

callFunction($myFunction);
```

This could be used to add flexibility to an action, like filtering, and the filter function differs from case to case.

## PHP Core Functions

### `extract`

Taken from [Lesson 30: PHP Autoloading and Extraction](https://laracasts.com/series/php-for-beginners-2023-edition/episodes/30).

Converts entries from associative array into actual variables.

[PHP Documentation for `extract`](https://www.php.net/manual/en/function.extract.php).

Example:

```php
$var_array = array("color" => "blue",
                   "size"  => "medium",
                   "shape" => "sphere");
extract($var_array);

/*
equivalent to:
foreach ($var_array as $key => $value) {
    $$key = $value;
}
*/

// values are now accesible as variables
echo "$color, $size, $shape"; // output: blue, medium, sphere 
```

Useful when loading a view (within a function, for example) which requires some params. So params are passed as an associative array and the extract function converts all of the items into variables accesible from the view.

### `compact`

Does the opposite of `extract`. Creates an associative array from variables. The keys of the array are the names of the variables passed.

```php
$color = 'blue';
$size = 'medium';
$shape = 'sphere';
$var_array = compact($color, $size, $shape);

echo $var_array['color']; // output: blue
echo $var_array['size']; // output: medium
echo $var_array['shape']; // output: sphere
```

### `spl_autoload_register`

Taken from [Lesson 30: PHP Autoloading and Extraction](https://laracasts.com/series/php-for-beginners-2023-edition/episodes/30).

*SPL*: Standard PHP Library.

Allows creating a rule for loading classes that have not been included/required explicitly but have been referenced during execution.

[PHP Documentation for `spl_autoload_register`](https://www.php.net/manual/en/function.spl-autoload-register.php).

Example:
```php
spl_autoload_register(function ($class) {
    require "path/to/classes/dir/$class.php";
})

$db = new Database(); // Database.php has not been included yet. Triggers spl_autoload_register's callback.
```

## Namespaces

Used to group related classes, functions and variables.

The syntax is

```php
<?php
namespace MyNamespace;

// file content
```

which includes all file content inside `MyNamespace`. The syntax to refer to a namespace is with `\` (backslash):

```php
$myObj = MyNamespace\MyClass();
```

When using external names inside a file containing `namespace SomeNamespace`, we can refer to the 'absolute path', like `OtherNamespace\MyClass`. If the name does not belong to a specific namespace, we can consider that it belongs to the 'base' namespace, to which we can refer with `\`:

```php
<?php
namespace MyNamespace;

$obj = new \PDO(); // without the \, php will look for PDO class inside MyNamespace
```

To avoid repeatedly using this notation, we can call `use Namespace\Class` to allow direct use of `Class`. If the name does not belong to a specific namespace, the leading backslash can be removed.

```php
<?php
namespace MyNamespace;
use PDO;
use AnotherNamespace\MyClass;

$obj = new PDO();
$obj2 = new MyClass();
```

## PHP Sessions
Taken from [Lesson 37: PHP Sessions 101](https://laracasts.com/series/php-for-beginners-2023-edition/episodes/37).

A session is a way to store information (in variables) to be used across multiple pages.

To start a session the function `session_start` is used.

Session information can be stored to and read from superglobal `$_SESSION` variable.

On the server side, session information is saved to individual files, the default location for this file can be obtained from:

```bash
php --info | grep session.save_path
```

If this does not have a specific value, then the path is the default tmp dir, which can be read from

```bash
echo $TMPDIR
```
Normally session files start with `sess_`, followed by a unique identifier.

On the client side this unique identifier is saved as a cookie.
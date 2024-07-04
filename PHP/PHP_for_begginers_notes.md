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
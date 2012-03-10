# Bazinga! #

## About ##

Bazinga is a powerful and lightweight bootstrap class for PHP5.  
It helps you to load all necessary classes in scripts.  
Your feedback is always welcome.

## Requirements ##

- PHP 5.2.x or higher

## Quick Start ##

First include the Bazinga class: `require 'Bazinga.php';`

```php
<?php
    Bazinga::init(array(
      'config' => array(
        'mode' => 'AUTO',
        'path' => 'include/files/'
      ),
      'folder/*/*.php'
    ))->load();
    
    new Foo();
    new Bar();
?>
```

Then you are ready to start! Bazinga will load any other libraries for you.  
If you work in the `MANUAL` mode, you have to define all class paths in the `init` array.

### Details ###

If you like to set paths after initializing Bazinga, than make use of the `setPath()` method.  
It accepts single path patterns as a string or multiple in an array.  

To trigger the loading process, simply call the `load()` method.  
This can be done by using the Scope Operator or Method Chaining.

```php
<?php
    Bazinga::init(array(
      'config' => array(
        'mode' => 'MANUAL'
      )
    ));
    
    Bazinga::setPath('include/*.php');
    Bazinga::setPath(array(
      'scripts/*/foo.php',
      'bar.php'
    ));
    Bazinga::load();
?>
```

### Path patterns ###

The universal selector `*` allows you to select all files in a folder:  
- `foo/*.php` will select all PHP files in the directory `foo/`  
- `foo/*/bar.php` will search in all subfolders of `foo/` for files named `bar.php`

Of course it's also possible to define static file paths like: `path/to/file.php`

## Config ##

The whole configuration of Bazinga is done by the config array.

- `mode` can be:
  - `AUTO` *[default]* enables the auto class detection
  - `MANUAL` paths to the include files have to be defined manually
- `path` (only necessary in the AUTO mode) path to the directory where to search for classes

## Issues ##

Please submit issues through the [issue tracker](https://github.com/cosenary/Bazinga/issues) on GitHub. Your help is appreciated.

## History ##

**Bazinga 1.1 - 10/03/2012**

- `release` Second alpha version
- `feature` Now you can define static file paths
- `feature` Added `dirname` absolute directory path
- `change` Removed `strtolower` function 
- `bug` Autoloader static class bug

**Bazinga 1.0 - 06/01/2012**

- `release` First alpha version

**Bazinga 0.8 - 04/01/2012**

- `release` First internal alpha version
- `update` Made class static

**Bazinga 0.5 - 03/01/2012**

- `release` First internal alpha version
- `update` Small documentation

## Credits ##

Copyright (c) 2012 - Programmed by Christian Metz  
Released under the [BSD License](http://www.opensource.org/licenses/bsd-license.php).
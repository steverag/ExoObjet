<?php

function autoload($class) {
// $class gives the NameSpace path to the classes (with backslashes) => replace \ with / to get directory path=> access to class files
    $file = '../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('autoload');


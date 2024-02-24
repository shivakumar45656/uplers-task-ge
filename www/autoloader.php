<?php
spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    // echo $classFile;
    // Include the file
    if (file_exists($classFile)) {
        include_once $classFile;
    }
});

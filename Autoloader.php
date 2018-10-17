<?php

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    $file = getcwd() . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.php';

    if (!file_exists($file)) {
        throw new RuntimeException(sprintf(
            'Class with name "%s" was not found',
            $parts[count($parts) - 1]
        ));
    }

    require $file;
});
<?php

/**
 * Autoloader function to automatically include classes.
 * @throws Exception
 */

function autoloader($className): void
{
    $filename = strtolower($className) . ".php";
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        throw new Exception("File not found: " . $className . " (" . $filename . ")");
    }
}

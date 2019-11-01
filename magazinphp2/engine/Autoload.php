<?php

class Autoload
{
    public function loadClass($className) {
//        var_dump($className);
        $fileName = str_replace(['app', '\\'], [dirname(__DIR__), '/'], $className) . ".php";
//        var_dump($fileName);
        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}
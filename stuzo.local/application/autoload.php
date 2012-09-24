<?php
/* Include appropriate file by classname. */
function __autoload($class)
{
    $folders = explode("_", $class);
    $fullPath = (count($folders) == 1) ? "lib" . DS . implode(DS, $folders) . ".php"
        : "code" . DS . implode(DS, $folders) . ".php";
    include $fullPath;
}
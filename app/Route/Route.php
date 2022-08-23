<?php

namespace App\Route;

class Route
{

    public static function requestMethod($method)
    {
        return ($method == $_SERVER['REQUEST_METHOD']) ? true : false;
    }
}

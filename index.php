<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';
require_once 'route.php';

$urlRota = @$_GET["url"];
$urlArray1 = explode("/", $urlRota);

switch ($urlArray1[0]) {
    case '':
        require_once 'view_php/index.php';
        break;
    case 'newEmployee':
        require_once 'view_php/newEmployee.php';
        break;
    case 'listEmployees':
        require_once 'view_php/listEmployees.php';
        break;
    case 'requestEditEmployee':
        require_once 'view_php/newEmployee.php';
        break;   
}

try {
    $urlArray = explode("/", $urlRota);
    
    if (isset($rotas[$urlArray[0]])) {
        $rota = $rotas[$urlArray[0]];

        $segmentos = explode('\\', $rota);
        $classe = $segmentos[0] . "\\" . $segmentos[1] . "\\" . $segmentos[2] . "\\" . $segmentos[3];
    } else {
        require "view_php/error.html";
        die;
    }

    if (class_exists($classe)) {

        $classe = new $classe;
        $metodo = $segmentos[4];

        if (!method_exists($classe, $metodo)) :
            require "view_php/error.html";
            die;
        endif;
        $classe->$metodo($urlArray);
        die;
    } else {
        require "view_php/error.html";
        die;
    }
} catch (Exception $ex) {
    require "view_php/error.html";
}

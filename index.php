<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';
require_once 'route.php';

$urlRota = @$_GET["url"];
$urlArray1 = explode("/", $urlRota);

if (!routeView($urlArray1)) {
    try {
        $urlArray = explode("/", $urlRota);

        if (isset($rotas[$urlArray[0]])) {
            $rota = $rotas[$urlArray[0]];

            $segmentos = explode('\\', $rota);
            $classe = $segmentos[0] . "\\" . $segmentos[1] . "\\" . $segmentos[2] . "\\" . $segmentos[3];
        } else {
            throw new Exception('Rota não encontrada!');
        }

        if (class_exists($classe)) {

            $classe = new $classe;
            $metodo = $segmentos[4];

            if (!method_exists($classe, $metodo)) {
                throw new Exception('Método não encontrado!');
            } else {
                $classe->$metodo($urlArray);
                die;
            }
        } else {
            throw new Exception('Classe não encontrada!');           
        }
    } catch (Exception $ex) {
        $arrayReturn = [
            'message' => $ex->getMessage(),
            'statusCode' => $ex->getCode(),
            "result" => [],
            "error" => true,
        ];
        print json_encode($arrayReturn);
        die;      
    }
}

function routeView($urlArray1)
{
    $view = false;
    switch ($urlArray1[0]) {
        case '':
            $view = true;
            require_once 'view_php/index.php';
            break;
        case 'newEmployee':
            $view = true;
            require_once 'view_php/newEmployee.php';
            break;
        case 'listEmployees':
            $view = true;
            require_once 'view_php/listEmployees.php';
            break;
        case 'requestEditEmployee':
            $view = true;
            require_once 'view_php/newEmployee.php';
            break;
    }
    return $view;
}

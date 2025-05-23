<?php

session_start();
function redirect($url){
    echo "<script type='text/javascript'>"
        . "window.location.href='$url'"
        . "</script>";
}

function dd($var){
    echo "<pre>";
    die(print_r($var));
}

function getUrl($modulo, $controlador, $funcion, $parametros=false, $pagina=false){

    if($pagina == false){
        $pagina = "index";
    }

    $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

    if($parametros != false){
        foreach ($parametros as $key => $value) {
            $url.= "&$key=$value";
        }
    }
    return $url;
}

function resolve(){
    $modulo=ucwords($_GET["modulo"]);
    $controlador=ucwords($_GET["controlador"]);
    $funcion= $_GET["funcion"];
    if(is_dir("../controller/$modulo")){
        if(file_exists("../controller/$modulo/".$controlador."Controller.php")){
            include_once "../controller/$modulo/".$controlador."Controller.php";
            $nombreClase = $controlador."Controller";
            $objClase = new $nombreClase();
            if(method_exists($objClase,$funcion)){
                $objClase->$funcion();
            }else{
                echo "La funcion especificada no existe";
            }
        }else{
            echo "El controlador especificado no existe";
        }
    }else{
        echo "El modulo especificado no existe";
    }
}

function extractPost($datos){
    $post = [];
    foreach ($datos as $key => $value) {
        if (is_array($value)) {
            $post[$key] = $value;  // No sanitizar arrays, manejar después
        } else {
            $post[$key] = filter_input(INPUT_POST, "$key", FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
    return $post;
}

function extractGet($datos){
    $get = [];
    foreach ($datos as $key => $value) {
        $get[$key] = filter_input(INPUT_GET, "$key", FILTER_SANITIZE_SPECIAL_CHARS);
    }
    return $get;
}
?>
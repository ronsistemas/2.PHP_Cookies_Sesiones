<?php

require_once 'conf/ejercicio1.conf.inc.php';

//Valores por defecto para $archivo y $tipoMime
$archivo = "0.html";
$tipoMime = 'text/html';

//Verificación de los parámetros.
if (!empty($_GET) && isset($_GET['n']) && is_numeric($_GET['n']) &&
    array_key_exists ($_GET['n'],$array))
{    
    $archivo = $array[$_GET['n']]['archivo'];
    $tipoMime = $array[$_GET['n']]['tipoMime'];
}

//Establecemos la ruta completa al recurso
$fullPath=DATA_PATH.$archivo;

//Enviamos las cabeceras
header('Content-Type:'.$tipoMime);
header('Content-Length: ' . filesize($fullPath));

//Leemos el archivo
readfile($fullPath);

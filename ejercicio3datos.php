<?php
session_start();

require_once 'conf/ejercicio3.conf.inc.php';
require_once 'libs/util.inc.php';

$showData=false;

/* Paso 1: comprobamos si la sesión ha expirado. */
$timeStampError=true;
if (isset($_SESSION['timestamp']))
    $timeStampError=(time()-($_SESSION['timestamp']??0))>120;

/* El código anterior (3 líneas) se puede reemplazar por: 
    $timeStampError=(time()-($_SESSION['timestamp']??0))>120; */

/* Paso 2: Si la sesión no ha expirado, comprobamos si el usuario sigue siendo válido. */
if (!$timeStampError && isset($_SESSION['user']) ) {
        
    $username=$_SESSION['user'];
    /* Verificamos el nombre de usuario. Para hacer esto hay varias opciones: */                       
    $showData=!empty(buscarUsuario($username,$admins));
}        

/* Paso 3: Si el usuario no existe o la sesión ha expirado, borramos sesión y destruimos datos. */
if (!$showData) {
    session_destroy();
    header("Location: ejercicio3.php");
}

/* Paso 4: leemos el archivo y mostramos los datos.*/
if($showData):    

?>
    <H1>Bienvenido <?=$_SESSION['user']?></H1>
<?php


$dat=leerDatosCSV(DATA_PATH.DATA_FILE);    
if ($dat!=='')
{
    echo <<<DATA
        <table border="1" width="100%">
        <tr><th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
        <th>E-mail</th>
        <th>Cargo</th>
        <th>Compañia</th>
        </tr>
        
DATA;
    echo $dat;
    echo '</table>';
}

?>
    <a href="ejercicio3salir.php">Salir.</a><br>
<?php

endif;

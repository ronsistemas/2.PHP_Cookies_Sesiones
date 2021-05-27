<?php

require_once 'conf/ejercicio4.conf.inc.php';
require_once 'libs/util.inc.php';

session_start();

/* Inicializamos los datos de sesión si alguno no existe a los datos por defecto. */
if (empty($_SESSION))
{
    $_SESSION['next']=0;
    $_SESSION['data']=[];
}
else if (empty($_SESSION['data']))
{
    $_SESSION['data']=[];
}

if (!isset($_SESSION['next']))
{
    $_SESSION['next']=0;
}

$checkParams=false;

/* 
Se analiza el "paso" que se va a realizar: hacia adelante 'next', hacia atrás 'back' o limpiar el formulario 'clear'.
En función de eso, se actualiza $_SESSION['next'] para saber que hay que hacer. 
Nota: ten en cuenta que el paso inicial es 0, donde no se comprueba nada.
*/
if (isset($_POST['step'])) { //Si va el parámetro "step" es porque se avanza, retrocede o se vuelve al principio.
    if ( $_POST['step']==='back' && $_SESSION['next']>1 && $_SESSION['next']<4) { //Retroceder step==back
        $_SESSION['next']=$_SESSION['next']-1;
    }
    else if ($_POST['step']==='clear') { //Limpia el formulario para recomenzar.
        $_SESSION['next']=0;
        $_SESSION['data']=[];
    }
    else if ($_POST['step']==='forward') {
        $checkParams=true; //En esta situación nos limitamos a indicar si se deben comprobar los parámetros o no.
    }
}

$data=$_SESSION['data'];

?>
<!doctype html>
<HTML>
    <head>
    </head>
    <body>        
<?php
switch ($_SESSION['next'])
{
        case 0: //El proceso no se ha iniciado.
            $errors=[];            
            include(FORMS_PATH.'ejercicio4form_step1.php');
            $_SESSION['next']=1;
        break;
        case 1: //Vamos a analizar el nombre y los apellidos.             
                $errors=[];
                if ($checkParams)
                {
                    //Comprobar nombre
                    $data['nombre']=comprobar($_POST, $data, 'nombre',$errors);
                    //Comprobar apellidos
                    $data['apellidos']=comprobar($_POST, $data, 'apellidos',$errors);
                }
                
                if ($checkParams && empty($errors)) { //Si no hay errores, paso 2
                    $_SESSION['next']=2;
                    $_SESSION['data']=$data;
                    include(FORMS_PATH.'ejercicio4form_step2.php');
                }
                else  //Si hay errores, paso 1 
                {
                    include(FORMS_PATH.'ejercicio4form_step1.php');
                }
        break;
        case 2: //Vamos a comprobar el teléfono y el email
            $errors=[];
            if ($checkParams)
            {
                //Comprobar nombre
                $data['telefono']=comprobar($_POST, $data, 'telefono',$errors);
                //Comprobar apellidos
                $data['email']=comprobar($_POST, $data, 'email',$errors);
            }
            if ($checkParams && empty($errors)) {//Si no hay errores, paso 3
                $_SESSION['next']=3;
                $_SESSION['data']=$data;
                include(FORMS_PATH.'ejercicio4form_step3.php');
            }
            else //Si hay errores, paso 2
            {
                include(FORMS_PATH.'ejercicio4form_step2.php');
                
            }            
        break;
        case 3: //Vamos a comprobar el puesto y la empresa, y a guardar. A partir de aquí no se puede retroceder.
            $errors=[];
            if ($checkParams)
            {
                //Comprobar puesto
                $data['puesto']=comprobar($_POST, $data, 'puesto',$errors);
                //Comprobar apellidos
                $data['empresa']=comprobar($_POST, $data, 'empresa',$errors);
            }            
            if ($checkParams && empty($errors)) {//Si no hay errores, paso 4
                $_SESSION['next']=4;
                $_SESSION['data']=$data;
                $saved=guardarDatosCSV(DATA_PATH.DATA_FILE,$data);
                //Save data
                include(FORMS_PATH.'ejercicio4form_step4.php');
            }
            else //Si hay errores, paso 3
            {
                include(FORMS_PATH.'ejercicio4form_step3.php');                
            }            
        break;
        case 4:            
            include(FORMS_PATH.'ejercicio4form_step4.php');            
        break;
}
?>
</body>
</html>
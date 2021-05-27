<?php
session_start();

require_once 'libs/util.inc.php';
require_once 'conf/ejercicio3.conf.inc.php';
 
$errors=[];

//Si los datos de sesión no son válidos comprobamos si se envió el formulario
if (!isset($_SESSION['user']) || !isset($_SESSION['timestamp']) || time()-$_SESSION['timestamp']>120)
{
    // Comprobamos los datos de usuario y autenticamos
    if (!empty($_POST) && isset($_POST['user']) && isset($_POST['password'])) {

        //convertimos el nombre de usuario a minúsculas (no obligatorio)
        $username=strtolower(trim($_POST['user'])); //Variable temporal
        
        /* Verificamos el nombre de usuario. Para hacer esto hay varias opciones: */               
        $userData=buscarUsuario($username,$admins);
        
        if (empty($userData)) /* Verificamos si el usuario existe o no */
        {
            $errors['user']='El usuario no existe.';
        }
        else {             
            if ($userData['password']===$_POST['password']) /* Verificamos el password */
            {
                //Si el usuario existe y el password es correcto, establecemos la información de sesión
                $_SESSION['user']=$userData['user']; 
                $_SESSION['timestamp']=time();
            }
            else {
                $errors['password']='El password no es el correcto.';
            }
        }

        unset($userData); //Destruimos variables temporales
        unset($username); //Destruimos variables temporales
    }
}

$showForm=false;

/* Comprobamos la información de sesión
Nota: puede parecer redundante con respecto de la verificación del formulario, pero
ten en cuenta que después de verificar el formulario se establecen los datos de sesión
y aquí solo se determina si se debe mostrar o no el formulario. */
if (!isset($_SESSION['user']) || !isset($_SESSION['timestamp']))
{
    $showForm=true;
} 
else if (time()-$_SESSION['timestamp']>120)
{
    session_destroy();
    $errors['general']="La sesión ha caducado.";
    $showForm=true;
}


?>
<!doctype html>
<html>
    <head>
        <title>Ejercicio 03. Solución</title>
    </head>
    <body>
<?php
if($showForm):

    include 'forms/ejercicio3form.html';
    echo '<ul>';
    foreach ($errors as $key=>$value)
    {
        echo '<li>';
        echo "Error en '$key': $value";
        echo '</li>';
    }
    echo "</ul>";
else :
    ?>
    <a href="ejercicio3datos.php">Ver datos.</a>
<?php
endif;
?>
</body>
</html>
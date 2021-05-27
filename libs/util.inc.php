<?php

function buscarUsuario($username,$admins)
{
    /* 
        Opción a) La siguiente opción fuciona solo con php 7.4 o superior
        
          $r=array_filter($admins, fn($e) => $e['user']===$username);
          return array_pop($r)??[];

        Opción b) Las siguientes línea funciona desde 7.1:
    */    

        $r=array_filter($admins, function ($e) use ($username) {
            return $e['user']===$username;
        }); 
        return array_pop($r)??[];

    /*
        Opcion c) Recorremos el array con un bucle normal y salimos del mismo 
        cuando encontremos la fila.         

      
        $r=[];        
        for ($i=0; $i<count($admins) && !$r;$i++)
        {
            $r=$admins[$i]['user']===$username?$admins[$i]:[];
        }
        return $r;
        */
}

function leerDatosCSV($file)
{
    $str='';
    $fp = fopen($file, 'r');
    while (($fdat=fgetcsv($fp,1000,","))!==false)
    {                      
        $str.='<TR style="background:lightblue;">';        
        foreach($fdat as $dat)
        {
            $dat=htmlspecialchars(stripslashes($dat));
            $str.='<TD>'.$dat.'</TD>';
        }
        $str.='</TR>';
    }    
    fclose($fp);
    return $str;
}

function getCSV(string $csvPath){
    $arrayDatos = [];
    if (($gestor = fopen($csvPath, "r")) !== FALSE){
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE){
            $arrayDatos[] = $datos;
        }
        fclose($gestor);
    }
    return $arrayDatos;
}

function userWarning($errArray, $index)
{
    if (defined ('DATA_WARNING_FILE') &&
        defined ('DATA_PATH') &&
        isset($errArray[$index]))
    {
        $fileFullPath=DATA_PATH.DATA_WARNING_FILE;
        if (file_exists ($fileFullPath))
        {
            $fc=file_get_contents($fileFullPath);
            return str_replace('#TEXT#',$errArray[$index],$fc);
        }
    }
    return "";
}

function askAgain($errors, $data,$index)
{
    if (isset($data[$index]))
    {
        return stripslashes($data[$index]);
    }
}

function guardarDatosCSV($file, $data)
{
    $ret=false;
    $fp = fopen($file, 'a');
    if ($fp)
    {       
        if (fputcsv($fp, $data))
            $ret=true;   
        fclose($fp);
    }
    return $ret;
}

/**
 * Comprueba que la key $index exista en array 1 ($arr1) o array 2 ($arr2)
 * y que tenga una longitud mínima de 2 y máxima de 30.
 * Si existe, en uno de los dos (primero se comprueba $arr1 y después se comprueba $arr2)
 * retorna el valor con addslashes aplicado, en caso contrario, retorna null.
 */
function comprobar($arr1, $arr2, $index, &$errors)
{
    $val=$arr1[$index] ?? $arr2[$index] ?? null;
    if ($val===null) {
        $errors[$index] = "No se ha especificado el campo $index.";
    } 
    else if (strlen($val)<2 || strlen($val)>30)
    {
        $errors[$index] = "El campo $index debe tener una longitud entre 2 y 30 carácteres.";
    }
    else if (strpos($val, ',')!==false)
    {
        $errors[$index] = "El campo $index tiene el caracter ',' y no está permitido.";
    }
    else {
        return addslashes($val);
    }
    return null;
}
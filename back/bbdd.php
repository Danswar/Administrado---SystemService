<?php

$hostname_localhost ="localhost";
$database_localhost ="systembbdd";
$username_localhost ="root";
$password_localhost ="";

$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
mysqli_set_charset($conexion,"utf8");

//--
//--
//ejecutar una consulta
//devuelve false si no se pudo ejecurtar
//si es INSERT o UPDATE devuelve el id del registro
//si es SELECT devuelve los registros
function ejecutarConsulta($sql){
    global $conexion;
    $response = mysqli_query( $conexion , $sql);
    if(!$response){
        return false;
    }
    $tipo_sql = substr( $sql , 0 , 6); 
    if( $tipo_sql=="INSERT" || $tipo_sql=="UPDATE" ){
        return mysqli_insert_id( $conexion );
    
    }else{ 
       $datos =  mysqli_fetch_all($response, MYSQLI_ASSOC);

       if(count($datos)==1){
           return $datos[0];
       }else{
           return $datos;
       }
       
    }

}
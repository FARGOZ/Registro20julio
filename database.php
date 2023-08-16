<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'registro20julio';

try{
    $conexion = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
}catch (PDOException $error){
    die('Conexion fallida: '.$error->getMessage());
}

?>
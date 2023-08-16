<?php

session_start();

require 'database.php';

$resultados = [];
$mensaje = "";
$usuario = null; 

if (isset($_SESSION['user_id'])) {
    $consulta = $conexion->prepare('SELECT id, email, password FROM estudiantes WHERE id = :id');
    $consulta->bindParam(':id', $_SESSION['user_id']);
    $consulta->execute();
    $resultados = $consulta->fetch(PDO::FETCH_ASSOC);
}

    //validar el ingreso del usuario
    if(count($resultados) > 0){
        $usuario = $resultados;
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicativo 20 de Julio</title>
    <link rel="stylesheet" href="assets/estilos.css">
</head>
<body>
    <?php require 'partials/header.php'?>
    <!--Pantalla 1 SI ingreso-->

    <?php if(!empty($usuario)): ?>
        <b>Bienvenido .<?= $usuario['email']?></b>
        <b>Haz ingresado al aplicativo</b>
        <a href="cerrarsesion.php">Cerrar Sesión</a>
        <?php else: ?>
        
        <!--Pantalla 1 NO ingreso-->

        <h1>Aplicativo 20 de Julio</h1>
        <a href="login.php">Iniciar sesión</a> ó
        <a href="registro.php">Registrate</a>

        <?php endif; ?>  
</body>
</html>
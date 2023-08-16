<?php

session_start();

require 'database.php';

$resultados = [];
$mensaje = "";

//validar la informacion Tablas EMAIL.
if(!empty($_POST['email']) && !empty($_POST['password'])){
        $consulta = $conexion->prepare("SELECT id, email, password FROM estudiantes WHERE email= :email");
        $consulta->bindParam(':email', $_POST['email']);
        $consulta->execute();
        $resultados = $consulta->fetch(PDO::FETCH_ASSOC); 
}

//Valida el inicio sesión.
    if(count($resultados) > 0 && password_verify($_POST['password'],$resultados['password'])){
        $_SESSION['user_id'] = $resultados['id'];
        header('Location: /Registro20JULIO');
        exit();
    }else{
        $mensaje = "Lo sentimos, las credenciales no son correctas";
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/estilos.css">
</head>
<body>
    <?php require 'partials/header.php'?>

    <!--Mensaje de guardado-->
    <?php if(!empty($mensaje)):?>
        <p><?=$mensaje ?></p>
    <?php endif; ?>

    <h1>Iniciar sesión</h1>
    <form action="login.php" method="post">
        <input type="text" class="input" name="email" placeholder="Ingrese su correo">
        <input type="password" class="input" name="password" placeholder="Ingrese su contraseña">
        <input type="submit" class="boton" value="Enviar">
    </form>

</body>
</html>
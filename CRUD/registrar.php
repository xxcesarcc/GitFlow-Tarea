<?php
    if(empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApellidos"]) || empty($_POST["txtEmail"])){
        header('Location: index.php?mensaje=falta');
        exit();
    }

    include_once 'model/conexion.php';
    $nombre = $_POST["txtNombres"];
    $apellido = $_POST["txtApellidos"];
    $email = $_POST["txtEmail"];
    
    $sentencia = $bd->prepare("INSERT INTO persona(nombres,apellidos,email) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre,$apellido,$email]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>
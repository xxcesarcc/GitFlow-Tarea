<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombres = $_POST['txtNombres'];
    $apellidos = $_POST['txtApellidos'];
    $email = $_POST['txtEmail'];

    $sentencia = $bd->prepare("UPDATE persona SET nombres = ?, apellidos = ?, email = ? where codigo = ?;");
    $resultado = $sentencia->execute([$nombres, $apellidos, $email, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }
    
?>
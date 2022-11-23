<?php 

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])) {

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    $errors = array();

    if(empty($nombre)) {
        $errors[] = 'El Campo Nombre es Obligatorio';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'La Dirrecion de Correo Electronico No es Valida';
    }

    if(empty($asunto)) {
        $errors[] = 'El Campo Asunto es Obligatorio';
    }

    if(empty($mensaje)) {
        $errors[] = 'El Campo Mensaje es Obligatorio';
    }

    if(count($errors) == 0) {

        $msj = "De: $nombre <a herf='mailto:$email'>$email</a><br>";
        $msj .= "Asunto: $asunto<br><br>";
        $msj .= "Cuerpo del Mensaje:";
        $msj .= '<p>'.$mensaje.'</p>';

        $mail = new PHPMailer(true);

        try{
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com.';
            $mail->SMTPAuth = true;
            $mail->Username = 'segundoparcial20210672@outlook.com';
            $mail->Password = '2parcial20210672';
            $mail->SMTPSecure = 'TLS';
            $mail->Port = 587;

            $mail->setFrom('segundoparcial20210672@outlook.com', 'Contacto');
            $mail->addAddress('segundoparcial20210672@outlook.com');

            $mail->isHTML(true);
            $mail->Subject = 'Formulario de Contacto';
            $mail->Body = $msj;

            $mail->send();

            $respuesta = 'Correo Enviado';
        } catch(Exception $e) {
            $respuesta = 'Mensaje' . $mail->ErrorInfo;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <div class="container py-3">
            <header class="mb-4 border-bottom">
                <h1>Nuevo Email</h1>
            </header>

            <?php
            if(isset($errors)) {
                if(count($errors) > 0){
            ?>

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="alert alert-danger alert-dimissible" role="alert">

                        <?php
                        foreach ($errors as $error) {
                            echo $error.'<br>';
                        }

                        ?>

                    </div>
                </div>
            </div>

            <?php
                }
            }
            ?>


            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" class="form" method="POST" autocomplete="off">

                        <div class="mb-3">
                            <label for="nombre" class="form-label"> Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label"> Correo Electronico:</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="asunto" class="form-label"> Asunto:</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>

                        <div class="mb-3">
                            <label for="mensaje" class="form-label"> Mensaje:</label>
                            <textarea class="form-control" name="mensaje" id="mensaje" rows="3" placeholder="Digite el mensaje aqui: " required></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                        <a input class="btn btn-primary " href="index.php" role="button">Inicio</a>
                    </form>
                </div>
            </div>
            <?php if(isset($respuesta)) { ?>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <?php echo $respuesta ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
</body>
</html>
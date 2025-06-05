<?php
include_once '../connectDB/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Procesar Alta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php
            $user = recogerValor("user");
            $pass = recogerValor("pass");
            $nombre = recogerValor("firstName");
            $apellidos = recogerValor("lastName");
            $email = recogerValor("email");
            $prefijoPais = recogerValor("countryCode");
            $telefono = recogerValor("phone");

            if ($nombre != "" && $apellidos != "" && $email != "" && $prefijoPais != "" && $telefono != "" && $user != "" && $pass != "") {
                if (usuarioExiste($user)) {
                    session_start();
                    $_SESSION['registro_error'] = "ERROR: El usuario ya existe";
                    echo "<script>window.location.href = 'registro.php';</script>";
                    return;
                }
                if (emailExiste($email)) {
                    session_start();
                    $_SESSION['registro_error'] = "ERROR: El email ya está registrado";
                    echo "<script>window.location.href = 'registro.php';</script>";
                    return;
                }
                guardarDatos($user, $pass, $nombre, $apellidos, $email, $prefijoPais, $telefono);
            } else {
                session_start();
                $_SESSION['registro_error'] = "ERROR: Campos vacíos";
                echo "<script>window.location.href = 'registro.php';</script>";
            }
        ?>
    </div>
</body>
</html>

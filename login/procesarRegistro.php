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
                guardarDatos($user, $pass, $nombre, $apellidos, $email, $prefijoPais, $telefono);
            } else {
                echo "<div class='alert alert-danger' role='alert'>ERROR: Campos vacíos</div>";
            }
        ?>
    </div>
</body>
</html>

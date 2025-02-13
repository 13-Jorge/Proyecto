<?php
include_once '../connectDB/connect.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Procesar Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/redirect.js"></script>
</head>
<body>
    <?php
        $user = recogerValor("user");
        $pass = recogerValor("pass");
        $resultado = consultaPass($user, $pass);
    
        if ($resultado === true) {
            $_SESSION['user'] = $user;
            if (esAdmin($user)) {
                echo "<script>window.location.href = 'admin.php';</script>";
            } else {
                echo "<script>redirectToHome('$user');</script>";
            }
        } else {
            echo "<div class='container mt-5'>
                    <div class='alert alert-danger' role='alert'>
                        $resultado
                    </div>
                  </div>";
        }
    ?>
</body>
</html>

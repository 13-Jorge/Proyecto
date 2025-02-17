<?php
session_start();
include_once 'connectDB/connect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/common.css">
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="container my-4">
        <h1 class="text-center mb-4">Contacto</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <?php if (isset($_SESSION['user'])): ?>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                    </form>
                <?php else: ?>
                    <p class="text-center">Por favor, <a href="login/login.php">inicia sesión</a> para enviar un mensaje.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include_once "./inludes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/contacto.js"></script>
</body>
</html>
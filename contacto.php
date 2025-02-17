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
    <link rel="stylesheet" href="styles/contacto.css">
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h1 class="card-title text-center mb-5">Contacto</h1>
                            <?php if (isset($_SESSION['user'])): ?>
                                <form id="contactForm">
                                    <div class="form-group">
                                        <label for="message">Mensaje</label>
                                        <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Enviar</button>
                                </form>
                            <?php else: ?>
                                <div class="text-center">
                                    <p class="lead mb-4">Para enviar un mensaje, necesitas iniciar sesión.</p>
                                    <a href="login/login.php" class="btn btn-primary btn-lg">Iniciar Sesión</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
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


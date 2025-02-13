<?php
include_once '../connectDB/connect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../js/alta.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="max-width: 600px; width: 100%;">
        <h1 class="text-center mb-4">Registrarse</h1>
        <form name="form" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">Nombre</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Apellidos</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Teléfono</label>
                    <div class="input-group">
                        <select id="countryCode" name="countryCode" class="custom-select" required>
                            <option value="+1">+1</option>
                            <option value="+34">+34</option>
                            <option value="+44">+44</option>
                        </select>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user">Usuario</label>
                    <input type="text" id="user" name="user" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="pass">Contraseña</label>
                    <input type="password" id="pass" name="pass" class="form-control" required>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-6">
                    <label for="confirmPass">Confirmar Contraseña</label>
                    <input type="password" id="confirmPass" name="confirmPass" class="form-control" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary mr-2" onclick="alta()">Registrar</button>
                <button type="reset" class="btn btn-secondary">Borrar campos</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>
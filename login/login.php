<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/common.css">
    <script src="../js/login.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
        <h1 class="text-center mb-4">Iniciar Sesión</h1>
        <form name="form" method="post">
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" id="pass" name="pass" class="form-control" required>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary mr-2" onclick="login()">Iniciar sesión</button>
                <button type="reset" class="btn btn-secondary">Borrar campos</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>
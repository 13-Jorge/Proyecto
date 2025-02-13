<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../js/login.js"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="max-width: 400px; width: 100%;">
        <h1 class="text-center">Iniciar Sesión</h1>
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

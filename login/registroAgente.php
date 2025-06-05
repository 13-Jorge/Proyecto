<?php
include_once '../connectDB/connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = connectDB();
    if ($pdo != null) {
        // Check if the username or email already exists
        if (usuarioExiste($_POST['user'])) {
            $error = "El usuario ya existe.";
        } elseif (emailExiste($_POST['email'])) {
            $error = "El email ya está registrado.";
        } else {
            $consulta = "INSERT INTO login (user, pass, nombre, apellidos, email, prefijoPais, telefono, es_admin) VALUES (:user, :pass, :nombre, :apellidos, :email, :prefijoPais, :telefono, :es_admin)";
            $stmt = $pdo->prepare($consulta);
            $stmt->execute([
                'user' => $_POST['user'],
                'pass' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'email' => $_POST['email'],
                'prefijoPais' => "",
                'telefono' => "",
                'es_admin' => true
            ]);
            header('Location: admin.php');
            exit();
        }
    }
}
?>

<link rel="stylesheet" href="../styles/common.css">
<link rel="stylesheet" href="../styles/confirmarVisita.css">
<style>
        .form-container {
            max-width: 600px; 
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>

<div class="container">
    <h2 class="form-title">Registrar Agente</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger" style="border: 1px solid red; background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px;">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <form method="POST" action="registroAgente.php" class="form-container">
        <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" id="user" name="user" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <!-- Hidden esAdmin field -->
        <input type="hidden" name="es_admin" value="true">
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Registrar Agente</button>
            <a href="admin.php" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

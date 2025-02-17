<?php
session_start();
include_once 'connectDB/connect.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Visita - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/solicitarVisita.css">
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h1 class="card-title text-center mb-5">Solicitar Visita</h1>
                            <p class="lead text-center mb-4">En CM Gestión Inmobiliaria, facilitamos la visita a las propiedades de tu interés. Completa el siguiente formulario para solicitar una visita y uno de nuestros agentes se pondrá en contacto contigo para coordinar una cita.</p>
                            <?php if (isset($_SESSION['user'])): ?>
                                <form id="solicitarVisitaForm" method="post" action="login/procesarVisita.php">
                                    <div class="form-group">
                                        <label for="propiedad">Propiedad</label>
                                        <select id="propiedad" name="propiedad" class="form-control" required>
                                            <?php
                                            $pdo = connectDB();
                                            $consulta = "SELECT id, titulo FROM propiedades";
                                            $resul = $pdo->query($consulta);
                                            while ($propiedad = $resul->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . htmlspecialchars($propiedad['id']) . '">' . htmlspecialchars($propiedad['titulo']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dias_preferencia">Días preferidos del mes</label>
                                        <input type="text" id="dias_preferencia" name="dias_preferencia" class="form-control" placeholder="Seleccione los días preferidos" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rango_horas">Rango de horas preferido</label>
                                        <div class="d-flex">
                                            <input type="text" id="hora_inicio" name="hora_inicio" class="form-control mr-2" placeholder="Hora inicio" required>
                                            <input type="text" id="hora_fin" name="hora_fin" class="form-control" placeholder="Hora fin" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comentarios">Comentarios adicionales</label>
                                        <textarea id="comentarios" name="comentarios" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Solicitar Visita</button>
                                </form>
                            <?php else: ?>
                                <div class="text-center">
                                    <p class="lead mb-4">Para solicitar una visita, necesitas iniciar sesión.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/solicitarVisita.js"></script>
</body>
</html>


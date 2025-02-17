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
    <link rel="stylesheet" href="styles/common.css">
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="container my-4">
        <h1 class="text-center mb-4">Solicitar Visita</h1>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <p class="lead text-center mb-4">En CM Gestión Inmobiliaria, facilitamos la visita a las propiedades de tu interés. Completa el siguiente formulario para solicitar una visita y uno de nuestros agentes se pondrá en contacto contigo para coordinar una cita.</p>
                <form id="solicitarVisitaForm" method="post" action="procesarVisita.php">
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
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hora">Hora</label>
                            <input type="time" id="hora" name="hora" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="comentarios">Comentarios adicionales</label>
                        <textarea id="comentarios" name="comentarios" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Solicitar Visita</button>
                </form>
            </div>
        </div>
    </main>

    <?php include_once "./inludes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
</body>
</html>
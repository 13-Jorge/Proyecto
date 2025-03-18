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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_gold.css">
    <link rel="stylesheet" href="styles/common.css">
    <style>
        /* Clases responsivas para textos */
        .responsive-text {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Ajustes responsive para el formulario de visitas */
        .form-visit .form-group {
            margin-bottom: 1.25rem;
        }

        .form-visit label {
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        /* Media queries para ajustar texto y elementos en diferentes resoluciones */
        @media (max-width: 991px) {
            .card-title.text-center.mb-5 {
                margin-bottom: 1.5rem !important;
                font-size: 1.75rem;
            }

            .responsive-text {
                font-size: 0.95rem;
                margin-bottom: 1.5rem !important;
            }

            .card-body.p-5 {
                padding: 1.5rem !important;
            }

            .form-visit .form-group {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 767px) {
            .card-title.text-center.mb-5 {
                margin-bottom: 1rem !important;
                font-size: 1.5rem;
            }

            .responsive-text {
                font-size: 0.9rem;
                line-height: 1.4;
            }

            .card-body.p-5 {
                padding: 1.25rem !important;
            }

            .form-visit label {
                font-size: 0.9rem;
                margin-bottom: 0.3rem;
            }

            .form-control {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .form-text {
                font-size: 0.75rem;
            }

            .btn-primary {
                padding: 0.6rem 1rem;
            }
        }

        /* Mobile pequeño */
        @media (max-width: 575px) {
            .card-title.text-center.mb-5 {
                font-size: 1.35rem;
            }

            .responsive-text {
                font-size: 0.85rem;
                margin-bottom: 1rem !important;
            }

            .card-body.p-5 {
                padding: 1rem !important;
            }

            .btn-primary {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
        }

        /* Contenedor para el select que ayuda a controlar su apariencia */
        .select-container {
            position: relative;
            width: 100%;
        }

        /* Estilos básicos para selects */
        .custom-select {
            text-overflow: ellipsis;
            overflow: hidden;
            width: 100%;
        }

        /* Estilos para elementos select en formularios responsivos */
        select.form-control {
            padding-right: 2rem;
            /* Espacio para la flecha del dropdown */
            white-space: normal;
            /* Permite que el texto pueda saltar de línea dentro del select */
            word-wrap: break-word;
            /* Permite que las palabras largas se rompan */
            text-overflow: ellipsis;
            /* Añade puntos suspensivos para texto que no cabe */
            height: auto;
            /* Permite altura automática */
            min-height: calc(1.5em + 0.75rem + 2px);
            /* Altura mínima consistente con Bootstrap */
        }

        /* Estilos para las opciones del select cuando está desplegado */
        select.form-control option {
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 0.5rem;
            font-size: 0.9rem;
        }

        /* Media query para dispositivos móviles */
        @media (max-width: 767px) {
            select.form-control {
                font-size: 0.9rem;
                padding: 0.4rem 1.75rem 0.4rem 0.4rem;
            }

            select.form-control option {
                padding: 0.4rem;
                font-size: 0.85rem;
            }
        }

        /* Mejora para visualización del select en navegadores móviles */
        @media (max-width: 575px) {

            /* Este hack mejora la visualización en algunos navegadores móviles */
            select:focus {
                font-size: 16px !important;
                /* Previene zoom automático en iOS */
            }
        }
    </style>
</head>

<body>
    <?php include_once "./includes/header.php"; ?>

    <main class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h1 class="card-title text-center mb-5">Solicitar Visita</h1>
                            <!-- Párrafo descriptivo modificado con clase responsive-text -->
                            <p class="lead text-center mb-4 responsive-text">En CM Gestión Inmobiliaria, facilitamos la visita a las propiedades de tu interés. Completa el formulario para solicitar una visita.</p>
                            <?php if (isset($_SESSION['user'])): ?>
                                <!-- Añadida clase form-visit al formulario -->
                                <form id="solicitarVisitaForm" method="post" action="login/procesarVisita.php" class="form-visit">
                                    <div class="form-group">
                                        <label for="propiedad">Propiedad</label>
                                        <div class="select-container">
                                            <select id="propiedad" name="propiedad" class="form-control custom-select" required>
                                                <?php
                                                $pdo = connectDB();
                                                $consulta = "SELECT id, titulo FROM propiedades";
                                                $resul = $pdo->query($consulta);
                                                while ($propiedad = $resul->fetch(PDO::FETCH_ASSOC)) {
                                                    // Limitar la longitud del título para mostrar en móviles si es necesario
                                                    $titulo = htmlspecialchars($propiedad['titulo']);
                                                    echo '<option value="' . htmlspecialchars($propiedad['id']) . '" title="' . $titulo . '">' . $titulo . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="dias_preferencia">Días preferidos para la visita</label>
                                        <input type="text" id="dias_preferencia" name="dias_preferencia" class="form-control" placeholder="Seleccione los días" required readonly>
                                        <small class="form-text text-muted">Puede seleccionar varios días</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Rango horario preferido</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="text" id="hora_inicio" name="hora_inicio" class="form-control" placeholder="Inicio" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    </div>
                                                    <input type="text" id="hora_fin" name="hora_fin" class="form-control" placeholder="Fin" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="comentarios">Comentarios adicionales</label>
                                        <textarea id="comentarios" name="comentarios" class="form-control" rows="2"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">Solicitar Visita</button>
                                </form>
                            <?php else: ?>
                                <div class="text-center">
                                    <p class="lead mb-4 responsive-text">Para solicitar una visita, necesitas iniciar sesión.</p>
                                    <a href="login/login.php" class="btn btn-primary">Iniciar Sesión</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include_once "./includes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/solicitarVisita.js"></script>
</body>

</html>
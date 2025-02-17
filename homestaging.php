<?php
session_start();
include_once 'connectDB/connect.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homestaging - CM Gestión Inmobiliaria</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/common.css">
    <link rel="stylesheet" href="styles/homestaging.css">
</head>

<body>
    <?php include_once "./inludes/header.php"; ?>

    <main>
        <section class="hero-section text-center">
            <div class="container">
                <h1 class="display-4 mb-4">Homestaging: Transformando Espacios, Creando Oportunidades</h1>
                <p class="lead">Descubre cómo nuestro servicio de homestaging puede maximizar el potencial de tu propiedad</p>
            </div>
        </section>

        <div class="container">
            <section class="mb-5">
                <h2 class="text-center mb-4">¿Qué es el Homestaging?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <p class="lead">El homestaging es una técnica de marketing inmobiliario que consiste en preparar y decorar una propiedad para que resulte más atractiva a los posibles compradores. El objetivo es destacar los puntos fuertes de la vivienda y minimizar sus debilidades, creando un ambiente acogedor y neutral que permita a los compradores potenciales imaginarse viviendo en ella.</p>
                        <p>En CM Gestión Inmobiliaria, ofrecemos servicios de homestaging para ayudarte a vender tu propiedad más rápido y al mejor precio. Nuestro equipo de expertos se encargará de todo el proceso, desde la planificación y diseño hasta la ejecución y fotografía profesional.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="before-after-wrapper">
                                <div class="before-after-container">
                                    <img src="img/homestaging-before.png" alt="Antes del Homestaging" class="before-image">
                                    <img src="img/homestaging-after.png" alt="Después del Homestaging" class="after-image">
                                    <div class="before-after-slider"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

            <section class="mb-5">
                <h2 class="text-center mb-4">Beneficios del Homestaging</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            <i class="fas fa-chart-line benefit-icon mb-3"></i>
                            <h4>Incrementa el Valor</h4>
                            <p>Aumenta el valor percibido de la propiedad, permitiéndote obtener un mejor precio de venta.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            <i class="fas fa-clock benefit-icon mb-3"></i>
                            <h4>Reduce el Tiempo en el Mercado</h4>
                            <p>Las propiedades con homestaging se venden hasta un 70% más rápido que las que no lo tienen.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-center">
                            <i class="fas fa-users benefit-icon mb-3"></i>
                            <h4>Atrae Más Compradores</h4>
                            <p>Una propiedad bien presentada atrae a más compradores potenciales y genera más ofertas.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <h2 class="text-center mb-4">Nuestros Servicios de Homestaging</h2>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-clipboard-list fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Asesoramiento y Planificación</h5>
                                <p class="card-text">Evaluamos tu propiedad y desarrollamos un plan personalizado para maximizar su atractivo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-couch fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Decoración y Mobiliario</h5>
                                <p class="card-text">Transformamos los espacios con decoración y mobiliario cuidadosamente seleccionados.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-camera fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Fotografía Profesional</h5>
                                <p class="card-text">Capturamos imágenes de alta calidad que resaltan los mejores aspectos de tu propiedad.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card service-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-bullhorn fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">Marketing y Promoción</h5>
                                <p class="card-text">Promocionamos tu propiedad en los canales más efectivos para llegar a los compradores adecuados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="mb-5">
                <h2 class="text-center mb-4">¿Listo para Transformar tu Propiedad?</h2>
                <div class="text-center">
                    <a href="contacto.php" class="btn btn-primary btn-lg">Solicita una Consulta Gratuita</a>
                </div>
            </section>
        </div>
    </main>

    <?php include_once "./inludes/footer.php"; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script src="js/homestaging.js"></script>
</body>

</html>


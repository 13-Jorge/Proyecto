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
</head>
<body>
    <?php include_once "./inludes/header.php"; ?>

    <main class="container my-4">
        <h1 class="text-center mb-4">Homestaging</h1>
        <div class="row">
            <div class="col-md-12">
                <p class="lead">El homestaging es una técnica de marketing inmobiliario que consiste en preparar y decorar una propiedad para que resulte más atractiva a los posibles compradores. El objetivo es destacar los puntos fuertes de la vivienda y minimizar sus debilidades, creando un ambiente acogedor y neutral que permita a los compradores potenciales imaginarse viviendo en ella.</p>
                <p>En CM Gestión Inmobiliaria, ofrecemos servicios de homestaging para ayudarte a vender tu propiedad más rápido y al mejor precio. Nuestro equipo de expertos se encargará de todo el proceso, desde la planificación y diseño hasta la ejecución y fotografía profesional.</p>
                <h3>Beneficios del Homestaging</h3>
                <ul>
                    <li>Incrementa el valor percibido de la propiedad.</li>
                    <li>Reduce el tiempo en el mercado.</li>
                    <li>Atrae a más compradores potenciales.</li>
                    <li>Destaca los puntos fuertes de la vivienda.</li>
                    <li>Minimiza las debilidades de la propiedad.</li>
                </ul>
                <h3>Nuestros Servicios de Homestaging</h3>
                <ul>
                    <li>Asesoramiento y planificación.</li>
                    <li>Decoración y mobiliario.</li>
                    <li>Fotografía profesional.</li>
                    <li>Marketing y promoción.</li>
                </ul>
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
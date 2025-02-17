<?php
session_start();
include_once '../connectDB/connect.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../login/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad_id = $_POST['propiedad'];
    $dias_preferencia = $_POST['dias_preferencia'];
    $rango_horas = $_POST['rango_horas'];
    $comentarios = $_POST['comentarios'];
    $cliente_id = $_SESSION['user'];

    $pdo = connectDB();

    // Get user email
    $stmt = $pdo->prepare("SELECT email FROM login WHERE user = ?");
    $stmt->execute([$cliente_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = $user['email'];

    // Get property title
    $stmt = $pdo->prepare("SELECT titulo FROM propiedades WHERE id = ?");
    $stmt->execute([$propiedad_id]);
    $propiedad = $stmt->fetch(PDO::FETCH_ASSOC);
    $titulo_propiedad = $propiedad['titulo'];

    // Insert visit request
    $stmt = $pdo->prepare("INSERT INTO visitas (propiedad_id, cliente_id, dias_preferencia, rango_horas, comentarios) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$propiedad_id, $cliente_id, $dias_preferencia, $rango_horas, $comentarios]);

    // Send notification to admin with detailed visit information
    $mensaje = "Nueva solicitud de visita:\nPropiedad: $titulo_propiedad\nCliente: $email\nDías preferidos: $dias_preferencia\nRango de horas: $rango_horas\nComentarios: $comentarios";
    $stmt = $pdo->prepare("INSERT INTO notificaciones (autor, mensaje) VALUES (?, ?)");
    $stmt->execute([$cliente_id, $mensaje]);

    header('Location: ../solicitarVisita.php?success=1');
    exit();
}
?>

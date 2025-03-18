<?php
include_once '../connectDB/connect.php';
session_start();
if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Recoger valores del formulario
$propiedad_id = recogerValor('propiedad');
$descripcion = recogerValor('descripcion');
$fecha = recogerValor('fecha');
$coste = recogerValor('coste');
$agente = recogerValor('agente');

// Conexión a la base de datos e inserción
$pdo = connectDB();
if ($pdo != null) {
    try {
        $consulta = "INSERT INTO homestaging (propiedad_id, descripcion, fecha, coste, agente) VALUES (:propiedad_id, :descripcion, :fecha, :coste, :agente)";
        $resul = $pdo->prepare($consulta);
        $resul->execute([
            'propiedad_id' => $propiedad_id,
            'descripcion' => $descripcion,
            'fecha' => $fecha,
            'coste' => $coste,
            'agente' => $agente
        ]);

        
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Redireccionar después de la inserción
header('Location: admin.php');
exit();
?>
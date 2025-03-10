<?php
include_once '../connectDB/connect.php';
session_start();
if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$titulo = recogerValor('titulo');
$descripcion = recogerValor('descripcion');
$precio = recogerValor('precio');
$direccion = recogerValor('direccion');
$ciudad = recogerValor('ciudad');
$codigo_postal = recogerValor('codigo_postal');
$tipo = recogerValor('tipo');
$superficie = recogerValor('superficie');
$num_habitaciones = recogerValor('num_habitaciones');
$num_banos = recogerValor('num_banos');
$imagen = file_get_contents($_FILES['imagen']['tmp_name']);
$pdo = connectDB();
if ($pdo != null) {
    $consulta = "INSERT INTO propiedades (titulo, descripcion, precio, direccion, ciudad, codigo_postal, tipo, superficie, num_habitaciones, num_banos) VALUES (:titulo, :descripcion, :precio, :direccion, :ciudad, :codigo_postal, :tipo, :superficie, :num_habitaciones, :num_banos)";
    $resul = $pdo->prepare($consulta);
    $resul->execute([
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'direccion' => $direccion,
        'ciudad' => $ciudad,
        'codigo_postal' => $codigo_postal,
        'tipo' => $tipo,
        'superficie' => $superficie,
        'num_habitaciones' => $num_habitaciones,
        'num_banos' => $num_banos
    ]);
    $propiedad_id = $pdo->lastInsertId();
    $consultaImagen = "INSERT INTO imagenes (propiedad_id, imagen) VALUES (:propiedad_id, :imagen)";
    $resulImagen = $pdo->prepare($consultaImagen);
    $resulImagen->execute([
        'propiedad_id' => $propiedad_id,
        'imagen' => $imagen
    ]);
}
header('Location: admin.php');
exit();
?>
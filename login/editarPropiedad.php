<?php
include_once '../connectDB/connect.php';
session_start();

if (!isset($_SESSION['user']) || !esAdmin($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pdo = connectDB();
$propiedad = null;
if ($pdo != null && isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT p.*, i.imagen FROM propiedades p LEFT JOIN imagenes i ON p.id = i.propiedad_id WHERE p.id = ?";
    $stmt = $pdo->prepare($consulta);
    $stmt->execute([$id]);
    $propiedad = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for updating or deleting the property
    if (isset($_POST['update'])) {
        // Update property
        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $codigo_postal = $_POST['codigo_postal'];
        $tipo = $_POST['tipo'];
        $superficie = $_POST['superficie'];
        $num_habitaciones = $_POST['num_habitaciones'];
        $num_banos = $_POST['num_banos'];

        $updateQuery = "UPDATE propiedades SET titulo = ?, precio = ?, descripcion = ?, direccion = ?, ciudad = ?, codigo_postal = ?, tipo = ?, superficie = ?, num_habitaciones = ?, num_banos = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([$titulo, $precio, $descripcion, $direccion, $ciudad, $codigo_postal, $tipo, $superficie, $num_habitaciones, $num_banos, $id]);

        // Handle image upload if a new image is provided
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
            $updateImageQuery = "UPDATE imagenes SET imagen = ? WHERE propiedad_id = ?";
            $stmt = $pdo->prepare($updateImageQuery);
            $stmt->execute([$imagen, $id]);
        }

        header('Location: admin.php');
        exit();
    } elseif (isset($_POST['delete'])) {
        // Delete property
        $deleteQuery = "DELETE FROM propiedades WHERE id = ?";
        $stmt = $pdo->prepare($deleteQuery);
        $stmt->execute([$id]);

        header('Location: fetchPropiedades.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propiedad</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/common.css">
    <style>
        /* Estilos específicos para la página de editar propiedad */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .form-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .nav-actions {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 1.5rem;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--light-color);
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: var(--border-radius-md);
            text-decoration: none;
            display: inline-block;
            transition: var(--transition-normal);
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            color: var(--light-color);
            text-decoration: none;
        }

        .form-container {
            background-color: white;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            transition: var(--transition-normal);
        }

        .form-container:hover {
            box-shadow: var(--shadow-lg);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius-md);
            font-size: 1rem;
            transition: var(--transition-normal);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            outline: none;
        }

        .form-control-file {
            padding: 0.5rem 0;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
            margin-top: 1rem;
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-sm);
        }

        .form-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--light-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: var(--border-radius-md);
            transition: var(--transition-normal);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-danger {
            background-color: #dc3545;
            color: var(--light-color);
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: var(--border-radius-md);
            transition: var(--transition-normal);
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Estilos responsive */
        @media (max-width: 767px) {
            .container {
                padding: 1rem;
            }

            .form-container {
                padding: 1.5rem;
            }

            .form-title {
                font-size: 1.8rem;
            }

            .form-control {
                padding: 0.6rem;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .form-actions .btn-primary,
            .form-actions .btn-danger {
                width: 100%;
                text-align: center;
                margin-bottom: 0.5rem;
            }
        }

        @media (max-width: 575px) {
            .form-container {
                padding: 1rem;
            }

            .form-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav-actions">
            <a href="admin.php" class="btn-secondary">← Volver a Panel</a>
        </div>
        
        <?php if ($propiedad): ?>
            <div class="form-container">
                <h2 class="form-title">Editar Propiedad</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="titulo">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo htmlspecialchars($propiedad['titulo']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input type="number" id="precio" name="precio" class="form-control" value="<?php echo htmlspecialchars($propiedad['precio']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required><?php echo htmlspecialchars($propiedad['descripcion']); ?></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo htmlspecialchars($propiedad['direccion']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?php echo htmlspecialchars($propiedad['ciudad']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" id="codigo_postal" name="codigo_postal" class="form-control" value="<?php echo htmlspecialchars($propiedad['codigo_postal']); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tipo">Tipo</label>
                            <input type="text" id="tipo" name="tipo" class="form-control" value="<?php echo htmlspecialchars($propiedad['tipo']); ?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="superficie">Superficie (m²)</label>
                            <input type="number" id="superficie" name="superficie" class="form-control" value="<?php echo htmlspecialchars($propiedad['superficie']); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="num_habitaciones">Número de Habitaciones</label>
                            <input type="number" id="num_habitaciones" name="num_habitaciones" class="form-control" value="<?php echo htmlspecialchars($propiedad['num_habitaciones']); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="num_banos">Baños</label>
                            <input type="number" id="num_banos" name="num_banos" class="form-control" value="<?php echo htmlspecialchars($propiedad['num_banos']); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="form-control-file">
                        <?php if ($propiedad['imagen']): ?>
                            <div class="text-center">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad['imagen']); ?>" alt="Imagen de la propiedad" class="img-preview mt-2" style="max-width: 300px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="update" class="btn-primary">Actualizar Propiedad</button>
                        <button type="submit" name="delete" class="btn-secondary" onclick="return confirm('¿Está seguro de que desea eliminar esta propiedad? Esta acción no se puede deshacer.')">Eliminar Propiedad</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="form-container">
                <div class="alert alert-warning">
                    <p>Propiedad no encontrada. <a href="admin.php">Volver al panel de administración</a></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
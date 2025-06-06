<?php

function recogerValor($key){
    $valor="";
    if(isset($_REQUEST[$key])){
        $valor=trim(htmlspecialchars($_REQUEST[$key]));
    }else{
        $valor="error";
    }
    return $valor;
}

function connectDB() {
    $host = "buo2qjsfw5ebaa1ap5pi-mysql.services.clever-cloud.com";
    $database = "buo2qjsfw5ebaa1ap5pi";
    $user = "uxgvgl8eefihimbb";
    $pass = "MYaBDyxxRtRcY9hjCQFc";

    try {
        $dsn = "mysql:host=$host;dbname=$database;charset=utf8";
        $con = new pdo($dsn, $user, $pass);
        return $con;
    } catch (PDOException $ex) {
        print "ERROR exception pdo";
    }
}

function consultaPass($user, $pass) {
    $consulta = "SELECT * FROM login WHERE user=:param";
    $pdo = connectDB();
    $resul = $pdo->prepare($consulta);
    if ($resul != null) {
        $resul->execute(["param" => $user]);
        $registro = $resul->fetch();
         
        if ($registro == null) {
            return "<span class='error-message'>ERROR: Usuario no encontrado</span>";
        }
        // Verificar la contraseña hasheada
        if (password_verify($pass, $registro["pass"])) {
            return true;
        } else {
            return "<span class='error-message'>ERROR: Contraseña incorrecta</span>";
        }
    } else {
        return "<span class='error-message'>ERROR: Al preparar la consulta</span>";
    }
}

function usuarioExiste($user) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consultaVerificar = "SELECT COUNT(*) FROM login WHERE user = :paramUser";
        $resulVerificar = $pdo->prepare($consultaVerificar);
        $resulVerificar->execute(["paramUser" => $user]);
        $count = $resulVerificar->fetchColumn();
        return $count > 0;
    }
    return false;
}

function emailExiste($email) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consultaVerificar = "SELECT COUNT(*) FROM login WHERE email = :paramEmail";
        $resulVerificar = $pdo->prepare($consultaVerificar);
        $resulVerificar->execute(["paramEmail" => $email]);
        $count = $resulVerificar->fetchColumn();
        return $count > 0;
    }
    return false;
}

function obtenerDatosUsuario($user) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT * FROM login WHERE user = :user";
        $resul = $pdo->prepare($consulta);
        $resul->execute(["user" => $user]);
        return $resul->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}

function guardarDatos($user, $pass, $nombre, $apellidos, $email, $prefijoPais, $telefono) {
    if (usuarioExiste($user)) {
        echo "<div class='alert alert-danger' role='alert'>ERROR: El usuario ya existe</div>";
        return;
    }

    $pdo = connectDB();
    if ($pdo != null) {
        // Hashear la contraseña
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

        $consulta = "INSERT INTO login (user, pass, nombre, apellidos, email, prefijoPais, telefono) VALUES (:user, :pass, :nombre, :apellidos, :email, :prefijoPais, :telefono)";
        $resul = $pdo->prepare($consulta);
        if ($resul != null) {
            if ($resul->execute([
                "user" => $user,
                "pass" => $hashedPass, // Guardar la contraseña hasheada
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "email" => $email,
                "prefijoPais" => $prefijoPais,
                "telefono" => $telefono
            ])) {
                echo "<script>window.location.href = '../index.php';</script>";
            }
        }
    }
}

function actualizarPerfil($oldUser, $newUser, $nombre, $apellidos, $email, $telefono, $pass, $es_admin) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "UPDATE login SET user = :newUser, nombre = :nombre, apellidos = :apellidos, email = :email, telefono = :telefono, pass = :pass, es_admin = :es_admin WHERE user = :oldUser";
        $resul = $pdo->prepare($consulta);
        if ($resul != null) {
            if ($resul->execute([
                "newUser" => $newUser,
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "email" => $email,
                "telefono" => $telefono,
                "pass" => $pass,
                "es_admin" => $es_admin,
                "oldUser" => $oldUser
            ])) {
                if ($_SESSION['user'] === $oldUser) {
                    $_SESSION['user'] = $newUser;
                }
                echo "<script>
                        alert('Datos actualizados correctamente');
                        window.location.href = '../login/perfil.php?user=$newUser'; // Actualizar ruta
                      </script>";
            } else {
                echo "<script>
                        alert('Error al actualizar los datos');
                        window.location.href = '../login/perfil.php?user=$oldUser'; // Actualizar ruta
                      </script>";
            }
        }
    }
}

function borrarCuenta($user) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "DELETE FROM login WHERE user = :user";
        $resul = $pdo->prepare($consulta);
        if ($resul != null) {
            if ($resul->execute(["user" => $user])) {
                if (esAdmin($_SESSION['user'])) {
                    echo "<script>
                            alert('Cuenta borrada correctamente');
                            window.location.href = '../login/admin.php'; 
                          </script>";
                } else {
                    session_destroy();
                    echo "<script>
                            alert('Cuenta borrada correctamente');
                            window.location.href = '../index.php'; 
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Error al borrar la cuenta');
                        window.location.href = '../login/perfil.php';
                      </script>";
            }
        }
    }
}

function logout() {
    session_start();
    session_destroy();
    header('Location: ../index.php');
    exit();
}

function esAdmin($user) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT es_admin FROM login WHERE user = :user";
        $resul = $pdo->prepare($consulta);
        $resul->execute(["user" => $user]);
        $registro = $resul->fetch(PDO::FETCH_ASSOC);
        return $registro['es_admin'] ?? false;
    }
    return false;
}

function insertarNotificacion($autor, $mensaje) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "INSERT INTO notificaciones (autor, mensaje, leido) VALUES (:autor, :mensaje, 0)";
        $resul = $pdo->prepare($consulta);
        $resul->execute([
            'autor' => $autor,
            'mensaje' => $mensaje
        ]);
    }
}

function obtenerNotificaciones() {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT n.*, l.email, l.telefono FROM notificaciones n JOIN login l ON n.autor = l.user"; // Incluye el campo 'telefono'
        $resul = $pdo->query($consulta);
        return $resul->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function obtenerNotificacionesNoLeidas() {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "SELECT n.*, l.email, l.telefono FROM notificaciones n JOIN login l ON n.autor = l.user WHERE n.leido = 0 ORDER BY fecha DESC";
        $resul = $pdo->query($consulta);
        return $resul->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

function marcarNotificacionLeida($id) {
    $pdo = connectDB();
    if ($pdo != null) {
        $consulta = "UPDATE notificaciones SET leido = 1 WHERE id = :id";
        $resul = $pdo->prepare($consulta);
        $resul->execute(['id' => $id]);
    }
}

function obtenerAgentes()
{
    $pdo = connectDB();
    if ($pdo != null) {
        $query = "SELECT user, nombre FROM login WHERE es_admin = TRUE";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}
?>
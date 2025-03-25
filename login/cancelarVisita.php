<?php
include_once '../connectDB/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitizar el ID recibido por GET
    $pdo = connectDB();

    if ($pdo != null) {
        try {
            // Iniciar una transacción
            $pdo->beginTransaction();

            // Obtener el id_solicitud relacionado antes de eliminar
            $stmt = $pdo->prepare("SELECT id_solicitud FROM visitasConfirmadas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $idSolicitud = $stmt->fetchColumn();

            if ($idSolicitud) {
                // Eliminar de visitasSolicitadas (esto activará el ON DELETE CASCADE en visitasConfirmadas)
                $stmt = $pdo->prepare("DELETE FROM visitasSolicitadas WHERE id = :id_solicitud");
                $stmt->bindParam(':id_solicitud', $idSolicitud, PDO::PARAM_INT);
                $stmt->execute();
            }

            // Confirmar la transacción
            $pdo->commit();

            // Redirigir con éxito
            header("Location: admin.php?status=success");
            exit();
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $pdo->rollBack();
            error_log("Error al cancelar la visita: " . $e->getMessage());
            header("Location: admin.php?status=error");
            exit();
        }
    }
}

// Redirigir si no se recibe un ID válido
header("Location: admin.php?status=invalid");
exit();
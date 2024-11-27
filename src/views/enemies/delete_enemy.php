<?php
require_once("../../config/db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("No se ha recibido un ID");
    }

    try {
        $stmt = $db->prepare("DELETE FROM enemies WHERE id=:id");
        $stmt->bindValue(":id", $_POST['id'], PDO::PARAM_INT);

        if($stmt->execute()){
            //echo "Enemigo eliminado.";
            header("Location: create_enemy.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al borrar ".$e->getMessage());
    }
} else {
    die("Método no permitido");
}
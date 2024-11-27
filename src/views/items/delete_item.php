<?php
require_once("../../config/db.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("No se ha recibido un ID");
    }

    try {
        $stmt = $db->prepare("DELETE FROM items WHERE id=:id");
        $stmt->bindValue(":id", $_POST['id'], PDO::PARAM_INT);

        if($stmt->execute()){
            //echo "Item eliminado.";
            header("Location: create_item.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al borrar ".$e->getMessage());
    }
} else {
    die("Método no permitido");
}

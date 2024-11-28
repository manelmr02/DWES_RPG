<?php
require_once("../../config/db.php");
require_once("../../model/Item.php");

// Comprobamos si hemos recibido un 'id' a través de GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se ha recibido un ID válido.");
}

$itemId = $_GET['id']; // Obtenemos el ID del item desde la URL

// Intentamos obtener el item de la base de datos
try {
    // Consulta para obtener los datos del enemigo
    $stmt = $db->prepare("SELECT * FROM items WHERE id = :id");
    $stmt->bindParam(':id', $itemId, PDO::PARAM_INT); //nos aseguramos de que sea int el id introducido
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC); //tenemos que usar el fetch unicamente porque el fetchAll nos devuelve un array y nos generaria un error
    if (!$item) {
        die("Item no encontrado.");
    }
} catch (PDOException $e) {
    die("Error al obtener el item: " . $e->getMessage());
}

// Si se envia por POST tenemos que procesar los datos que nos pasa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = new Item($db);
    $item->setId($_GET['id']);
    $item->setName($_POST['name']);
    $item->setDescription($_POST['description']);
    $item->setType($_POST['type']);
    $item->setEffect($_POST['effect']);

    if ($item->update()) {
        header("Location: create_item.php");
    } else {
        echo "ERROR: No se ha actualizado el item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edita tu item</title>
</head>

<body>
    <?php include('../partials/_menu.php') ?>
    <h1>Editar Item</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $itemId ?>" method="POST">
        <div id="nameDiv">
            <label for="nameInput">Nombre:</label>
            <input name="name" type="text" id="nameInput" value="<?= $item['name'] ?>" placeholder="Nombre del item" required>
        </div>

        <div id="descriptionDiv">
            <label for="descriptionInput">Descripción:</label>
            <input name="description" type="text" id="descriptionInput" value="<?= $item['description'] ?>" placeholder="Descripción del item" required>
        </div>

        <div id="typeDiv">
            <label for="typeInput">Tipo:</label>
            <select name="type" id="typeInput" required>
                <option value="weapon" <?= $item['type'] == 'weapon' ? 'selected' : '' ?>>Arma</option>
                <option value="armor" <?= $item['type'] == 'armor' ? 'selected' : '' ?>>Armadura</option>
                <option value="potion" <?= $item['type'] == 'potion' ? 'selected' : '' ?>>Poción</option>
                <option value="misc" <?= $item['type'] == 'misc' ? 'selected' : '' ?>>Misceláneo</option>
            </select>

        </div>

        <div id="effectDiv">
            <label for="effectInput">Efecto:</label>
            <input name="effect" type="number" id="effectInput" value="<?= $item['effect'] ?>" min="1" placeholder="Efecto del item" required> <!--Podriamos no poner minimos para asi tener items que tuvieses efectos negativos-->
        </div>

        <button type="submit">Actualizar item</button>
    </form>


</body>

</html>
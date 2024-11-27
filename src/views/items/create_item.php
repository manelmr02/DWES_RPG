<?php
require_once("../../config/db.php");
require_once("../../model/Item.php");

//array asociativo en el que vamos a introducir todo lo que nos venga de la base de datos
$items = [];

$typeTranslations = [
    "weapon" => "Arma",
    "armor" => "Armadura",
    "potion" => "Poción",
    "misc" => "Misceláneo",
];//esto esta creado para en el listado traducir al español los enumerados

try {
    $stmt = $db->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "ERROR: Ha ocurrido un error leyendo la base de datos " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = new Item($db);
    $item->setName($_POST['name']);
    $item->setDescription($_POST['description']);
    $item->setType($_POST['type']);
    $item->setEffect($_POST['effect']);

    if ($item->save()) {
        echo "Se ha guardado el item.";
    } else {
        echo "ERROR: No se ha guardado el item.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu item</title>
</head>

<body>
    <?php include('../partials/_menu.php') ?>
    <h1>Crea tu item</h1>
    <form action=<?= $_SERVER['PHP_SELF'] ?> method="POST">
        <div id="nameDiv">
            <label for="nameInput">Nombre:</label>
            <input name="name" type="text" id="nameInput" placeholder="Nombre del item" required>
        </div>

        <div id="descriptionDiv">
            <label for="descriptionInput">Descripción:</label>
            <input name="description" type="text" id="descriptionInput" placeholder="Descripción del item" required>
        </div>

        <div id="typeDiv">
            <label for="typeInput">Tipo:</label>
            <select name="type" id="typeInput" required> <!--Ponemos un selector para asegurarnos de que funcione como un enum (tipo establecido en la base de datos), es decir que no puedas elegir un valor incompatible-->
                <option value="weapon">Arma</option>
                <option value="armor">Armadura</option>
                <option value="potion">Poción</option>
                <option value="misc">Misceláneo</option>
            </select>
        </div>

        <div id="effectDiv">
            <label for="effectInput">Efecto:</label>
            <input name="effect" type="number" id="effectInput" value="1" min="1" placeholder="Efecto del item" required> <!--Podriamos no poner minimos para asi tener items que tuvieses efectos negativos-->
        </div>

        <button type="submit">Crear item</button>
    </form>

    <h1>Lista de items</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo</th>
                <th>Efecto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>Img</td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td><?= $typeTranslations[$item['type']] ?></td>
                    <td><?= $item['effect'] ?></td>
                    <td>
                        <form action="edit_item.php" method="GET">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit">Editar</button>
                        </form>
                        <form action="delete_item.php" method="POST">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
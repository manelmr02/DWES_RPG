<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");

//array asociativo en el que vamos a introducir todo lo que nos venga de la base de datos
$enemies = [];

try {
    $stmt = $db->query("SELECT * FROM enemies");
    $enemies = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "ERROR: Ha ocurrido un error leyendo la base de datos " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enemy = new Enemy($db);
    $enemy->setName($_POST['name']);
    $enemy->setDescription($_POST['description']);
    $enemy->setIsBoss(isset($_POST['isBoss']) ? 1 : 0);//esta linea comprueba si el checkbox de que es un enemigo esta marcado o no, para asi devolver 1(si esta marcado) o 2(si no lo esta)
    $enemy->setHealth($_POST['health']);
    $enemy->setStrength($_POST['strength']);
    $enemy->setDefense($_POST['defense']);

    if ($enemy->save()) {
        echo "Se ha guardado el enemigo.";
    } else {
        echo "ERROR: No se ha guardado el enemigo.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu enemigo</title>
</head>

<body>
    <?php include('../partials/_menu.php') ?>
    <h1>Crea tu enemigo</h1>
    <form action=<?= $_SERVER['PHP_SELF'] ?> method="POST">
        <div id="nameDiv">
            <label for="nameInput">Nombre:</label>
            <input name="name" type="text" id="nameInput" placeholder="Nombre del enemigo" required>
        </div>

        <div id="descriptionDiv">
            <label for="descriptionInput">Descripción:</label>
            <input name="description" type="text" id="descriptionInput" placeholder="Descripción del enemigo" required>
        </div>

        <div id="isBossDiv">
            <label for="isBossInput">¿Es un jefe?</label>
            <input name="isBoss" type="checkbox" id="isBossInput" value="1" >
        </div>

        <div id="healthDiv">
            <label for="healthInput">Vida:</label>
            <input name="health" type="number" id="healthInput" value="100" min="1" placeholder="Vida del enemigo" required>
        </div>

        <div id="strengthDiv">
            <label for="strengthInput">Fuerza:</label>
            <input name="strength" type="number" id="strengthInput" value="10" min="1" placeholder="Fuerza del enemigo" required>
        </div>

        <div id="defenseDiv">
            <label for="defenseInput">Defensa:</label>
            <input name="defense" type="number" id="defenseInput" value="10" min="1" placeholder="Defensa del enemigo" required>
        </div>

        <button type="submit">Crear enemigo</button>
    </form>
    <?php require('list_enemies.php'); ?>
    
</body>

</html>
<?php
require_once("../config/db.php");
require_once("../model/Character.php");

//array asociativo en el que vamos a introducir todo lo que nos venga de la base de datos
$characters = [];

try {
    $stmt = $db->query("SELECT * FROM Characters");
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "ERROR: Ha ocurrido un error leyendo la base de datos " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $character = new Character($db);
    $character->setName($_POST['name']);
    $character->setDescription($_POST['description']);
    $character->setHealth($_POST['health']);
    $character->setStrength($_POST['strength']);
    $character->setDefense($_POST['defense']);

    if ($character->save()) {
        echo "Se ha guardado el personaje.";
    } else {
        echo "ERROR: No se ha guardado el personaje.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
    <!--Pequeña hoja de estilos para que se vea mejor la tabla y la pagina en general-->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            color: #009879;
        }

        form {
            margin-bottom: 30px;
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        form input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form button {
            background-color: #009879;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #007d63;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: center;
            font-weight: bold;
        }

        table th,
        table td {
            padding: 12px 15px;
            border: 1px solid #dddddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f3f3f3;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        table tbody td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include('./partials/_menu.php') ?>
    <h1>Crea tu personaje</h1>
    <form action=<?= $_SERVER['PHP_SELF'] ?> method="POST">
        <div id="nameDiv">
            <label for="nameInput">Nombre:</label>
            <input name="name" type="text" id="nameInput" placeholder="Nombre del personaje" required>
        </div>

        <div id="descriptionDiv">
            <label for="descriptionInput">Descripción:</label>
            <input name="description" type="text" id="descriptionInput" placeholder="Descripción del personaje" required>
        </div>

        <div id="healthDiv">
            <label for="healthInput">Vida:</label>
            <input name="health" type="number" id="healthInput" value="100" min="1" placeholder="Vida del personaje" required>
        </div>

        <div id="strengthDiv">
            <label for="strengthInput">Fuerza:</label>
            <input name="strength" type="number" id="strengthInput" value="10" min="1" placeholder="Fuerza del personaje" required>
        </div>

        <div id="defenseDiv">
            <label for="defenseInput">Defensa:</label>
            <input name="defense" type="number" id="defenseInput" value="10" min="1" placeholder="Defensa del personaje" required>
        </div>

        <button type="submit">Crear personaje</button>
    </form>

    <h1>Lista de personajes</h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>PV</th>
                <th>Fuerza</th>
                <th>Defensa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characters as $character): ?>
                <tr>
                    <td>Img</td>
                    <td><?= $character['name'] ?></td>
                    <td><?= $character['description'] ?></td>
                    <td><?= $character['health'] ?></td>
                    <td><?= $character['strength'] ?></td>
                    <td><?= $character['defense'] ?></td>
                    <td>
                        <form action="edit_character.php" method="GET">
                        <input type="hidden" name="id" value="<?= $character['id'] ?>">
                        <button type="submit">Editar</button>
                        </form>
                        <form action="delete_character.php" method="POST">
                            <input type="hidden" name="id" value="<?= $character['id'] ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>
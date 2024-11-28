<?php
require_once("../../config/db.php");

try {
    $stmt = $db->query("SELECT * FROM characters");
    $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los personajes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personajes</title>
</head>
<body>
    <h1>Lista de personajes</h1>
    <table border="1px">
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

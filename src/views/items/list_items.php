<?php
require_once("../../config/db.php");

try {
    $stmt = $db->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los ítems: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ítems</title>
</head>
<body>
<h1>Lista de items</h1>
    <table border="1px">
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
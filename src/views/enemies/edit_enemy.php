<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");

// Comprobamos si hemos recibido un 'id' a través de GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se ha recibido un ID válido.");
}

$enemyId = $_GET['id']; // Obtenemos el ID del enemigo desde la URL

// Intentamos obtener el enemigo de la base de datos
try {
    // Consulta para obtener los datos del enemigo
    $stmt = $db->prepare("SELECT * FROM enemies WHERE id = :id");
    $stmt->bindParam(':id', $enemyId, PDO::PARAM_INT);//nos aseguramos de que sea int el id introducido
    $stmt->execute();
    $enemy = $stmt->fetch(PDO::FETCH_ASSOC);//tenemos que usar el fetch unicamente porque el fetchAll nos devuelve un array y nos generaria un error
    if (!$enemy) {
        die("Enemigo no encontrado.");
    }

} catch (PDOException $e) {
    die("Error al obtener el enemigo: " . $e->getMessage());
}

// Si se envia por POST tenemos que procesar los datos que nos pasa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los valores del formulario
    $name = $_POST['name'];
    $description = $_POST['description'];
    $isBoss = isset($_POST['isBoss']) ? 1 : 0; // Verificamos si se marcó el checkbox
    $health = $_POST['health'];
    $strength = $_POST['strength'];
    $defense = $_POST['defense'];

    // Actualizamos los datos en la base de datos
    try {
        $stmt = $db->prepare("UPDATE enemies SET name = :name, description = :description, isBoss = :isBoss, health = :health, strength = :strength, defense = :defense WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':isBoss', $isBoss);
        $stmt->bindParam(':health', $health);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':defense', $defense);
        $stmt->bindParam(':id', $_GET['id']); // Usamos el metodo GET para obtener el ID 
        $stmt->execute();
        echo "Enemigo actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edita tu enemigo</title>
</head>

<body>
<?php include('../partials/_menu.php') ?>
    <h1>Editar Enemigo</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $enemyId ?>" method="POST">
    <div id="nameDiv">
        <label for="nameInput">Nombre:</label>
        <input name="name" type="text" id="nameInput" value="<?= $enemy['name'] ?>" placeholder="Nombre del enemigo" required>
    </div>

    <div id="descriptionDiv">
        <label for="descriptionInput">Descripción:</label>
        <input name="description" type="text" id="descriptionInput" value="<?= $enemy['description'] ?>" placeholder="Descripción del enemigo" required>
    </div>

    <div id="isBossDiv">
        <label for="isBossInput">¿Es un jefe?</label>
        <input name="isBoss" type="checkbox" id="isBossInput" value="1" <?= $enemy['isBoss'] ? 'checked' : '' ?>>
    </div>

    <div id="healthDiv">
        <label for="healthInput">Vida:</label>
        <input name="health" type="number" id="healthInput" value="<?= $enemy['health'] ?>" min="1" placeholder="Vida del enemigo" required>
    </div>

    <div id="strengthDiv">
        <label for="strengthInput">Fuerza:</label>
        <input name="strength" type="number" id="strengthInput" value="<?= $enemy['strength'] ?>" min="1" placeholder="Fuerza del enemigo" required>
    </div>

    <div id="defenseDiv">
        <label for="defenseInput">Defensa:</label>
        <input name="defense" type="number" id="defenseInput" value="<?= $enemy['defense'] ?>" min="1" placeholder="Defensa del enemigo" required>
    </div>

    <button type="submit">Actualizar enemigo</button>
</form>


</body>

</html>
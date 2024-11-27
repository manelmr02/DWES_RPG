<?php
require_once("../../config/db.php");
require_once("../../model/Character.php");

// Comprobamos si hemos recibido un 'id' a través de GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("No se ha recibido un ID válido.");
}

$characterId = $_GET['id']; // Obtenemos el ID del personaje desde la URL

// Intentamos obtener el personaje de la base de datos
try {
    // Consulta para obtener los datos del personaje
    $stmt = $db->prepare("SELECT * FROM characters WHERE id = :id");
    $stmt->bindParam(':id', $characterId, PDO::PARAM_INT);//nos aseguramos de que sea int el id introducido
    $stmt->execute();
    $character = $stmt->fetch(PDO::FETCH_ASSOC);//tenemos que usar el fetch unicamente porque el fetchAll nos devuelve un array y nos generaria un error
    if (!$character) {
        die("Personaje no encontrado.");
    }

} catch (PDOException $e) {
    die("Error al obtener el personaje: " . $e->getMessage());
}

// Si se envia por POST tenemos que procesar los datos que nos pasa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los valores del formulario
    $name = $_POST['name'];
    $description = $_POST['description']; 
    $health = $_POST['health'];
    $strength = $_POST['strength'];
    $defense = $_POST['defense'];

    // Actualizamos los datos en la base de datos
    try {
        $stmt = $db->prepare("UPDATE characters SET name = :name, description = :description, health = :health, strength = :strength, defense = :defense WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':health', $health);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':defense', $defense);
        $stmt->bindParam(':id', $_GET['id']); // Usamos el metodo GET para obtener el ID 
        $stmt->execute();
        echo "Personaje actualizado correctamente.";
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
    <title>Edita tu personaje</title>
</head>

<body>
<?php include('../partials/_menu.php') ?>
    <h1>Editar Personaje</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $characterId ?>" method="POST">
    <div id="nameDiv">
        <label for="nameInput">Nombre:</label>
        <input name="name" type="text" id="nameInput" value="<?= $character['name'] ?>" placeholder="Nombre del personaje" required>
    </div>

    <div id="descriptionDiv">
        <label for="descriptionInput">Descripción:</label>
        <input name="description" type="text" id="descriptionInput" value="<?= $character['description'] ?>" placeholder="Descripción del personaje" required>
    </div>

    <div id="healthDiv">
        <label for="healthInput">Vida:</label>
        <input name="health" type="number" id="healthInput" value="<?= $character['health'] ?>" min="1" placeholder="Vida del personaje" required>
    </div>

    <div id="strengthDiv">
        <label for="strengthInput">Fuerza:</label>
        <input name="strength" type="number" id="strengthInput" value="<?= $character['strength'] ?>" min="1" placeholder="Fuerza del personaje" required>
    </div>

    <div id="defenseDiv">
        <label for="defenseInput">Defensa:</label>
        <input name="defense" type="number" id="defenseInput" value="<?= $character['defense'] ?>" min="1" placeholder="Defensa del personaje" required>
    </div>

    <button type="submit">Actualizar personaje</button>
</form>


</body>

</html>
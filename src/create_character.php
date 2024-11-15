<?php
require_once("./config/db.php");
require_once("./model/Character.php");
//echo "<pre>";
//var_dump($_SERVER);
//echo"</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $character = new Character();
    $character->setName($_POST['name']);
    $character->setDescription($_POST['description']);
    //require_once 'config/db.php';

    $stmt = $db->prepare("INSERT INTO characters (name,description) VALUES (:name,:description)");
    $stmt->bindValue(':name', $character->getName());
    $stmt->bindValue(':description', $character->getDescription());

    if ($stmt->execute()) {
        echo "Personaje creado correctamente";
    } else {
        echo "ERROR: Personaje no creado";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>

<body>
    <h1>Crea tu personaje</h1>
    <form action="create_character.php" method="POST">
        <label for="nameInput">Nombre:</label>
        <input name="name" type="text" id="nameInput" placeholder="Nombre del personaje">
        <label for="descriptionInput">Descripción:</label>
        <input name="description" type="text" id="descriptionInput" placeholder="Descripción del personaje">
        <button type="submit">Crear personaje</button>
    </form>
</body>

</html>
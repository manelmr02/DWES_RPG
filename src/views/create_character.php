<?php
require_once("../config/db.php");
require_once("../model/Character.php");
//echo "<pre>";
//var_dump($_SERVER);
//echo"</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $character = new Character($db);
    $character->setName($_POST['name']);
    $character->setDescription($_POST['description']);
    $character->setHealth($_POST['health']);
    $character->setStrength($_POST['strength']);
    $character->setDefense($_POST['defense']);
    
    if($character->save()){
        echo "Se ha guardado el personaje.";
    }else{
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
</head>

<body>
    <h1>Crea tu personaje</h1>
    <form action="create_character.php" method="POST">
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
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>
<body>
    <h1>Crea tu personaje</h1>
    <form action="save_character.php" method="POST">
        <label for="nameInput">Nombre:</label>
        <input name="name" type="text" id="nameInput" placeholder="Nombre del personaje">
        <label for="descriptionInput">Descripción:</label>
        <input name="description" type="text" id="descriptionInput" placeholder="Descripción del personaje">
        <button type="submit">Crear personaje</button>
    </form>
</body>
</html>
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
        <label for="name">Nombre:</label>
        <input name="name" type="text" id="name" placeholder="Nombre del personaje">
        <label for="description">Descripción:</label>
        <input name="descripcion" type="text" id="description" placeholder="Descripción del personaje">
        <input type="submit">
    </form>
</body>
</html>
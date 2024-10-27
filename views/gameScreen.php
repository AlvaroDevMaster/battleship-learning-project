<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego Battleship</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
    <h1>Juego Battleship</h1>
    <?php if (isset($boardMarkup)) echo $boardMarkup; ?>
    <?php if (isset($message)) echo "<p>$message</p>"; ?>
    <form method="post">
        <label for="row">Fila:</label>
        <input type="text" id="row" name="row" required>
        <label for="column">Columna:</label>
        <input type="text" id="column" name="column" required>
        <input type="hidden" name="board" value="<?php echo $serializedBoard; ?>">
        <input type="hidden" name="hits" value="<?php echo $serializedHits; ?>">
        <br>
        <?php echo !($numberOfHitsNecessary === count($hits)) ? "<input type='submit' name='enviar' value='Disparar'>" : '' ?>
    </form>
    <form method="post">
        <input type="submit" name="reiniciar" value="Reiniciar">
    </form>
</body>
</html>

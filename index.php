<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("includes/vars.php");
include_once("controllers/generatePositionsController.php");
include_once("controllers/generateBoardController.php");
include_once("includes/functions.php");

// Reiniciar el juego si se presiona el botón "Reiniciar"
if (isset($_POST['reiniciar'])) {
    // Generar el tablero inicial y resetear los hits
    $positions = generatePositions($ships);
    $board = generateBoardArray($positions);
    $hits = [];

    // Serializar y codificar para el envío inicial
    $serializedBoard = encode($board);
    $serializedHits = encode($hits);
    $message = "¡Juego reiniciado!";

}
// Verificar si se recibe un tiro
else if (isset($_POST["board"], $_POST["row"], $_POST["column"])) {
    // Deserializar el tablero y los tiros
    $board = decode($_POST["board"]);
    $hits = isset($_POST["hits"]) ? decode($_POST["hits"]) : [];

    // Recuperar las coordenadas del tiro actual
    $row = convertRowLetterToIndex($_POST["row"]);
    $column = $_POST["column"] - 1;
    $shot = [$row, $column];

    if ($row === false || $column < 0 || $column > 9) {
        $message = 'Coordenadas inválidas. Intente de nuevo.';
    } else {
        // Verificar si el tiro ya fue hecho
        $shotExists = in_array($shot, $hits);

        if (!$shotExists) {
            // Agregar el tiro a los tiros previos
            if (isValidShot($shot, $boardSize)) {
                $hits[] = $shot;

                // Verificar si el tiro impacta un barco
                $isHit = $board[$row][$column] === 'S';

                // Actualizar el contenido del tablero
                $board[$row][$column] = $isHit ? 'S' : 'X'; // 'S' para barco, 'X' para agua
                $message = $isHit ? 'Le has acertado a un barco.' : 'Agua';
                $message .= $numberOfHitsNecessary === count($hits) ? "\n¡Has Ganado!" : '';
            } else {
                $message = 'Coordenadas invalidas.';
            }
        } else {
            $message = "Ya has introducido estas coordenadas anteriormente";
        }
    }
    // Serializar y codificar el tablero y los tiros actualizados
    $serializedBoard = encode($board);
    $serializedHits = encode($hits);
} else {
    // Generar el tablero inicial
    $positions = generatePositions($ships);
    $board = generateBoardArray($positions); // Crear el array del tablero inicial
    $hits = []; // Sin impactos aún

    // Serializar y codificar para el envío inicial
    $serializedBoard = encode($board);
    $serializedHits = encode($hits);
}

// Generar el HTML del tablero actualizado con los impactos
$boardMarkup = generateBoardHTMLMarkup($board, $hits);

// Incluir la vista del juego, pasando el tablero serializado
include_once("views/gameScreen.php");

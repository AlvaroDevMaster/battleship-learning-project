<?php
function generatePositions($ships){
$positions = [
    "portaaviones" => [],
    "acorazado" => [],
    "submarino" => [],
    "destructor" => []
]; // Guardar las posiciones de los barcos

foreach ($ships as $type => $numberOfShips) {
    for ($i = 1; $i <= $numberOfShips; $i++) {
        array_push($positions["$type"], addShip($type, $positions));
    }
}
return $positions;
}

function addShip($type, $positions) {
    $shipLength = 0;

    // Determina la longitud de el barco basado en el tipo
    switch ($type) {
        case "portaaviones":
            $shipLength = 5;
            break;
        case "acorazado":
            $shipLength = 4;
            break;
        case "submarino":
            $shipLength = 3;
            break;
        case "destructor":
            $shipLength = 2;
            break;
    }

    // Elegir orientacion de forma aleatoria: 1=>Izquierda, 2=>Arriba, 3=>Derecha, 4=>Abajo
    $orientation = rand(1, 4);

    // Obtener punto de origen valido
    list($row, $column) = getValidPosition($shipLength, $orientation);

    // Generate all positions of the ship
    $shipPositions = [];
    for ($i = 0; $i < $shipLength; $i++) {
        switch ($orientation) {
            case 1: // Left
                $shipPositions[] = [$row, $column - $i];
                break;
            case 2: // Top
                $shipPositions[] = [$row - $i, $column];
                break;
            case 3: // Right
                $shipPositions[] = [$row, $column + $i];
                break;
            case 4: // Down
                $shipPositions[] = [$row + $i, $column];
                break;
        }
    }

    // Check if the new ship overlaps with existing ones
    if (checkOverlap($shipPositions, $positions, $type)) {
        return addShip($type, $positions); // Vuelve a intentar asignar la posicion si hay solapacion
    }

    return $shipPositions;
}

// Generates random row/column positions within grid boundaries
function getValidPosition($shipLength, $orientation) {
    $row = rand(0, 9);
    $column = rand(0, 9);

    // Ajuste de el comienzo basado en la orientacion
    if ($orientation === 1 && $column - $shipLength < 0) { // Left
        $column = rand($shipLength - 1, 9);
    } elseif ($orientation === 2 && $row - $shipLength < 0) { // Top
        $row = rand($shipLength - 1, 9);
    } elseif ($orientation === 3 && $column + $shipLength > 9) { // Right
        $column = rand(0, 9 - $shipLength);
    } elseif ($orientation === 4 && $row + $shipLength > 9) { // Down
        $row = rand(0, 9 - $shipLength);
    }

    return [$row, $column];
}


//Buscar si hay solapacion en la colocacion de barcos
function checkOverlap($shipPositions, $positions, $type) {
    foreach ($shipPositions as $position) {
        if (array_search($position, $positions["$type"], true) !== false){
            return true;
        }
    }
    return false;
}

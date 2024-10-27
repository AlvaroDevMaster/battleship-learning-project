<?php
function encode($value){
    return base64_encode(serialize($value));
}

function decode($encodedValue){
    return unserialize(base64_decode($encodedValue));
}

function isValidShot($shot, $boardSize){
    $row = $shot[0];
    $column = $shot[1];
    return $row >= 0 && $row < $boardSize['rows'] && $column >= 0 && $column < $boardSize['columns'];
}

function convertRowLetterToIndex($row) {
    $row = strtoupper($row); // Aseguramos que sea mayúscula
    $rowLabels = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    return array_search($row, $rowLabels);
}

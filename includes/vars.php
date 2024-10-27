<?php
$ships = ['portaaviones' => 1, 'acorazado' => 1, 'submarino' => 2, 'destructor' => 1];

// Calcular el número de impactos necesarios automáticamente
$numberOfHitsNecessary = 0;
foreach ($ships as $type => $quantity) {
    switch ($type) {
        case 'portaaviones': $numberOfHitsNecessary += 5 * $quantity; break;
        case 'acorazado': $numberOfHitsNecessary += 4 * $quantity; break;
        case 'submarino': $numberOfHitsNecessary += 3 * $quantity; break;
        case 'destructor': $numberOfHitsNecessary += 2 * $quantity; break;
    }
}

$boardSize = ['rows'=> 10, 'columns'=> 10];
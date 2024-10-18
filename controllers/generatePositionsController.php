<?php
include_once("../includes/vars.php");
$positions = [];
foreach($ships as $type => $numberOfShips){
    array_push($postions, addShip($type, $numberOfShips));
}
function addShip($type, $numberOfShips){
    $shipLength = 0;
    switch($type){
        case "portaaviones": $shipLength = 5;
        break;
        case "acorazado": $shipLength = 4;
        break;
        case "submarino": $shipLength = 3;
        break; 
        case "destructor": $shipLength = 2;
    }
    return [];
}
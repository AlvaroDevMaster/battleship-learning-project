<?php
include_once("../includes/vars.php");
$positions = [];
foreach($ships as $type => $numberOfShips){
    for($i = 1; $i <= $numberOfShips; $i++)
    array_push($postions, addShip($type, $positions));
}
function addShip($type, $positions){
    $shipLength = 0;
    $row = 0;
    $column = 0;
    switch($type){
        case "portaaviones": $shipLength = 5;
        break;
        case "acorazado": $shipLength = 4;
        break;
        case "submarino": $shipLength = 3;
        break; 
        case "destructor": $shipLength = 2;
    };
    //Orientation Logic: 1=>Left,2=>Top,3=>Right,4=>Down 
    
    $orientation = rand(0,4);
    
    function getRandomRowsAndColumns(){
        $row = rand(0, 10);
        $column = rand(0, 10);
        return [$row, $column];
    }

    if($orientation === 2 || $orientation === 4){

    }
    else if($orientation === 1 || $orientation === 3){

    }
    return [];
}
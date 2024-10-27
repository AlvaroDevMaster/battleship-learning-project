<?php

function generateBoardArray($positions) {
    // Crear un tablero 10x10 lleno de agua ('~')
    $board = array_fill(0, 10, array_fill(0, 10, '~'));

    // Colocar los barcos en el tablero
    foreach ($positions as $ships) {
        foreach ($ships as $ship) {
            foreach ($ship as $pos) {
                $row = $pos[0];
                $col = $pos[1];
                $board[$row][$col] = 'S'; // Marca la posición del barco con 'S'
            }
        }
    }

    return $board;
}

function generateBoardHTMLMarkup($boardArray, $hits = []) {
    // Letras de las filas (A-J)
    $rowLabels = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

    $html = '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';

    // Generar la primera fila con los números de columna (1-10)
    $html .= '<tr><th></th>'; // Celda vacía en la esquina superior izquierda
    for ($colNum = 1; $colNum <= 10; $colNum++) {
        $html .= "<th>$colNum</th>"; // Cabecera con los números de las columnas
    }
    $html .= '</tr>';

    // Generar las filas con las letras y las posiciones del tablero
    for ($i = 0; $i < 10; $i++) {
        $html .= "<tr><th>{$rowLabels[$i]}</th>"; // Imprime la letra de la fila
        for ($j = 0; $j < 10; $j++) {
            $cellContent = $boardArray[$i][$j]; // '~' para agua, 'S' para barco
            $inputName = "board[{$rowLabels[$i]}][$j]"; // Nombre del input para el tiro

            // Determina qué mostrar en la celda según los impactos
            if (in_array([$i, $j], $hits)) {
                $displayContent = ($cellContent === 'S') ? 'B' : 'A'; // 'B' para barco, 'A' para agua
            } else {
                $displayContent = '-'; // Celdas no reveladas
            }

            $html .= "<td style='text-align: center;'>
                        <input type='hidden' name='$inputName' value='$cellContent' />
                        $displayContent
                      </td>";
        }
        $html .= '</tr>';
    }

    // Cerrar la tabla
    $html .= '</table>';

    return $html;
}


 


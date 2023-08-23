<?php
function columnToNumber($column) {
    $column = strtoupper($column); // Zamieniamy na wielkie litery, aby nie było zależności od wielkości liter
    $length = strlen($column);
    $result = 0;

    for ($i = 0; $i < $length; $i++) {
        $char = $column[$length - $i - 1];
        $value = ord($char) - ord('A') + 1; // Przekształcamy literę na numer 
        $result += $value;
    }

    return $result;
}

// Przykładowe użycie
$cell = "D42";
$column = substr($cell, 0, 1); // Pobieramy oznaczenie kolumny z komórki
$row = substr($cell, 1); // Pobieramy numer wiersza z komórki

$columnNumber = columnToNumber($column);
$result = $columnNumber . "." . $row;

echo "Wartość komórki $cell to: $result";
?>

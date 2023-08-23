<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .callendar {
            width: 50%;
            
        }
    </style>
<?php
function calendarHTML($month, $year) {
    $daysOfWeek = array("Pon", "Wt", "Śr", "Czw", "Pt", "Sob", "Niedz");
    $months = array( "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" );
    $firstDay = mktime(0, 0, 0, $month, 1, $year);
    $daysInMonth = date("t", $firstDay);
    $dayOfWeek = date("N", $firstDay);

    $html = "<div class='callendar'><table>";
    $html .= "<tr><h2>".$months[$month]." $year </h2><tr>";
    $html .= "<tr>";
    foreach ($daysOfWeek as $day) {
        if($day == "Niedz") {
            $html .= "<th style='color:red'>" . $day . "</th>";
        } else {
            $html .= "<th>" . $day . "</th>";
        }
        
    }
    $html .= "</tr>";

    $html .= "<tr>";
    for ($i = 1; $i < $dayOfWeek; $i++) {
        $html .= "<td></td>";
    }

    for ($day = 1; $day <= $daysInMonth; $day++) {
        if ($dayOfWeek > 7) {
            $dayOfWeek = 1;
            $html .= "</tr><tr>";
        }
        if($dayOfWeek == 7) {
            $html .= "<th style='color:red'>" . $day . "</th>";
        } else {
            $html .= "<th>" . $day . "</th>";
        }
        $dayOfWeek++;
    }

    while ($dayOfWeek <= 7) {
        $html .= "<td></td>";
        $dayOfWeek++;
    }

    $html .= "</tr>";
    $html .= "</table></div>";

    return $html;
}

$month = 8; // Przykładowy miesiąc (sierpień)
$year = 2023; // Przykładowy rok

echo calendarHTML($month, $year);
?>

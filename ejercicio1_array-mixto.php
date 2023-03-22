<?php
include('header.php');

$idiomas[0] = 'Inglés';
$idiomas[1] = 'Francés';
$idiomas[2] = 'Mandarin';
$idiomas[3] = 'Ruso';
$idiomas[4] = 'Portugues';
$idiomas[5] = 'Japones';

$alumnos = [
    'Basico' => [
        25, 10, 8, 12, 30, 90
    ],
    'Medio' => [
        15, 5, 4, 8, 15, 25
    ],
    'Avanzado' => [
        10, 2, 1, 4, 10, 67
    ]
];

echo '<h1 class="mb-3">Ejercicio 1 - Array Mixto</h1>';

echo '<table class="table table-light table-striped table-hover"> <thead><tr>';
echo '<th scope="col">Nivel</th>';
foreach ($idiomas as $idioma) {
    echo '<th scope="col">'. $idioma .'</th>';
}

echo '</tr></thead><tbody>';

foreach ($alumnos as $nivel => $alumnos_nivel) {
    echo '<tr>';
    echo '<th scope="row">'. $nivel .'</th>';
    foreach ($alumnos_nivel as $alumno) {
        echo '<td>'. $alumno .'</td>';
    }
    echo '</tr>';
}

echo '</tbody></table>';

include('footer.php');
?>
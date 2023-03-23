<?php
include('header.php');

$alumnos = [
    'Basico' => [
        'Ingles' => 25,
        'Frances' => 10,
        'Mandarin' => 8,
        'Ruso' => 12,
        'Portugues' => 30,
        'Japones' => 90
    ],
    'Medio' => [
        'Ingles' => 15,
        'Frances' => 5,
        'Mandarin' => 4,
        'Ruso' => 8,
        'Portugues' => 15,
        'Japones' => 25
    ],
    'Avanzado' => [
        'Ingles' => 10,
        'Frances' => 2,
        'Mandarin' => 1,
        'Ruso' => 4,
        'Portugues' => 10,
        'Japones' => 67
    ]
];

echo '<h1 class="mb-3">Ejercicio 1 - Array Asociativo</h1>';

echo '<table class="table table-light table-striped table-hover"> <thead><tr>';
echo '<th scope="col">Nivel</th>';
foreach ($alumnos['Basico'] as $idioma => $value) {
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

echo '</tbody></table></div>';

include('footer.php');
?>
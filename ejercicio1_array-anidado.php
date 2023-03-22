<?php
include('header.php');

$idiomas[0] = 'Inglés';
$idiomas[1] = 'Francés';
$idiomas[2] = 'Mandarin';
$idiomas[3] = 'Ruso';
$idiomas[4] = 'Portugues';
$idiomas[5] = 'Japones';

$niveles[0] = 'Básico';
$niveles[1]='Medio';
$niveles[2]='Avanzado';

$alumnosA[0][0] = 25; $alumnosA[0][1] = 10; $alumnosA[0][2] = 8; $alumnosA[0][3] = 12; $alumnosA[0][4] = 30; $alumnosA[0][5] = 90;
$alumnosA[1][0] = 15; $alumnosA[1][1] = 5; $alumnosA[1][2] = 4; $alumnosA[1][3] = 8; $alumnosA[1][4] = 15; $alumnosA[1][5] = 25;
$alumnosA[2][0] = 10; $alumnosA[2][1] = 2; $alumnosA[2][2] = 1; $alumnosA[2][3] = 4; $alumnosA[2][4] = 10; $alumnosA[2][5] = 67;

echo '<h1 class="mb-3">Ejercicio 1 - Array Anidado</h1>';

echo '<table class="table table-light table-striped table-hover"> <thead><tr>';
echo '<th scope="col">Nivel</th>';
foreach ($idiomas as $idioma) {
    echo '<th scope="col">'. $idioma .'</th>';
}

echo '</tr></thead><tbody>';

foreach ($alumnosA as $nivel_key => $alumnos) {
    echo '<tr>';
    echo '<th scope="row">'. $niveles[$nivel_key] .'</th>';
    foreach ($alumnos as $alumno) {
        echo '<td>'. $alumno .'</td>';
    }
    echo '</tr>';
}

echo '</tbody></table>';

include('footer.php');
?>
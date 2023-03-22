<?php
include('header.php');

$distance = null;
$vehicle = null;
$showResult = false;
$showError = false;
$result = '';
$vehicleR = '';
$resultText = '';

if (isset($_POST['enviar'])) {
    $distance = is_numeric($_POST['distance']) ? $_POST['distance'] : null;
    $vehicle = $_POST['vehicle'];

    if ($distance == null) {
        $showError = true;
        $result = 'Asegúrate de ingresar una distancia a recorrer.';
    } else {
        $showResult = true;
        $result = calculate($vehicle, $distance);
        $vehicleR = getVehicle($vehicle);
    }
}

function calculate($vehicle, $distance)
{
    $tempResult = null;
    switch ($vehicle) {
        case 'c5':
            $tempResult = $distance / 12;
            break;
        case 'c3':
            $tempResult = $distance / 16;
            break;
        case 'pi':
            $tempResult = $distance / 22;
            break;
        case 'pa':
            $tempResult = $distance / 28;
            break;
        case 'mo':
            $tempResult = $distance / 42;
            break;
    }

    return number_format($tempResult, 2);
}

function getVehicle($vehicle)
{
    switch ($vehicle) {
        case 'c5':
            return "Camión de 5 ton";
        case 'c3':
            return "Camión de 5 ton";
        case 'pi':
            return "PickUp";
        case 'pa':
            return "Panel";
        case 'mo':
            return "Moto";
    }
}
?>

<h1 class="pb-3">Transportes Salvador</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="mb-3">
        <label for="vehicle" class="form-label">Seleccione el tipo de vehículo a utilizar para la entrega:</label><br>
        <select class="form-select" id="vehicle" name="vehicle" aria-label="Default select example">
            <option value="c5" selected>Camión de 5 ton</option>
            <option value="c3">Camión de 3 ton</option>
            <option value="pi">PickUp</option>
            <option value="pa">Panel</option>
            <option value="mo">Moto</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="num" class="form-label">Ingrese la distancia en kilómetros a recorrer:</label><br>
        <input type="number" class="form-control" name="distance" step="0.01" value="<?= $distance ?>">
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <input type="submit" value="Calcular" class="btn btn-outline-dark fw-bold text-uppercase mt-3" name="enviar">
    </div>
</form>

<?php
if ($showResult) :
?>

    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Vehículo</th>
                    <th scope="col">Distancia (km)</th>
                    <th scope="col">Consumo (km/gal)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col"><?= $vehicleR ?></td>
                    <td scope="col"><?= $distance ?></td>
                    <td scope="col"><?= $result ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <p>
            En <?= strtolower($vehicleR) ?> entregará a <?= $distance ?> de distancia consumiendo <?= $result ?> galones.
        </p>
    </div>
    <script>
        document.getElementById('vehicle').value = '<?= $vehicle ?>';
    </script>

<?php
elseif ($showError) :
?>

    <div class="mt-3 text-danger">
        <?= $result ?>
    </div>

<?php
endif;
?>


<?php
include('footer.php');
?>
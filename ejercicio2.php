<?php
include('header.php');

$quantity = null;
$fromC = null;
$toC = null;
$showConversion = false;
$showError = false;
$unitFrom = '';
$unitTo = '';

if (isset($_POST['enviar'])) {
    $quantity = is_numeric($_POST['quantity']) ? $_POST['quantity'] : null;
    $fromC = $_POST['fromC'];
    $toC = $_POST['toC'];

    if ($fromC == $toC || $quantity == null) {
        $showError = true;
        $unitFrom = 'Asegúrate que las unidades seleccionadas sean diferentes y que la cantidad a convertir no sea nula.';
    } else {
        $showConversion = true;
        $unitFrom = getMeasurementText($fromC, $quantity);
        $unitTo = getMeasurementText($toC, convertTo(convertFromToM($quantity, $fromC), $toC));
    }
}

function convertFromToM($quantity, $fromCurrency)
{
    switch ($fromCurrency) {
        case 'm':
            return $quantity;
        case 'in':
            return 0.0254 * $quantity;
        case 'yd':
            return 0.9144 * $quantity;
        case 'ft':
            return 0.3048 * $quantity;
    }
}

function convertTo($quantity, $toCurrency)
{
    switch ($toCurrency) {
        case 'm':
            return $quantity;
        case 'in':
            return 39.3700787 * $quantity;
        case 'yd':
            return 1.0936133 * $quantity;
        case 'ft':
            return 3.2808399 * $quantity;
    }
}

function getMeasurementText($currency, $quantity)
{
    $tempText = null;
    switch ($currency) {
        case 'm':
            $tempText = "%c%m (metros)";
            break;
        case 'in':
            $tempText = "%c%in (pulgadas)";
            break;
        case 'yd':
            $tempText = "%c%yd (yardas)";
            break;
        case 'ft':
            $tempText = "%c%ft (pie)";
            break;
    }

    return str_replace('%c%', $quantity, $tempText);
}
?>

<h1 class="pb-3">Conversor de unidades</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="mb-3">
        <label for="" class="form-label">Ingrese la cantidad a convertir:</label><br>
        <input type="number" class="form-control" name="quantity" value="<?= $quantity ?>">
    </div>
    <div class="mb-2">
        <select class="form-select" id="fromC" aria-label="Default select example" name="fromC">
            <option value="m" selected>Metros</option>
            <option value="in">Pulgadas</option>
            <option value="yd">Yardas</option>
            <option value="ft">Pie</option>
        </select>
    </div>

    <button type="button" class="btn btn-secondary mb-2" onclick="switchB()">&#10606;</button>

    <div class="mb-2">
        <select class="form-select" id="toC" aria-label="Default select example" name="toC">
            <option value="m">Metros</option>
            <option value="in" selected>Pulgadas</option>
            <option value="yd">Yardas</option>
            <option value="ft">Pie</option>
        </select>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <input type="submit" value="Convertir" class="btn btn-outline-dark fw-bold text-uppercase mt-3" name="enviar">
    </div>
</form>

<?php
if ($showConversion) :
?>

    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Medida original</th>
                    <th scope="col">Medida convertida</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col"><?= $unitFrom ?></td>
                    <td scope="col"><?= $unitTo ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('fromC').value = '<?= $fromC ?>';
        document.getElementById('toC').value = '<?= $toC ?>';
    </script>

<?php
elseif ($showError) :
?>

    <div class="mt-3 text-danger">
        <?= $unitFrom ?>
    </div>

<?php
endif;
?>


<?php
include('footer.php');
?>
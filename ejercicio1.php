<?php
include('header.php');

$quantity = null;
$fromC = null;
$toC = null;
$showConversion = false;
$showError = false;
$currencyFrom = '';
$currencyTo = '';

if (isset($_POST['enviar'])) {
    $quantity = is_numeric($_POST['quantity']) ? $_POST['quantity'] : null;
    $fromC = $_POST['fromC'];
    $toC = $_POST['toC'];

    if ($fromC == $toC || $quantity == null) {
        $showError = true;
        $currencyFrom = 'Asegúrate que las monedas seleccionadas sean diferentes y que la cantidad a convertir no sea nula.';
    } else {
        $showConversion = true;
        $currencyFrom = getCurrencyText($fromC, $quantity);
        $currencyTo = getCurrencyText($toC, convertTo(convertFromToDolar($quantity, $fromC), $toC));
    }

}

function convertFromToDolar($quantity, $fromCurrency)
{
    switch ($fromCurrency) {
        case '$':
            return $quantity;
        case '€':
            return 1.07 * $quantity;
        case '¥':
            return 0.0075 * $quantity;
        case '£':
            return 1.20 * $quantity;
    }
}

function convertTo($quantity, $toCurrency)
{
    switch ($toCurrency) {
        case '$':
            return $quantity;
        case '€':
            return 0.93 * $quantity;
        case '¥':
            return 134.11 * $quantity;
        case '£':
            return 0.83 * $quantity;
    }
}

function getCurrencyText($currency, $quantity) {
    $tempText = null;
    switch ($currency) {
        case '$':
            $tempText = "$%c% Dolares americano";
            break;
        case '€':
            $tempText = "€%c% Euros";
            break;
        case '¥':
            $tempText = "¥%c% Yenes Japones";
            break;
        case '£':
            $tempText = "£%c% Libras esterlina";
            break;
    }

    return str_replace('%c%', $quantity, $tempText);
}
?>
<h1 class="pb-3">Conversor de monedas</h1>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="mb-3">
        <label for="" class="form-label">Ingrese la cantidad a convertir:</label><br>
        <input type="number" class="form-control" name="quantity" step="0.01" value="<?= $quantity ?>">
    </div>
    <div class="mb-2">
        <select class="form-select" id="fromC" aria-label="Default select example" name="fromC">
            <option value="$" selected>&#127482;&#127480; Dólar americano</option>
            <option value="€">&#127466;&#127482; Euro</option>
            <option value="¥">&#127471;&#127477; Yen Japonés</option>
            <option value="£">&#127468;&#127463; Libra Esterlina</option>
        </select>
    </div>

    <button type="button" class="btn btn-secondary mb-2" onclick="switchB()">&#10606;</button>

    <div class="mb-2">
        <select class="form-select" id="toC" aria-label="Default select example" name="toC">
            <option value="$">&#127482;&#127480; Dólar americano</option>
            <option value="€" selected>&#127466;&#127482; Euro</option>
            <option value="¥">&#127471;&#127477; Yen Japonés</option>
            <option value="£">&#127468;&#127463; Libra Esterlina</option>
        </select>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <input type="submit" value="Convertir" class="btn btn-outline-dark fw-bold text-uppercase mt-3" name="enviar">
    </div>
</form>

<?php
    if ($showConversion):
?>

<div class="mt-3">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Moneda original</th>
                <th scope="col">Moneda convertida</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="col"><?= $currencyFrom ?></td>
                <td scope="col"><?= $currencyTo ?></td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    document.getElementById('fromC').value = '<?= $fromC ?>';
    document.getElementById('toC').value = '<?= $toC ?>';
</script>

<?php
    elseif ($showError):
?>

<div class="mt-3 text-danger">
    <?= $currencyFrom ?>
</div>

<?php
endif;
?>

<?php
include('footer.php');
?>
<?php

if (isset($_POST['enviar'])) {
    $number = is_numeric($_POST['num']) ? isset($_POST['num']) : null;
    echo $number;
    if ($number != null) {
        $vehicle = $_POST['vehicle'];

        switch ($vehicle) {

            case "c5":
                $result = $number * 12;
                break;
            case "c3":
                $result = $number * 16;
                break;
            case "pi":
                $result = $number * 22;
                break;
            case "pa":
                $result = $number * 28;
                break;
            case "mo":
                $result = $number * 42;
                break;
            default:
        }
    }
    else {
        echo "Debe ingresar un dato númerico en los kilómetros a recorrer.";
    }
}

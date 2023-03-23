<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Color+Emoji&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <style>
    select {
      font-family: 'Noto Color Emoji', sans-serif !important;
    }
  </style>
  <title>Desafío 2</title>

  <script>
    window.addEventListener('popstate', function(event) {

      console.log(event.state);
    });

    function optSelected() {
      var path = window.location.pathname;
      console.log(path);
    }
  </script>
</head>

<body>
  <?php
  function getIfActive($file)
  {
    if ($_SERVER['PHP_SELF'] == "/$file") {
      return 'active';
    }

    return null;
  }
  ?>

  <div class="d-flex flex-column" style="min-height: 100vh">
    <nav class="navbar navbar-expand bg-light">
      <div class="container-fluid">
        <b>
          <a class="navbar-brand" href="index.php">Desafío 2</a>
        </b>
        <div class="" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?= getIfActive('ejercicio1_array-anidado.php') ?>" href="ejercicio1_array-anidado.php">Ejercicio 1: Array anidado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ejercicio1_array-asociativo.php">Ejercicio 1: Array-asociativo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="ejercicio1_array-mixto.php">Ejercicio 1: Array-mixto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= getIfActive('ejercicio2.php') ?>" href="ejercicio2.php">Ejercicio 2</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container text-center flex-grow-1 d-flex flex-column justify-content-center my-3">
      <div class="row d-flex justify-content-center">
        <div class="col-12 col-sm-11 col-md-8 text-center">
<?php
include('header.php');

session_start();

class Libro
{
    public $titulo;
    public $numero_Edicion;
    public $ciudad_Publicacion;
    public $editorial;
    public $edicion_Year;
    public $numero_Paginas;
    public $notas;
    public $isbn;

    public $autor;

    function addBook($titulo, $edicion, $ciudad, $editorial, $edicion_Year, $numero_Paginas, $notas, $isbn, $autor)
    {
        $this->titulo = $titulo;
        $this->numero_Edicion = $edicion;
        $this->ciudad_Publicacion = $ciudad;
        $this->editorial = $editorial;
        $this->edicion_Year = $edicion_Year;
        $this->numero_Paginas = $numero_Paginas;
        $this->notas = $notas;
        $this->isbn = $isbn;
        $this->autor = $autor;
    }
}

//$_SESSION['books'] = [];

if (isset($_SESSION['books'])) {
    $books = $_SESSION['books'];
} else {
    $books = [];
}

if (isset($_POST['enviar'])) {
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $numeroEdicion = isset($_POST['edicion']) ? $_POST['edicion'] : '';
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : '';
    $editorial = isset($_POST['editorial']) ? $_POST['editorial'] : '';
    $edicion_Year = isset($_POST['edicionYear']) ? $_POST['edicionYear'] : '';
    $numero_Paginas = isset($_POST['numeroPaginas']) ? $_POST['numeroPaginas'] : '';
    $notas = isset($_POST['notas']) ? $_POST['notas'] : '';
    $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
    $autores = isset($_POST['autores']) ? $_POST['autores'] : [];

    $validationResult = validateData($titulo, $numeroEdicion, $ciudad, $editorial, $edicion_Year, $numero_Paginas, $notas, $isbn, $autores);

    if ($validationResult == "") {
        $newBook = new Libro();
        $newBook->addBook($titulo, $numeroEdicion, $ciudad, $editorial, $edicion_Year, $numero_Paginas, $notas, $isbn, $autores);
        array_push($books, $newBook);
    } else {
        echo $validationResult;
    }
}

function validateData($titulo, $numeroEdicion, $ciudad, $editorial, $edicion_Year, $numero_Paginas, $notas, $isbn, $autores) {
    $errorMessage = "";
    $wordsDigits = "/([^a-zA-Z&.,\d\s])/";
    $digits = "/[^\d]/";

    $errorMessage .= regexValidation($wordsDigits, $titulo, 'titulo');
    $errorMessage .= regexValidation($wordsDigits, $editorial, 'editorial');
    $errorMessage .= regexValidation($wordsDigits, $ciudad, 'lugar de publicacion');
    $errorMessage .= regexValidation($digits, $numero_Paginas, 'número de página', 'deben ser solo digitos');
    $errorMessage .= regexValidation($digits, $edicion_Year, 'año de edición', 'deben ser solo digitos');
    $errorMessage .= regexValidation($digits, $numeroEdicion, 'número de edición', 'deben ser solo digitos');
    $errorMessage .= regexValidation($digits, $isbn, 'ISBN', 'deben ser solo digitos');

    if (strlen((string)$isbn) != 13) {
        $errorMessage .= 'El ISBN debe de ser 13 digitos de largo.<br>';
    }

    if ($autores == null) {
        $errorMessage .= "Debe seleccionar al menos un autor. <br>";
    }

    return $errorMessage;
}

function regexValidation($patron, $valor, $nombre, $tipo = "no son permitidos") {
    if(preg_match($patron, $valor) > 0) {
        return "Los carácteres en el $nombre $tipo. <br>";
    }
    return "";
}

$_SESSION['books'] = $books;
?>

<script src="script.js"></script>

<h1 class="my-4">Inventario de biblioteca</h1>

<form name="frmLibros" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <h5 class="pb-2 text-uppercase">Agregar autores</h5>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="nombres" placeholder="Juan">
        <label for="nombres">Nombres del autor</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="apellidos" placeholder="Flores">
        <label for="apellidos">Apellidos del autor</label>
    </div>

    <div class="d-flex justify-content-end">
        <div class="row">
            <div class="col-12">
                    <input type="reset" value="Agregar autor" id="agregarAutor" class="btn btn-outline-dark fw-bold text-uppercase mt-3 px-5" name="agregar">
            </div>
        </div>
    </div>


    <h5 class="pb-2 mt-4 text-uppercase">Agregar libros</h5>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="titulo" placeholder="Juan Salvador Gaviota" name="titulo">
        <label for="titulo">Título del libro</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="edicion" placeholder="3" name="edicion">
        <label for="edicion">Número de edición</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="ciudad" placeholder="Nueva York" name="ciudad">
        <label for="ciudad">Lugar de publicación</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="editorial" placeholder="B&B Editorial" name="editorial">
        <label for="editorial">Editorial</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="edicionYear" placeholder="2005" name="edicionYear">
        <label for="edicionYear">Año de la edición</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numeroPaginas" placeholder="248" name="numeroPaginas">
        <label for="numeroPaginas">Número de páginas</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="notas" placeholder="Libro para principiantes" name="notas">
        <label for="notas">Notas</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="isbn" placeholder="2837 2189 31321" name="isbn">
        <label for="isbn">ISBN</label>
    </div>

    <div class="mb-2">
        <select class="form-select" id="autores" name="autores[]" multiple>
        </select>
    </div>

    <div class="d-flex justify-content-end">
        <div class="row">
<div class="col-12">
    <input type="submit" value="Agregar registro" class="btn btn-outline-dark fw-bold text-uppercase mt-3 px-5" name="enviar">
</div>
</div>
    </div>
</form>
</div>
<div class="mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Título de libro</th>
                <th scope="col">Número de edición</th>
                <th scope="col">Lugar de edición</th>
                <th scope="col">Editorial</th>
                <th scope="col">Año de la edición</th>
                <th scope="col">Número de páginas</th>
                <th scope="col">Notas</th>
                <th scope="col">ISBN</th>
                <th scope="col">Autor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                foreach ($books as $book) {
                    echo '<tr>';
                    echo '<td scope="col"> '.$book->titulo.' </td>';
                    echo '<td scope="col"> '.$book->numero_Edicion.' </td>';
                    echo '<td scope="col"> '.$book->ciudad_Publicacion.' </td>';
                    echo '<td scope="col"> '.$book->editorial.' </td>';
                    echo '<td scope="col"> '.$book->edicion_Year.' </td>';
                    echo '<td scope="col"> '.$book->numero_Paginas.' </td>';
                    echo '<td scope="col"> '.$book->notas.' </td>';
                    echo '<td scope="col"> '.$book->isbn.' </td>';
                    echo '<td scope="col"> ';
                    foreach ($book->autor as $autor) {
                        echo $autor." - ";
                    }
                    echo ' </td>';
                    echo '</tr>';
                }
                ?>
            </tr>
        </tbody>
    </table>
</div>

<?php

include('footer.php');
?>
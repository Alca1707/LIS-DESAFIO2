<?php
include('header.php');

session_start();

class Libro {
    public $titulo;
    private $numero_Edicion;
    private $ciudad_Publicacion;
    private $editorial;
    private $edicion_Year;
    private $numero_Paginas;
    private $notas;
    private $isbn;

    private $autor;

    function addBook($titulo, $edicion, $ciudad) {
        $this->titulo = $titulo;
        $this->numero_Edicion = $edicion;
        $this->ciudad_Publicacion = $ciudad;
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
    $numeroEdicion = isset($_POST['edicion']);
    $ciudad = isset($_POST['ciudad']);

    $newBook = new Libro();
    $newBook->addBook($titulo, $numeroEdicion, $ciudad);

    array_push($books, $newBook);
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

    <div class="d-grid gap-2 col-6 mx-auto">
        <input type="reset" value="Agregar autor" id="agregarAutor" class="btn btn-outline-dark fw-bold text-uppercase mt-3" name="agregar">
    </div>


    <h5 class="pb-2 mt-4 text-uppercase">Agregar libros</h5>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="titulo" placeholder="Juan Salvador Gaviota" name="titulo">
        <label for="titulo">Titulo del libro</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="edicion" placeholder="3">
        <label for="edicion">Numero de edicion</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="ciudad" placeholder="Nueva York">
        <label for="ciudad">Lugar de publicacion</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="editorial" placeholder="B&B Editorial">
        <label for="editorial">Editorial</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="edicionYear" placeholder="2005">
        <label for="edicionYear">Ano de la edicion</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" id="numeroPaginas" placeholder="248">
        <label for="numeroPaginas">Numero de paginas</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="notas" placeholder="Libro para principiantes">
        <label for="notas">Notas</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="isbn" placeholder="2837 2189 31321">
        <label for="isbn">ISBN</label>
    </div>

    <div class="mb-2">
        <select class="form-select" id="autores" name="autores[]" multiple>
        </select>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
        <input type="submit" value="Agregar registro" class="btn btn-outline-dark fw-bold text-uppercase mt-3" name="enviar">
    </div>
</form>

    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titulo de libro</th>
                    <th scope="col">Numero de edicion</th>
                    <th scope="col">Lugar de edicion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                        <?php
                            echo '<td scope="col">';
                                foreach ($books as $book) {
                            echo $book->titulo;
                        }
                            echo '</td>';
                        ?>
                </tr>
            </tbody>
        </table>
    </div>

<?php
include('footer.php');
?>
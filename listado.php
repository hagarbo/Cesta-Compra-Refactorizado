<?php
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (!is_user_logged()) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
}

if (isset($_POST['comprar'])) {
    $datos = consultar_producto($_POST['id']);
    if ($datos !== false) {
        $_SESSION['cesta'][$datos->id] = $datos->id;
        gestionar_cookie_familia($datos->familia);
    }
}

// CARGAMOS EL HEADER
$contador_cesta = isset($_SESSION['cesta']) ? count($_SESSION['cesta']) : 0;
$title = "Listado de productos";
require_once "templates/header.php";
?>


<h4 class="container text-center mt-4 font-weight-bold">Tienda onLine</h4>
<div class="container mt-3">
    <form class="form-inline" name="vaciar" method="POST" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <a href="cesta.php" class="btn btn-success mr-2">Ir a Cesta</a>
        <input type='submit' value='Vaciar Carro' class="btn btn-danger" name="vaciar">
    </form>
    <?php mostrar_productos(); ?>
</div>
</body>

</html>
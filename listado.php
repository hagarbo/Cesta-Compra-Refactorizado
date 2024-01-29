<?php
//session_start();
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (!is_user_logged()) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['vaciar'])) {
    vaciar_carrito();
}

if (isset($_POST['comprar'])) {
    $product_id = $_POST['id'];
    $unidades =  intval($_POST['unidades']);

    $suma_unidades = isset($_SESSION['cesta'][$product_id]) ? $unidades + $_SESSION['cesta'][$product_id] : $unidades;
    if (!comprobar_unidades($suma_unidades)) error('Valor incorrecto del campo unidades - El límite son 3 unidades!!!', "listado");

    $datos = consultar_producto($product_id);
    if ($datos !== false) {
        if (!isset($_SESSION['cesta'][$datos->id]))
            gestionar_cookie_familia($datos->familia);
        $_SESSION['cesta'][$datos->id] = $suma_unidades;
    }
}

// CARGAMOS EL HEADER
$title = "Listado de productos";
require_once "templates/header.php";
?>


<h4 class="container text-center mt-4 font-weight-bold">Tienda onLine</h4>
<div class="container mt-3">
    <form class="form-inline" name="vaciar" method="POST" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <a href="cesta.php" class="btn btn-success mr-2">Ir a Cesta</a>
        <input type='submit' value='Vaciar Carro' class="btn btn-danger" name="vaciar">
    </form>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='mt-3 text-danger font-weight-bold text-lg'>";
        echo $_SESSION['error'];
        unset($_SESSION['error']);
        echo "</div>";
    }
    mostrar_productos();
    ?>
</div>
</body>

</html>
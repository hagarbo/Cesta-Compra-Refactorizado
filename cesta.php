<?php
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (!is_user_logged()) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['cesta'])) {
    foreach ($_SESSION['cesta'] as $k => $v) {
        $producto = consultar_producto($k);
        $listado[$k] = [$producto->nombre, $producto->pvp];
        $producto = null;
    }
}

// CARGAMOS EL HEADER
$contador_cesta = isset($_SESSION['cesta']) ? count($_SESSION['cesta']) : 0;
$title = "Cesta de la compra";
require_once "templates/header.php";
?>

<h4 class="container text-center mt-4 font-weight-bold">Comprar Productos</h4>
<div class="container mt-3">
    <div class="card text-white bg-success mb-3 m-auto" style="width:40rem">
        <div class="card-body">
            <h5 class="card-title"><i class="fa fa-shopping-cart mr-2"></i>Carrito</h5>
            <?php mostrar_cesta($listado); ?>
            <a href="listado.php" class="btn btn-primary mr-2">Volver</a>
            <a href="pagar.php" class="btn btn-danger">Pagar</a>
        </div>
    </div>
</div>
</body>

</html>
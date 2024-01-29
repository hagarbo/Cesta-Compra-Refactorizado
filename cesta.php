<?php
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (!is_user_logged()) {
    header("Location: login.php");
    exit;
}
$listado = array();
if (isset($_SESSION['cesta'])) {

    foreach ($_SESSION['cesta'] as $product_id => $unidades) {
        $producto = consultar_producto($product_id);
        $listado[$product_id] = [
            'product_name' => $producto->nombre,
            'product_price' => $producto->pvp,
            'product_units' => $unidades
        ];
        $producto = null;
    }
}

// CARGAMOS EL HEADER

$title = "Cesta de la compra";
require_once "templates/header.php";
?>

<h4 class="container text-center mt-4 font-weight-bold">Comprar Productos</h4>
<div class="container mt-3">
    <div class="card text-white bg-success mb-3 m-auto" style="width:50rem">
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
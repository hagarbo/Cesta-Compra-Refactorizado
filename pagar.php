<?php
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (!is_user_logged()) {
    header("Location: login.php");
    exit;
}

// CARGAMOS EL HEADER
$title = "Pagar";
require_once "templates/header.php";
?>


<h4 class="container text-center mt-4 font-weight-bold">Tienda onLine</h4>
<div class="container">
    <p class="font-weight-bold">Pedido realizado Correctamente.</p>
    <a href="listado.php" class="btn btn-info mt-3">Hacer otra Compra</a>
    <?php
    mostrar_familias();
    vaciar_carrito();
    ?>
</div>

</body>

</html>
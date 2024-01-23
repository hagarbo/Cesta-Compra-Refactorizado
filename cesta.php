<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
}

require_once 'model/db_functions.php';

if (isset($_SESSION['cesta'])) {
    foreach ($_SESSION['cesta'] as $k => $v) {
        $producto = consultarProducto($k);
        $listado[$k] = [$producto->nombre, $producto->pvp];
        $producto = null;
    }
}

$contador_cesta = isset($_SESSION['cesta'])? count($_SESSION['cesta']):0;

$title = "Cesta de la compra";
require_once "templates/header.php";
?>

<body style="background: gray">
<div class="float float-right d-inline-flex mt-2">
    <i class="fa fa-shopping-cart mr-2 fa-2x"></i>
    <input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='<?php echo $contador_cesta;?>' size='2px'>
    <i class="fas fa-user mr-3 fa-2x"></i>
    <input type="text" size='10px' value="<?php echo $_SESSION['nombre']; ?>"
           class="form-control mr-2 bg-transparent text-white" disabled>
    <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
</div>
<br>
<h4 class="container text-center mt-4 font-weight-bold">Comprar Productos</h4>
<div class="container mt-3">
    <div class="card text-white bg-success mb-3 m-auto" style="width:40rem">
        <div class="card-body">
            <h5 class="card-title"><i class="fa fa-shopping-cart mr-2"></i>Carrito</h5>
            <?php
            if (!isset($_SESSION['cesta'])) {
                echo "<p class='card-text'>Carrito Vacio</p>";
            } else {
                $total = 0;
                echo "<p class='card-text'>";
                echo "<ul>";
                foreach ($listado as $k => $v) {
                    echo "<li>$v[0], PVP ($v[1]) €.</li>";
                    $total += $v[1];
                }
                echo "</ul></p>";
                echo "<hr style='border:none; height:2px; background-color: white'>";
                echo "<p class='card-text'><b>Total:</b><span class='ml-3'>$total (€)</span></p>";
            }
            ?>
            <a href="listado.php" class="btn btn-primary mr-2">Volver</a>
            <a href="pagar.php" class="btn btn-danger">Pagar</a>
        </div>
    </div>
</div>
</body>
</html>


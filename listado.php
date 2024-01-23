<?php
session_start();

function mostrar_productos()
{
    $filas = getProductList();
    foreach ($filas as $key => $value) {
        echo "<tr><th scope='row' class='text-center'>";
        echo "<form action='{$_SERVER['PHP_SELF']}' method='POST'>";
        echo "<input type='hidden' name='id' value='{$value->id}'>";
        echo "<input type='submit' class='btn btn-primary' name='comprar' value='Añadir'>";
        echo "</form>";
        echo "</th>";
        echo "<td>{$value->nombre}, Precio: {$value->pvp} (€)</td>";
        echo "<td class='text-center'>";
        echo isset($_SESSION['cesta'][$value->id]) ?
            "<i class='fas fa-check fa-2x'></i>" : "<i class='far fa-times-circle fa-2x'></i>";
        echo "<td>";
        echo "</tr>";
    }
}

if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
}
require_once 'model/db_functions.php';

if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
}
if (isset($_POST['comprar'])) {
    $datos = consultarProducto($_POST['id']);
    if ($datos !== false) {
        $_SESSION['cesta'][$datos->id] = $datos->id;
    }
}

$contador_cesta = isset($_SESSION['cesta'])? count($_SESSION['cesta']):0;

$title = "Listado de productos";
require_once "templates/header.php";
?>

<body style="background: gray">
    <div class="float float-right d-inline-flex mt-2">
        <i class="fa fa-shopping-cart mr-2 fa-2x"></i>
        <input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='<?php echo $contador_cesta;?>' size='2px'>
        <i class="fas fa-user mr-3 fa-2x"></i>
        <input type="text" size='10px' value="<?php echo $_SESSION['nombre']; ?>" class="form-control
    mr-2 bg-transparent text-white" disabled>
        <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
    </div>
    <br>
    <h4 class="container text-center mt-4 font-weight-bold">Tienda onLine</h4>
    <div class="container mt-3">
        <form class="form-inline" name="vaciar" method="POST" action='<?php echo $_SERVER['PHP_SELF']; ?>'>
            <a href="cesta.php" class="btn btn-success mr-2">Ir a Cesta</a>
            <input type='submit' value='Vaciar Carro' class="btn btn-danger" name="vaciar">
        </form>
        <table class="table table-striped table-dark mt-3">
            <thead>
                <tr class="text-center">
                    <th scope="col">Añadir</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Añadido</th>
                </tr>
            </thead>
            <tbody>
                <?php mostrar_productos(); ?>
            </tbody>
        </table>

    </div>
</body>

</html>
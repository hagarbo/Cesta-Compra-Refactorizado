<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location:login.php');
}
$title = "Pagar";
require_once "templates/header.php";
?>
<body style="background: grey">
<div class="float float-right d-inline-flex mt-2">
    <i class="fas fa-user mr-3 fa-2x"></i>
    <input type="text" size='10px' value="<?php echo $_SESSION['nombre']; ?>" class="form-control
    mr-2 bg-transparent text-white" disabled>
    <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
</div>
<br>
<h4 class="container text-center mt-4 font-weight-bold">Tienda onLine</h4>
<div class="container">
    <p class="font-weight-bold">Pedido realizado Correctamente.</p>
    <a href="listado.php" class="btn btn-info mt-3">Hacer otra Compra</a>
</div>

</body>
</html>

<?php

const CART_FILES = ["listado.php", "cesta.php"];
const NO_HEADER_FILES = ["login.php"];
$contador_cesta = isset($_SESSION['cesta']) ? array_sum($_SESSION['cesta']) : 0;

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- css para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- css Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>
        <?php echo $title; ?>
    </title>
</head>


<?php
$current_file = basename($_SERVER['PHP_SELF'], '');
if (!in_array($current_file, NO_HEADER_FILES)) :
?>

    <body style="background: gray">
        <div class="float float-right d-inline-flex mt-2">
            <?php
            if (in_array($current_file, CART_FILES)) :
            ?>
                <i class="fa fa-shopping-cart mr-2 fa-2x"></i>
                <input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='<?php echo $contador_cesta; ?>' size='2px'>
            <?php endif; ?>

            <i class="fas fa-user mr-3 fa-2x"></i>
            <input type="text" size='10px' value="<?php echo $_SESSION['nombre']; ?>" class="form-control mr-2 bg-transparent text-white" disabled>
            <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
        </div>
        <br>
    <?php endif; ?>
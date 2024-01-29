<?php
const DURATION_COOKIE_FAMILIAS = 60 * 60 * 24 * 30;
const SESSION_VAR_NAME = "nombre";

/*****************************************************************/
/*****************************************************************/
/*************** SESIONES Y COOKIES ******************************/
/*****************************************************************/
/*****************************************************************/

function cerrar_sesion()
{

    //Tal y como se recomienda en https://www.php.net/manual/es/function.session-destroy.php
    iniciar_sesion();

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy();
}

function is_user_logged(): bool
{
    $autenticado = iniciar_sesion() && (session_status() === PHP_SESSION_ACTIVE) && isset($_SESSION[SESSION_VAR_NAME]);
    return $autenticado;
}

//Si se realizan dos llamadas seguidas a session_start(), se producira un mensaje de E_NOTICE A session had already been started
//Comprobamos si ya hay una sesión iniciada previamente
function iniciar_sesion(): bool
{
    $iniciada = true;
    if (session_status() !== PHP_SESSION_ACTIVE) {
        $iniciada = session_start();
    }
    return $iniciada;
}

function gestionar_cookie_familia(string $cod_familia)
{

    if (!isset($_COOKIE["familias"])) {
        setcookie("familias[0]", $cod_familia, time() + DURATION_COOKIE_FAMILIAS);
    } else {
        $familias_array = $_COOKIE["familias"];
        $count_familias = count($familias_array);
        $index_or_found = array_search($cod_familia, $familias_array);
        if ($index_or_found === false) {
            //non existe a familia
            setcookie("familias[$count_familias]", $cod_familia, time() + DURATION_COOKIE_FAMILIAS);
        }
    }
}


/*****************************************************************/
/*****************************************************************/
/*************** MOSTRAR ELEMENTOS HTML***************************/
/*****************************************************************/
/*****************************************************************/

function mostrar_familias()
{
    if (isset($_COOKIE["familias"])) {
        $familias_array = $_COOKIE["familias"];
        echo "<p> Quizá también te interesen productos de estas categorías...</p>";
        echo "<ul>";
        foreach ($familias_array as $index => $cod_familia) {
            echo "<li>$cod_familia</li>";
        }
        echo "</ul>";
    }
}

function mostrar_productos()
{
    $filas = get_product_list();
    echo '<table class="table table-striped table-dark mt-3">
            <thead>
                <tr class="text-center">
                    <th scope="col">Añadir</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Añadido</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($filas as $key => $value) {
        echo "<tr><th scope='row' class='text-center'>";
        echo "<form action='{$_SERVER['PHP_SELF']}' method='POST' id='form-{$value->id}'>";
        echo "<input type='hidden' name='id' value='{$value->id}'>";
        echo "<input type='submit' class='btn btn-primary' name='comprar' value='Añadir'>";
        echo "</form>";
        echo "</th>";
        echo "<td>{$value->nombre}, Precio: {$value->pvp} (€)</td>";
        echo "<td><input type='number' name='unidades' value='1' form='form-{$value->id}' min='1' max='3'/></td>";
        echo "<td class='text-center'>";
        echo isset($_SESSION['cesta'][$value->id]) ?
            "<i class='fas fa-check fa-2x'></i>" : "<i class='far fa-times-circle fa-2x'></i>";
        echo "<td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
}

function mostrar_cesta(array $cesta)
{
    if (!isset($_SESSION['cesta'])) {
        echo "<p class='card-text'>Carrito Vacio</p>";
    } else {
        $total = 0;
        echo '<table class="table table-striped mt-3">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio Unidad</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($cesta as $product_id => $datos) {
            $subtotal = $datos['product_price'] * $datos['product_units'];
            $total += $subtotal;

            echo "<tr>";
            echo "<td>{$datos['product_name']}</td>";
            echo "<td>" . number_format($datos['product_price'], 2, '.', ',') . " €</td>";
            echo "<td>{$datos['product_units']}</td>";
            echo "<td>" . number_format($subtotal, 2, '.', ',') . " €</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "<hr style='border:none; height:2px; background-color: white'>";
        echo "<p class='card-text'><b>Total:</b><span class='ml-3'>" . number_format($total, 2, '.', ',') . " (€)</span></p>";
    }
}

function error(string $mensaje, string $location)
{
    $_SESSION['error'] = $mensaje;
    header("Location:$location.php");
    die();
}

function comprobar_unidades(int $unidades): bool
{
    return $unidades >= 1 && $unidades <= 3;
}

function vaciar_carrito()
{
    if (isset($_SESSION['cesta']))
        unset($_SESSION['cesta']);
}

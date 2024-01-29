<?php
require_once 'model/db_functions.php';
require_once 'util/util.php';

if (is_user_logged()) {
    header("Location: listado.php");
    exit;
}

// Intentamos hacer el login
if (isset($_POST['login'])) {
    $nombre = trim($_POST['usuario']);
    $pass = trim($_POST['pass']);
    if (strlen($nombre) == 0 || strlen($pass) == 0) {
        error("Error, El nombre o la contraseña no pueden contener solo espacios en blancos.", "login");
    }

    if (validate_user($nombre, $pass) == false) {
        unset($_POST['login']);
        error("Error, Nombre de usuario o password incorrecto", "login");
    }

    //Nos hemos validado correctamente creamos la sesion de usuario con el nombre de usuario

    $_SESSION['nombre'] = $nombre;
    header('Location:listado.php');
}

$title = "Login";
require_once "templates/header.php";
?>

<body style="background:silver;">
    <div class="container mt-5">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form name='login' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="usuario" name='usuario' required>

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="contraseña" name='pass' required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right btn-success" name='login'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='mt-3 text-danger font-weight-bold text-lg'>";
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>
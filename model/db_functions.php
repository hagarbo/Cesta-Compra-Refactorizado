<?php

require_once "conexion.php";

function consultarProducto($id)
{
    $conn = getConnection();
    $consulta = "select * from productos where id=:i";
    $stmt = $conn->prepare($consulta);
    try {
        $stmt->execute([':i' => $id]);
    } catch (PDOException $ex) {
        die("Error al recuperar Productos: " . $ex->getMessage());
    }
    //esta consulta solo devuelve una fila es innecesario el while para recorrerla
    $producto = $stmt->fetch(PDO::FETCH_OBJ);
    $stmt = null;
    return $producto;
}

function getProductList(): array
{
    $result = array();
    try {
        $conn = getConnection();
        $consulta = "select id, nombre, pvp from productos order by nombre";
        $stmt = $conn->prepare($consulta);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $ex) {
        cerrarTodo($conn, $stmt);
        die("Error al recuperar los productos " . $ex->getMessage());
    }
    cerrarTodo($conn, $stmt);
    return $result;
}


function validate_user(string $nombre, string $pass) : bool{
    //creamos el sha256 de la contraseña que es como se almacena en mysql
    $is_valid_user = false;
    $hashed_pass = hash('sha256', $pass);    
    try {
        $conn = getConnection();
        $consulta = "select * from usuarios where usuario=:u AND pass=:p";
        $stmt = $conn->prepare($consulta);
        $stmt->execute([
            ':u' => $nombre,
            ':p' => $hashed_pass
        ]);
    } catch (PDOException $ex) {
        cerrarTodo($conProyecto, $stmt);
        die("Error en la consulta a la base de datos.".$ex->getMessage());
    }
    if ($stmt->rowCount() != 0)
        $is_valid_user = true;
    cerrarTodo($conProyecto, $stmt);
    return $is_valid_user;
}
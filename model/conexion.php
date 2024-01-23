<?php

const SETTINGS_DB_FILE = __DIR__.DIRECTORY_SEPARATOR."../config/db_settings.ini";

/**
 * Summary of getConnection
 * Crea un objeto PDO
 * @return PDO|null un objeto PDO si ha habido éxito creando la conexión, null en caso contrario
 */
function getConnection()
{
    //APARTADO NUMERO 1
    if (!$settings = parse_ini_file(SETTINGS_DB_FILE, true))
        throw new Exception("ERROR : Unable to open " . SETTINGS_DB_FILE);
    $con = null;
    $driver = $settings["database"]["driver"];
    $host = $settings["database"]["host"];
    $db = $settings["database"]["schema"];
    $user = $settings["database"]["username"];
    $pass = $settings["database"]["password"];
    $charset = $settings["database"]["charset"];
    $dsn = $driver.":host=$host;dbname=$db;charset=$charset";
    $persistent = $settings["database"]["persistent"];

    try {

        $con = new PDO($dsn, $user, $pass,  array(
            PDO::ATTR_PERSISTENT => $persistent
        ));

        //Esto no hace falta en versión PHP 8 y superiores: https://www.php.net/manual/en/pdo.error-handling.php
        //PDO::ERRMODE_EXCEPTION: As of PHP 8.0.0, this is the default mode.
        //$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {

        echo "Error en la conexión: mensaje: " . $ex->getMessage();
    }
    return $con;
}
function cerrar(&$con){
    $con = null;
}
function cerrarTodo(&$con, &$st){
    $st = null;
    $con = null;
}
<?php
$host = "localhost";
$db_name = "sistema_inventario,sql";
$username = "root";
$password = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, $password, $db_name);
    $conn->set_charset("utf8");
} catch (mysqli_sql_exception $e) {
    // Esto nos mostrará el motivo exacto del fallo en pantalla
    die("Error detallado de conexión: " . $e->getMessage());

}
?>


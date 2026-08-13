<?php

session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Conectar con la base de datos
require_once 'conexion.php';

// Verificar que los datos lleguen mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Capturar y limpiar los datos
    $empresa = trim($_POST['empresa']);
    $contacto = trim($_POST['contacto']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    try {

        // Consulta SQL con marcadores de posición
        $sql = "INSERT INTO proveedores 
                (nombre_empresa, contacto, telefono, direccion)
                VALUES (?, ?, ?, ?)";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        // Vincular los cuatro parámetros como texto
        $stmt->bind_param(
            "ssss",
            $empresa,
            $contacto,
            $telefono,
            $direccion
        );

        // Ejecutar la inserción
        $stmt->execute();

        // Cerrar la sentencia
        $stmt->close();

        // Regresar al catálogo
        header("Location: proveedores.php");
        exit();

    } catch (mysqli_sql_exception $e) {

        die(
            "Error crítico al registrar el proveedor: "
            . $e->getMessage()
        );
    }

} else {

    // Si intentan entrar directamente por la URL
    header("Location: proveedores.php");
    exit();
}

?>
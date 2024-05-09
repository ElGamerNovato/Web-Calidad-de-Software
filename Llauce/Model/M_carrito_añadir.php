<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $productoId = $_POST['producto_id'];
    $cantidad = intval($_POST['cantidad']);

    // Establece la conexión a la base de datos
    require '../Controller/conexion/config.php';

    // Obtiene los detalles del producto desde la base de datos
    $sql = "SELECT * FROM productoss WHERE id = $productoId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Crea un array para representar el producto
        $producto = array(
            'id' => $productoId,
            'producto' => $row['producto'],
            'precio' => $row['precio'],
            'cantidad' => $cantidad
        );

        // Agrega el producto al carrito de compras en la sesión
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        // Agrega el producto al carrito
        $_SESSION['carrito'][] = $producto;

        // Puedes imprimir un mensaje de éxito si es necesario
        echo 'Producto agregado al carrito de compras.';
    } else {
        echo 'Error: Producto no encontrado en la base de datos.';
    }

    // Cierra la conexión a la base de datos
    $conn->close();
} else {
    echo 'Error: No se recibieron datos válidos del producto.';
}
?>

<?php
// Asegúrate de iniciar la sesión
session_start();

include_once dirname(__FILE__) . 'Requests/library/Requests.php';
Requests::register_autoloader();
include_once dirname(__FILE__) . 'culqi-php/lib/culqi.php';

// Configura tu API Key y autenticación
$PUBLIC_KEY = "pk_test_303731dfbca0deae";
$SECRET_KEY = "sk_test_1657b248b2071dd8";
$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

// Obtiene el monto desde la variable de sesión
$total = isset($_SESSION['total_carrito']) ? $_SESSION['total_carrito'] : 0;

try {
    $charge = $culqi->Charges->create(
        array(
            "amount" => $total * 100,  // Multiplica por 100 para convertirlo a centavos
            "currency_code" => "PEN",
            "description" => "Minimarket Llauce",
            "email" => isset($_POST["email"]) ? $_POST["email"] : "", // Verifica si se envía el email
            "source_id" => isset($_POST["token"]) ? $_POST["token"] : "" // Verifica si se envía el token
        )
    );

    // La transacción fue exitosa
    $response = array('success' => true, 'message' => 'Pago exitoso');
} catch (Exception $e) {
    // La transacción falló
    $response = array('success' => false, 'message' => 'Error en el pago: ' . $e->getMessage());
}

// Devuelve la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();  // Asegúrate de salir después de enviar la respuesta
?>

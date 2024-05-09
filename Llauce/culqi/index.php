<?php

require_once '../Controller/conexion/config.php';
require_once '../Model/M_carrito.php';

// Inicializa el total en 0
$total = 0;

foreach ($_SESSION['carrito'] as $producto) {
    $subtotal = $producto['precio'] * intval($producto['cantidad']);
    $total += $subtotal;
    // Resto del código para mostrar los productos en el carrito
}

// Almacena el total en una variable de sesión
$_SESSION['total_carrito'] = $total;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Culqi</title>
    <!-- Agrega la biblioteca jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Agrega SweetAlert2 como script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://checkout.culqi.com/js/v4"></script>
</head>
<body>
    <input type="button" name="button" id="btn_pagar" value="COMPRAR">
    
    <script>
        Culqi.publicKey = 'pk_test_303731dfbca0deae';

        const btn_pagar = document.getElementById('btn_pagar');

        btn_pagar.addEventListener('click', function (e) {
            // Obtén el monto del carrito desde la variable de sesión
            const carritoMonto = <?php echo $total; ?>;

            Culqi.settings({
                title: 'Minimarket Llauce',
                currency: 'PEN',
                amount: carritoMonto * 100, // Multiplica por 100 para convertirlo a centavos
                order: 'ord_live_0CjjdWhFpEAZlxlz',
            });

            Culqi.options({
                lang: "auto",
                installments: false,
                paymentMethods: {
                    tarjeta: true,
                    yape: true,
                    bancaMovil: false,
                    agente: true,
                    billetera: true,
                    cuotealo: true,
                },
            });

            Culqi.open();
            e.preventDefault();
        });

        function culqi() {
            if (Culqi.token) {
                const tokenID = Culqi.token.id;
                const email = Culqi.token.email;
                console.log('Se ha creado un Token: ', tokenID);

                $.ajax({
                    url: "procesar.php",
                    type: "POST",
                    data: {
                        token: tokenID,
                        email: email
                    },
                    dataType: 'json',
                }).done(function (resp) {
                    if (resp.success) {
                        Swal.fire({
                            title: 'Pago exitoso',
                            text: 'El pago se ha procesado correctamente.',
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.href = 'catalogo.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error en el pago',
                            text: resp.message,
                            icon: 'error',
                        });
                    }
                });
            } else if (Culqi.order) {
                const order = Culqi.order;
                console.log('Se ha creado el objeto Order: ', order);
            } else {
                console.log('Error : ', Culqi.error);
            }
        }
    </script>
</body>
</html>

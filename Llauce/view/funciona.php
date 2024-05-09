<?php
require_once('../view/vendor/autoload.php'); // Ruta al archivo de autoload de Stripe
require_once '../Model/M_Pago.php';
?>

<!DOCTYPE html>
<?php require_once '..//Controller/conexion/configuracion.php'; ?>
<html lang="es">
    <head>
        <title> PASARELA DE PAGOS&copy;</title>
        <link rel="stylesheet" href="../CSS/prueba.css" type="text/css" media="all">
        <!-- Modernizr Library -->
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/modernizr.min.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/jquery.js"></script>
        <link rel="stylesheet" href="css/sliders/nivo-slider/nivo-slider.css" type="text/css" media="all">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
              crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/Encabezado.css">
        <link rel="stylesheet" 
              <href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/modernizr.min.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/jquery.js"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <style>
            .card {
                margin-bottom: 20px;
            }
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
            main {
                flex: 1;
            }
            .boton {
                display: inline-block;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }

            .boton:hover {
                background-color: #45a049;
            }
            
        </style>
        <style>
    /* Estilos para el contenedor del formulario */
    .stripe-form-container {
        width: 50%;
        margin: 0 auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: linear-gradient(to bottom right, #ff6e6e, #ffa600);
    }

    /* Estilos para el formulario */
    .stripe-form {
        text-align: center;
        color: white;
    }

    /* Estilos para el logo de Stripe */
    .stripe-logo {
        width: 100px;
        margin-bottom: 20px;
    }

    /* Estilos para los campos del formulario */
    .stripe-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #333;
    }

    /* Estilos para el botón */
    .stripe-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        background-color: #2196F3;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Estilos para el botón al pasar el cursor */
    .stripe-btn:hover {
        background-color: #0b7dda;
    }
</style>
    </head>
    <body style="background-color: khaki">
        <?php require_once './header1.php'; ?>

        <main>
            <br/>
            <h1 style="text-align: center">Pasarela de Pago</h1>
            <br/>
            <div style="display: flex; align-items: flex-start;">
                <br/>
                <div style="width: 1%; padding: 0px 10px;">
                    
                </div>
                <div class="stripe-form-container" style="width: 40%">
                    <div class="stripe-form">
                        <img class="stripe-logo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQN3ZtPh9gUkky_MgkO_9EuAq5C42jsm1vsqIRZ0tQBSEZvgQQUtwuF1GPnNI97S90k4HM&usqp=CAU" alt="Logo de Stripe">
                        <h2>Complete su información de pago</h2>
                        <form action="" method="POST">
                            <input type="text" name="cantidad" placeholder="Cantidad" class="stripe-input" required><br>
                            <input type="email" name="correo" placeholder="Correo electrónico" class="stripe-input" required><br>
                            <div id="card-element" class="stripe-input"></div>
                            <button type="submit" class="stripe-btn">Pagar</button>
                        </form>
                        <?php if (!empty($error)): ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php endif; ?>
                        <?php if (!empty($success)): ?>
                            <p style="color: green;"><?php echo $success; ?></p>
                            <a href="generar_pdf.php" target="_blank" class="stripe-btn">Descargar PDF</a>
                        <?php endif; ?>
                    </div>
                </div>

                <script>
                    var stripe = Stripe('pk_test_51NIoQLDQUPQBscfR2tzBP1g3e82iQIshNgewvollq91tjBejjRY9MLcE8mkAAYYLm9MWPJZEp2acyswBeqE565Ki00qUZ8Qh0E');
                    var elements = stripe.elements();
                    var cardElement = elements.create('card');
                    cardElement.mount('#card-element');

                    var form = document.querySelector('form');
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        stripe.createToken(cardElement).then(function (result) {
                            if (result.error) {
                                console.error(result.error.message);
                            } else {
                                var tokenInput = document.createElement('input');
                                tokenInput.setAttribute('type', 'hidden');
                                tokenInput.setAttribute('name', 'stripeToken');
                                tokenInput.setAttribute('value', result.token.id);
                                form.appendChild(tokenInput);

                                form.submit();
                            }
                        });
                    });
                </script>

            </div>        

        </main>
        <br/><!-- comment -->
        <br/>
        <?php include './footer1.php'; ?>
        <script src="../js/register.js" type="text/javascript"></script>

    </body>
</html>

<?php
ob_start();

session_start();
 require_once '..//Controller/conexion/configuracion.php'; 
require_once('../view/vendor/autoload.php'); // Ruta al archivo de autoload de Stripe
require_once '../Model/M_Pago.php';
require_once '../view/fpdf/fpdf.php';
require_once '../Model/M_carrito.php';
require_once('../view/vendor/autoload.php'); // Ruta al archivo de autoload de Stripe
require_once '../Model/M_Pago.php';
?>

<?php require_once '../Controller/conexion/configuracion.php';
?>
<!doctype html>
<html class="no-js" lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
        <title>Productos &copy;</title>
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
        <script src="https://js.stripe.com/v3/"></script>


        <!-- Agrega SweetAlert2 como script -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="../CSS/carrito_procesar.css" rel="stylesheet" type="text/css"/>
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
            #btn_pagar {
                background-color: #FF6347; /* Color rojo */
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
            }

            #btn_pagar:hover {
                background-color: #FF473D; /* Cambio de color al pasar el mouse */
            }
        </style>
    </head>
    <body style="background-color: khaki">
        <?php require_once './header1.php'; ?>
        <main>
            <div class="root">

                <br/>
                <form class="form-register" method="post" action="../Model/M_correo_carrito.php">
                    <h1 style="text-align: center; color: #FFA500">CARRITO DE COMPRAS</h1>
                    <br/>
                    <div class="form-register__header">
                        <ul class="progressbar">
                            <li class="progressbar__option active">Paso 1</li>
                            <li class="progressbar__option">Paso 2</li>
                            <li class="progressbar__option">Paso 3</li>
                        </ul>
                        <br/>
                    </div>
                    <div class="form-register__body">

                        <div class="step active" id="step-1">
                            <div class="step__header">
                                <h2 style="text-align: center">Productos Selecionados <small>( Paso 1)</small></h2>
                            </div>
                            <br/>
                            <hr/>
                            <div style="display: flex; align-items: flex-start;">
                                <?php
                                if (empty($_SESSION['carrito'])) {
                                    echo "<p>No hay productos en el carrito.</p>";
                                } else {
                                    $total = 0;
                                    ?>
                                    <div>
                                        <img src="../Imagenes/carrito.jpeg" style="width: 400px; height: 300px">
                                    </div>
                                    <table class="table" style="text-align: center; margin-left: 20px;">
                                        <thead>
                                            <tr>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($_SESSION['carrito'] as $producto) {
                                                $subtotal = $producto['precio'] * intval($producto['cantidad']);
                                                $total += $subtotal;
                                                ?>
                                                <tr>
                                                    <td><?php echo $producto['nombre']; ?></td>
                                                    <td><?php echo $producto['cantidad']; ?></td>
                                                    <td>S/ <?php echo $producto['precio']; ?></td>
                                                    <td>S/ <?php echo $subtotal; ?></td>
                                                    <td>
                                                        <form action="carrito.php" method="POST">
                                                            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                                            <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="3" style="text-align: right;"><strong>Total:</strong></td>
                                                <td colspan="2">S/ <?= number_format($total, 2) ?></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                            <hr/>
                            <center><button type="button" class="step__button step__button--next" data-to_step="2" data-step="1" id="siguiente" style="background-color: #FFA500">Siguiente</button></center>
                        </div>

                        <!-- Paso 2 -->
                        <div class="step" id="step-2">
                            <div class="step__header">
                                <h2 style="text-align: center">Información de Cliente <small>( Paso 2)</small></h2>
                            </div>
                            <br/>
                            <div style="display: flex; align-items: flex-start;">
                                <br/>
                                <div style="width: 10%; padding: 0px 10px;">

                                </div>
                                <div style="width: 40%; padding: 0px 20px">
                                    <div class="step__body" >
                                        <label for="nombre" style="color: blue">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="40">
                                    </div>
                                    <div class="step__body" style="color: blue">
                                        <label for="correo">Correo Electroncico</label>
                                        <input type="email" class="form-control" id="correo" name="correo" required>
                                    </div>
                                    <div class="step__body" style="color: blue">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" required>
                                    </div>
                                    <div class="step__body">
                                        <label for="tipo_envio" style="color: blue">Tipo de Envío</label><br>
                                        <select class="form-control" name="tipoenvio">
                                            <option value="Recojo a tienda" >Recojo en tienda</option>
                                            <option value="Domicilio" selected="selected">Domicilio</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="width: 40%; padding: 0px 10px;">
                                    <br/>
                                    <br/>
                                    <img src="../Imagenes/usuario.jpeg" style="width: 100%; height: auto;">
                                </div>
                            </div>
                            <hr/>
                            <div class="step__footer">
                                <button type="button" class="step__button step__button--back" data-to_step="1" data-step="2">Regresar</button>
                                <button type="button" class="step__button step__button--next" data-to_step="3" data-step="2">Siguiente</button>
                            </div>
                        </div>

                        <!-- Paso 3 -->
                        <div class="step" id="step-3">
                            <div class="step__header">
                                <h2 style="text-align: center">Metodos de pago <small>(Paso 3)</small></h2>
                                <br/>
                                <div style="display: flex; align-items: flex-start; padding: 0px 20px">
                                    <br/>
                                    <div style="width: 5%; padding: 0px 20px;">
                                    </div>
                                    <div style="width: 40%; padding: 0px 20px;">
                                        <br/>
                                        <h3>Pago Con Yape</h3>
                                        <br/>
                                        <img src="../Imagenes/yape.jpeg" style="width: 100%; height: auto;">
                                        <center> <a href="funciona.php" class="boton" >PAGAR AHORA</a></center>
                                    </div>
                                    <div style="width: 10%; padding: 0px 20px;">
                                    </div>
                                    <div style="width: 40%; padding: 0px 20px;">
                                        <br/>
                                        <h3>Pago con tarjeta (VISA)</h3>
                                        <br/>
                                        <img src="../Imagenes/visa.jpeg" style="width: 100%; height: auto;">
                                        <center> <a href="funciona.php" class="boton" >PAGAR AHORA</a></center>
                                    </div>
                                </div>
                                <br/>
                                <script >
                                    function mensaje() {
                                        alerta("Complete el Formulario en segundo paso");
                                    }
                                </script>
                                <hr/>
                                <div class="step__footer">
                                    <button type="button" class="step__button step__button--back" data-to_step="2" data-step="3">Regresar</button>
                                    <script>
                                        function validar() {
                                            alert("Se a registrado su pedido exitosamente y se le ha enviado un notificacion a su gmail");
                                        }
                                    </script>
                                    <button type="submit" class="step__button step__button--back" id="registrarnuevo" onclick="validar()">Enviar</button>                        

                                </div>

                            </div>
                        </div>
                </form>
            </div> 
        </main>

        <script>
            var siguienteBtns = document.getElementsByClassName('step__button--next');
            var steps = document.getElementsByClassName('step');

            function showStep(stepNumber) {
                for (var i = 0; i < steps.length; i++) {
                    steps[i].classList.remove('active');
                }
                steps[stepNumber - 1].classList.add('active');
            }

            Array.from(siguienteBtns).forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var currentStep = parseInt(btn.getAttribute('data-step'));
                    var nextStep = parseInt(btn.getAttribute('data-to_step'));

                    steps[currentStep - 1].classList.remove('active');
                    steps[nextStep - 1].classList.add('active');
                });


            });
        </script>

        <!-- Enlaces a los scripts de Bootstrap y jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Script para integrar Stripe (si es necesario) -->
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            function mostrarFormulario() {
                // Muestra el modal al hacer clic en "Pagar ahora"
                $('#paymentModal').modal('show');
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

            }
        </script>
        <?php
        include '../view/footer1.php';
        ?>
        <script src="../js/register.js" type="text/javascript"></script>
    </body>
</html>
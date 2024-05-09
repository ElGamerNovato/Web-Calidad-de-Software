
<!doctype html>
<html class="no-js" lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
        <title>Contacto&&copy;</title>
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
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-top: 50px;
                padding: 40px;
            }

            h2 {
                color: #333;
            }

            p {
                color: #666;
            }

            /* Estilos para el encabezado */
            .header {
                background-color: #333;
                color: #fff;
                padding: 10px 0;
                text-align: center;
            }

            /* Estilos para la barra de navegación (si la tienes) */
            .navbar {
                background-color: #333;
                color: #fff;
                padding: 10px 0;
                text-align: center;
            }

            /* Estilos para los enlaces */
            a {
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            a:hover {
                color: #ff4500; /* Cambia de color al pasar el mouse sobre el enlace */
            }
            /* Estilos CSS personalizados para el formulario de contacto */
            .contact-form {
                max-width: 500px;
                margin: 0 auto;
            }

            .contact-form input,
            .contact-form textarea {
                width: 100%;
                margin-bottom: 20px;
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .contact-form button {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .rating-container {
                margin-top: 20px;
            }

            .rating-container label {
                font-size: 20px;
                margin-right: 10px;
            }
        </style>
    </head>
    <body style="background-color: #ffffff">
        <!-- CABECERA-->

        <?php
        require_once './header1.php';
        ?>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6" style="padding: 2px 28px">
                    <h1 style="text-align: center">Minimarket Llauce</h1>
                                        <center> <img src="../img/Imagen_1.jpeg" alt="30px" style="height: 200px"/></center>
                                        <p style="text-align: justify">El Minimarket "Lluace" te da la bienvenida. Este formulario está diseñado para que nuestros valiosos clientes compartan su experiencia con nuestros productos y servicios. Queremos escuchar tus comentarios y opiniones para poder mejorar continuamente y ofrecerte la mejor experiencia de compra posible. Tu calificación nos ayuda a entender mejor tus necesidades y a garantizar que estés satisfecho con nuestro servicio. Gracias por tomarte el tiempo para calificar nuestro minimarket. Tu opinión es fundamental para nosotros.</p>
                </div>
                <div class="col-md-6">
                    <div class="container mt-4 ">
                        <div class="contact-form">
                            <h1>Contacto</h1>
                            <form action="procesar_formulario.php" method="post">
                                <input type="text" name="nombre" placeholder="Nombre" required><br>
                                <input type="email" name="email" placeholder="Correo electrónico" required><br>
                                <textarea name="mensaje" placeholder="Mensaje" rows="4" required></textarea><br>

                                <button type="submit">Enviar</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br/><!-- comment -->
        <br/>
        <?php
        require_once './footer1.php';
        ?>
        <script>
            document.getElementById("mobile-menu").addEventListener("click", function () {
                var menu = document.querySelector(".menu");
                menu.classList.toggle("show");
            });

            function searchFunction() {
                var searchTerm = document.getElementById("search-bar").value;
                // Realizar la lógica de búsqueda aquí, por ejemplo, redirigir a una página de resultados de búsqueda con el término de búsqueda como parámetro
                // window.location.href = "resultados-busqueda.php?query=" + searchTerm;
                alert("Realizando búsqueda con el término: " + searchTerm);
            }

        </script>
        <a href="#" id="totop">TOP</a>

        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/modernizr.min.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/jquery.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/kl-plugins.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/plugins/_sliders/nivo-slider/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/trigger/slider/nivo-slider/kl-nivo-slider.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/plugins/_sliders/ios/jquery.iosslider.min.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/trigger/slider/laptop-slider/kl-laptop-slider.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/plugins/_sliders/caroufredsel/jquery.carouFredSel-packed.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/trigger/slider/caroufredsel/fancy-slider/kl-general-slider.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/kl-scripts.js"></script>
        <script type="text/javascript" src="https://www.proveeduriavirtual.com/js/kl-custom.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="../JS/Slide.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    </body>
</html>
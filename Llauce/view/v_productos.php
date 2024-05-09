<?php
require_once '../Controller/conexion/configuracion.php';
// Activamos almacenamiento en el buffer
ob_start();
session_start();

//// ... (código anterior)
//
//if (isset($_POST['search'])) {
//    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']); // Limpiar el valor para evitar inyección de SQL
//
//    // Modifica la consulta SQL para incluir la cláusula WHERE que compara el nombre del producto con el término de búsqueda
//    $sql = "SELECT * FROM productoss WHERE producto = '$searchTerm'";
//    $result = $conn->query($sql);
//
//    // Comprueba si se encontraron resultados
//    if ($result->num_rows > 0) {
//        while ($row = $result->fetch_assoc()) {
//            // Aquí puedes mostrar los resultados como desees, por ejemplo:
//            echo "<div>Nombre del Producto: " . $row['producto'] . "</div>";
//            echo "<div>Descripción: " . $row['descripcion'] . "</div>";
//            echo "<div>Precio: " . $row['precio'] . "</div>";
//            // ... (mostrar más detalles del producto según tus necesidades)
//        }
//    } else {
//        echo "No se encontraron productos que coincidan con la búsqueda.";
//    }
//}

// ... (resto del código)
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/Encabezado.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <!-- CABECERA-->
        <?php require_once './header1.php'; ?>

        <!-- CATALOGO -->
        <div class="action_box" data-arrowpos="center" style="background-color: #ff9933; border: 0px">
            <h1 style="text-align: center">PRODUCTOS</h1>
            <div class="elm-searchbox__inner" style="width: 280px; margin-left: 30px">
                <form method="POST" action="v_productos.php">
                    <div class="search-box" style="height: 25px;">
                        <input name="search" maxlength="20" class="elm-searchbox__input" type="text" size="12" autocomplete="off" placeholder="Busque su producto..." style="width: 100% !important;color: #999999">
                        <div class="result"></div>
                    </div>
                </form>

            </div>
        </div>

        <section class="hg_section bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="shop-latest">
                            <?php
                            $sql = "SELECT * FROM productoss";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-3">
                                        <div class="card">
                                            <hr>
                                            <a class="btn-element btn btn-lined btn-skewed lined-green btn-sm"
                                               style="width: 130px; margin-left: 10px"
                                               href="club-gae.php"
                                               title="<?php echo $row['producto']; ?>"
                                               data-descripcion="<?php echo $row['descripcion']; ?>"
                                               data-imagen="../Imagenes/<?php echo $row['img']; ?>">
                                                <span>INFORMACIÓN</span>
                                            </a>


                                            <hr/>
                                            <img src='../Imagenes/<?php echo $row['img']; ?>' width='200' height='200' class='card-img-top'>
                                            <div class="card-body">

                                                <h5 id="producto" class="card-title" style="text-align: center"><?php echo $row['producto']; ?></h5>
                                                <p id="precio" class="card-text"> S/. <?php echo $row['precio']; ?></p>

                                                <form action="carrito.php" method="post" onsubmit="return validarCantidad()">
                                                    <div style="text-align: center">

                                                        <label>Cantidad:</label><br />
                                                        <input type="number" id="cantidadInput" name="cantidad" min="1" max="10" style="padding: 3px 5px; width: 80px">
                                                    </div>
                                                    <br />
                                                    <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="producto_nombre" value="<?php echo $row['producto']; ?>">
                                                    <input type="hidden" name="producto_precio" value="<?php echo $row['precio']; ?>">
                                                    <center>
                                                        <button type="submit" name="agregar_carrito" class="btn btn-primary btn-lg" style="margin-left: 10px; height: 40px; width: 130px; background-color: #ff0000; border: 0; color: #fff;" onclick="mostrarAlerta()">Añadir al carrito</button>
                                                    </center>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "No se encontraron productos.";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript">
            function validarCantidad() {
                var cantidadInput = document.querySelector('#cantidadInput');
                var cantidad = parseInt(cantidadInput.value);
                if (cantidad <= 0 || cantidad > 10) {
                    alert("La cantidad debe estar entre 1 y 10.");
                    return false;
                }
                return true;
            }
            function mostrarAlerta() {
                alert("Producto agregado al carrito");
            }

        </script>
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll('.btn-element');

        links.forEach(link => {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                const descripcion = link.getAttribute('data-descripcion');
                const imagenUrl = link.getAttribute('data-imagen');
                const nombre = link.getAttribute('title');

                Swal.fire({
                    title: `<div style="font-size: 16px;">${nombre} </div>`,
                    html: `<div style="font-size: 14px;">${descripcion}</div><img src="${imagenUrl}" style="max-width: 150px; max-height: 150px; margin-top: 10px;">`,
                    imageAlt: 'Imagen',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    customClass: {
                        popup: 'custom-popup',
                        title: 'custom-title',
                        content: 'custom-content'
                    }
                });
            });
        });
    });
</script>



        <?php require './footer1.php'; ?>


        <a href="#" id="totop">TOP</a>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="https://www.proveeduriavirtual.com/js/modernizr.min.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/jquery.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/bootstrap.min.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/kl-plugins.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/plugins/_sliders/nivo-slider/jquery.nivo.slider.pack.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/trigger/slider/nivo-slider/kl-nivo-slider.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/plugins/_sliders/ios/jquery.iosslider.min.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/trigger/slider/laptop-slider/kl-laptop-slider.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/plugins/_sliders/caroufredsel/jquery.carouFredSel-packed.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/trigger/slider/caroufredsel/fancy-slider/kl-general-slider.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/kl-scripts.js"></script>
        <script src="https://www.proveeduriavirtual.com/js/kl-custom.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="../JS/Slide.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="scripts/.js"></script>
    </body>

</html>

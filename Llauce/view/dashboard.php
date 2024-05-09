<?php
require_once '../Controller/conexion/configuracion.php';
require_once '../Model/M_dashboard.php';
?>

<!DOCTYPE html>
<!--Autor JOSE
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <title> Dashboard &copy;</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" sizes="32x32" href="../Imagenes/favicon-32x32.png">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

        <style>
            /* Estilos CSS para embellecer la plantilla */
            .my-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s ease;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            .my-button:hover {
                background-color: #45a049;
            }

           

            .chart-container1 {
                max-width: 600px; /* Ajusta el valor según tus preferencias */
                margin: 0 auto;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                padding: 20px;
                margin-bottom: 20px;
            }

            .container {
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .chart-container {
                width: 45%;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                padding: 10px;
                margin-bottom: 10px;
            }

            h2 {
                margin-top: 0;
            }
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
            }
        </style>
        <!-- Agrega aquí los enlaces a tus archivos CSS y JS de Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body
       >

        <section class="home" style="padding: 0px 10px; ">
            <?php
            // Obtener el nombre del mes seleccionado
            $nombreMes = '';
            switch ($mes) {
                case '01':
                    $nombreMes = 'Enero';
                    break;
                case '02':
                    $nombreMes = 'Febrero';
                    break;
                case '03':
                    $nombreMes = 'Marzo';
                    break;
                case '04':
                    $nombreMes = 'Abril';
                    break;
                case '05':
                    $nombreMes = 'Mayo';
                    break;
                case '06':
                    $nombreMes = 'Junio';
                    break;
                case '07':
                    $nombreMes = 'Julio';
                    break;
                case '08':
                    $nombreMes = 'Agosto';
                    break;
                case '09':
                    $nombreMes = 'Septiembre';
                    break;
                case '10':
                    $nombreMes = 'Octubre';
                    break;
                case '11':
                    $nombreMes = 'Noviembre';
                    break;
                case '12':
                    $nombreMes = 'Diciembre';
                    break;
                default:
                    $nombreMes = '';
                    break;
            }
            ?>
            <br/>
            <div style="display: flex; width: 100%">
                <div style="border-color: blue; width: 25% ">
                    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="color: #fff; text-align: center;">
                        <label for="mes">SELECCIONA EL MES:</label>
                        <select name="mes" id="mes" onchange="this.form.submit()" style="height: 32px; background-color: #6699ff;">
                            <option value="01" <?php if ($mes == '01') echo 'selected'; ?>>Enero</option>
                            <option value="02" <?php if ($mes == '02') echo 'selected'; ?>>Febrero</option>
                            <option value="03" <?php if ($mes == '03') echo 'selected'; ?>>Marzo</option>
                            <option value="04" <?php if ($mes == '04') echo 'selected'; ?>>Abril</option>
                            <option value="05" <?php if ($mes == '05') echo 'selected'; ?>>Mayo</option>
                            <option value="06" <?php if ($mes == '06') echo 'selected'; ?>>Junio</option>
                            <option value="07" <?php if ($mes == '07') echo 'selected'; ?>>Julio</option>
                            <option value="08" <?php if ($mes == '08') echo 'selected'; ?>>Agosto</option>
                            <option value="09" <?php if ($mes == '09') echo 'selected'; ?>>Septiembre</option>
                            <option value="10" <?php if ($mes == '10') echo 'selected'; ?>>Octubre</option>
                            <option value="11" <?php if ($mes == '11') echo 'selected'; ?>>Noviembre</option>
                            <option value="12" <?php if ($mes == '12') echo 'selected'; ?>>Diciembre</option>
                        </select>
                    </form>
                </div>
                <div>
                    <h1 style="color: #000080; text-align: center ; padding: 0px 170px">DASHBOARD - REPORTE DE "<?php echo $nombreMes; ?>"</h1>
                </div>
                <div style="width: 25%; padding: 0px 50px">
                    <button onclick="captureAndDownload()" style="padding: 10px 10px;" class="my-button">Capturar y Descargar</button>
                </div>
            </div>
            <br/>
            <div class="container" style="padding: 10px 50px">
                <div class="chart-container">
                    <h2 style="text-align: center;color: #fff;">Ventas de productos </h2>
                    <canvas id="productosChart"></canvas>
                </div>
                <div class="chart-container">
                    <h2 style="text-align: center;color: #fff;">Stock de productos</h2>
                    <canvas id="stockChart"></canvas>
                </div>
                <div class="chart-container" style="height: 230px; padding: 0px 50px; justify-content: center; ">
                    <h2 style="text-align: center;color: #fff;">Ventas por Categoría</h2>
                    <canvas id="productosChart1"></canvas>
                </div>
                <div class="chart-container">
                    <center><table style="text-align: justify; color:#999999;">
                        <tr>
                            <th style="text-align: center">Información</th>
                            <th style="text-align: center">Datos</th>
                        </tr>
                        <tr>
                            <td>Suma de Ingresos</td>
                            <td> S/ <?php echo $suma_precios; ?></td>
                        </tr>
                        <tr>
                            <td>Producto Más Vendido</td>
                            <td><?php echo $producto_mas_vendido; ?></td>
                        </tr>
                        <tr>
                            <td>Cand. del producto más vendido</td>
                            <td><?php echo $cantidad_vendida; ?> Unid.</td>
                        </tr>
                        <tr>
                            <td>Producto Menos Vendido</td>
                            <td><?php echo $producto_menos_vendido; ?></td>
                        </tr>
                        <tr>
                            <td>Cantidad de producto menos vendido</td>
                            <td><?php echo $cantidad_menos_vendida; ?> Unid.</td>
                        </tr>
                        </table></center>
                </div>
            </div>
            <script>
                function captureAndDownload() {

                    // Captura la pantalla y obtén una imagen base64
                    html2canvas(document.body).then(function (canvas) {
                        var screenshot = canvas.toDataURL("image/png");

                        // Crea un objeto jsPDF con orientación apaisada (horizontal)
                        var pdf = new jsPDF('landscape');

                        // Establece el tamaño del documento según el tamaño de la captura de pantalla
                        var width = pdf.internal.pageSize.getWidth();
                        var height = pdf.internal.pageSize.getHeight();
                        pdf.addImage(screenshot, 'PNG', 9, 5, 280, 200, width, height);

                        // Descarga el PDF
                        pdf.save("captura_pantalla.pdf");
                    });
                }


            </script>
            <script>
                // Obtener el contexto del lienzo del gráfico
                var ctx = document.getElementById("productosChart").getContext("2d");

                // Obtener los datos de productos y cantidades desde PHP
                var productos = <?php echo json_encode($productos); ?>;
                var cantidades = <?php echo json_encode($cantidades); ?>;

                // Obtener la cantidad de productos para definir los colores
                var cantidadProductos = productos.length;

                // Crear un array de colores aleatorios
                var colores = [];
                for (var i = 0; i < cantidadProductos; i++) {
                    var color = getRandomColor();
                    colores.push(color);
                }

                // Crear el gráfico de barras
                var productosChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: productos,
                        datasets: [{
                                label: 'Cantidad',
                                data: cantidades,
                                backgroundColor: colores,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para generar un color aleatorio en formato RGB
                function getRandomColor() {
                    var r = Math.floor(Math.random() * 256);
                    var g = Math.floor(Math.random() * 256);
                    var b = Math.floor(Math.random() * 256);
                    return 'rgb(' + r + ',' + g + ',' + b + ')';
                }
            </script>

            <script>
                // Obtener el contexto del lienzo del gráfico
                var ctx = document.getElementById("stockChart").getContext("2d");

                // Obtener los datos de productos y stock desde PHP
                var productos = <?php echo json_encode($productos); ?>;
                var stock = <?php echo json_encode($stock); ?>;

                // Crear el gráfico de líneas
                var stockChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: productos,
                        datasets: [{
                                label: 'Stock',
                                data: stock,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1,
                                fill: false
                            }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>

            <script>
                var ctx = document.getElementById('productosChart1').getContext('2d');

                var categorias = <?php echo json_encode($categorias); ?>;
                var totalVendidos = <?php echo json_encode($totalVendidos); ?>;
                var colores = ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF", "#FF9F40"];

                var productosChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: categorias,
                        datasets: [{
                                data: totalVendidos,
                                backgroundColor: colores
                            }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'right' // Cambia 'bottom' a 'right'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        var label = context.label || '';
                                        var value = context.raw || '';
                                        return label + ': ' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

        </section>

        <script src="../js/script.js" type="text/javascript"></script>
    </body>
</html>
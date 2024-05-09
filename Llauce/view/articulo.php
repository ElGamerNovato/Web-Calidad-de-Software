
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<?php
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.html");
} else {
    require 'header.php';
    if ($_SESSION['almacen'] == 1) {
        ?>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Articulo <a href="../view/v_producto_nuevo.php"><button class="btn btn-success"><i class="fa fa-plus-circle"></i>Nuevo +</button></a> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info">Reporte</button></a></h1>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <!-- box-header -->
                            <!-- centro -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Imagen</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Categoría</th>
                                            <th>Id proveedor</th>
                                            <th>Proveedor</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include_once '../admin_productos/tabla.php'; ?>
                                    </tbody>
                                </table> <!-- Cierra la tabla -->
                            </div> <!-- Cierra listadoregistros -->
                        </div> <!-- Cierra box -->
                    </div> <!-- Cierra col-md-12 -->
                </div> <!-- Cierra row -->
            </section> <!-- Cierra content -->
        </div> <!-- Cierra content-wrapper -->
        <?php
        require 'footer.php'; // Incluye el footer después de la tabla
        ?>
        <script src="../public/js/JsBarcode.all.min.js"></script>
        <script src="../public/js/jquery.PrintArea.js"></script>
        <script src="scripts/articulo.js"></script>
        <?php
    } else {
        require 'noacceso.php';
    }
}
ob_end_flush();
?>

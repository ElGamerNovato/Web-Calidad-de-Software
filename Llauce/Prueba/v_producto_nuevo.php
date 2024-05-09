
<link href="../CSS/carrito_procesar.css" rel="stylesheet" type="text/css"/>

        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <center> <title style="text-align: center">Nuevo Producto &copy;</title></center>

        </head>
        <body>
            <div style="background-color: #ffffff">
                <form style="margin-left: 28%;height: 100%; background-color: #ffffff" class="form-register" method="POST" action="../Model/M_producto_procesar.php" enctype="multipart/form-data">
                    <h2 style=" color: #FFA500; margin-left: 28%" ><u>NUEVO PRODUCTO</u></h2>
                    <div class="form-register__header" style="margin-left: -20%">
                        <ul class="progressbar">
                            <li class="progressbar__option active">Paso 1</li>
                            <li class="progressbar__option">Paso 2</li>
                            <br/>
                    </div>
                    <div class="form-register__body" style=" border: 2px solid #FFA500; height: 80%; width: 80%">
                        <div class="step active" id="step-1" style="text-align: center">
                            <div class="step__header">
                                <h2 class="step__title">Nuevo Producto <small>( Paso 1)</small></h2>
                            </div>
                            <div class="step__body">
                                <label>Producto</label><br/>
                                <br/>
                                <center> <input type="text" class="form-control" name="producto" required style="width: 30%"></center>
                            </div>
                            <div class="step__body">   
                                <label>Imagen</label><br/>
                                <br/>
                                <center><input type="file" class="form-control-file" name="imagen" required></center>
                            </div>
                            <div class="step__body">
                                <label>Precio S/.</label><br/>
                                <br/>
                                <center><input type="number" class="form-control" name="precio" step="0.01" required style="width: 30%" ></center>

                            </div>

                            <div class="step__footer">
                                <button type="button" class="step__button step__button--next" data-to_step="2" data-step="1">Siguiente</button>
                            </div>
                        </div>

                        <div class="step" id="step-2" style="text-align: center; ">
                            <div class="step__header">
                                <h2 class="step__title">Información de Producto <small>( Paso 2)</small></h2>
                            </div>
                            <div class="step__body">
                                <label>Stock</label><br/>
                                <center><input type="number" class="form-control" name="stock" required style="width: 30%"></center>
                            </div>
                            <div class="step__body">
                                 <label>Categoria</label>
                                 <br/>
                                <center><select class="form-control" name="categoria" required style="width: 30%">
                                    <option value="Bebidas Alcoholicas" selected="selected">Bebidas Alcoholicas</option>
                                    <option value="Postres">Postres</option>
                                    <option value="Limpieza">Limpieza</option>
                                    <option value="Lacteos">Lacteos</option>
                                    <option value="Bebidas">Bebidas</option>
                                    <option value="Panes">Panes</option>
                                    <option value="Abarrotes">Abarrotes</option>
                                    </select></center>
                            </div>
                            <div class="step__body">
                                 <label>IdProveedor</label><br/>
                                 <center><input type="number"  name="idproveedor"  class="form-control" required style="width: 30%"></center>
                            </div>
                            <div class="step__body">
                                 <label>Proveedor</label><br/>
                                <br/>
                                <center><input type="text"  name="proveedor"  class="form-control" required style="width: 30%"></center>
                            </div>
                            <div class="step__footer">
                                <button type="button" class="step__button step__button--back" data-to_step="1" data-step="2">Regresar</button>
                                <button type="submit" class="step__button step__button--back"  name="btn-agregar" id="btn-agregar">Enviar</button>                        
                            </div>
                        </div>
                    </div>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function mostrarMensaje(titulo, mensaje, tipo) {
                        Swal.fire({
                            title: titulo,
                            text: mensaje,
                            icon: tipo,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                </script>
                <script src="../js/script.js" type="text/javascript"></script>
                <script src="../js/register.js" type="text/javascript"></script>
            </div>
        </body>
        </html>

        <script src="../public/js/JsBarcode.all.min.js"></script>
        <script src="../public/js/jquery.PrintArea.js"></script>
        <script src="scripts/articulo.js"></script>
      


<?php
require_once '../Controller/conexion/configuracion.php';
function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM productoss WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($producto, $img, $precio, $stock, $categoria, $idproveedor, $proveedor)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productoss(`id`, `producto`, `img`, `precio`, `stock`, `categoria`, `idproveedor`, `proveedor`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
    return $sentencia->execute([$producto, $img, $precio, $stock, $categoria, $idproveedor, $proveedor]);
}
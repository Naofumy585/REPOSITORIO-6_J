<?php
class ContratoPDF
{
    public function ProcesarCompra($numTargeta, $CVV, $FechaVencimiento, $titularTarjeta, $nombreRecibePedido, $direccion, $codigoPostal, $telefono, $correoElectronico, $idUsuario, $idProducto)
    {
        include '../conexion.php';
        $conectar = new Conexion();
        $idUsuario = $_SESSION['idUsuario'];

        // Inicia la transacción
        $conectar->beginTransaction();

        // Verifica si el ID del producto existe
        $verificacion = $conectar->prepare("SELECT COUNT(*) FROM t_productos1 WHERE id = :id_producto");
        $verificacion->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
        $verificacion->execute();

        $productoExistente = $verificacion->fetchColumn();

        if ($productoExistente) {
            // Realiza la inserción en t_pedidos
            $consulta = $conectar->prepare("
                INSERT INTO t_pedidos1 (id_usuario, id_producto, fecha_pedido, NombreRecibePedido, Direccion, CodigoPostal, Telefono, CorreoElectronico) 
                VALUES (:id_usuario, :id_producto, NOW(), :NombreRecibePedido, :Direccion, :CodigoPostal, :Telefono, :CorreoElectronico);
            ");

            // Bind parameters y ejecuta la primera consulta
            $consulta->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
            $consulta->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
            $consulta->bindParam(":NombreRecibePedido", $nombreRecibePedido, PDO::PARAM_STR);
            $consulta->bindParam(":Direccion", $direccion, PDO::PARAM_STR);
            $consulta->bindParam(":CodigoPostal", $codigoPostal, PDO::PARAM_STR);
            $consulta->bindParam(":Telefono", $telefono, PDO::PARAM_STR);
            $consulta->bindParam(":CorreoElectronico", $correoElectronico, PDO::PARAM_STR);
            $consulta->execute();

            // Obtén el último ID insertado
            $last_id = $conectar->lastInsertId();

            // Realiza las otras inserciones
            $consultaCompra = $conectar->prepare("
                INSERT INTO t_compra1 (id_usuario, id_pedido) VALUES  (:id_usuario, :last_id);
            ");

            $consultaDetalleCompra = $conectar->prepare("
                INSERT INTO t_detalles_compra1 (id_pedido, tipo_pago, Num_targeta, CVV, FechaVencimiento, titularTarjeta)
                VALUES (:last_id, :Num_targeta, :CVV, :FechaVencimiento, :titularTarjeta);
            ");

            // Bind parameters y ejecuta las otras consultas
            $consultaCompra->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
            $consultaCompra->bindParam(":last_id", $last_id, PDO::PARAM_INT);
            $consultaCompra->execute();

            $consultaDetalleCompra->bindParam(":last_id", $last_id, PDO::PARAM_INT);
            $consultaDetalleCompra->bindParam(":Num_targeta", $numTargeta, PDO::PARAM_STR);
            $consultaDetalleCompra->bindParam(":CVV", $CVV, PDO::PARAM_STR);
            $consultaDetalleCompra->bindParam(":FechaVencimiento", $FechaVencimiento, PDO::PARAM_STR);
            $consultaDetalleCompra->bindParam(":titularTarjeta", $titularTarjeta, PDO::PARAM_STR);
            $consultaDetalleCompra->execute();

            // Confirma la transacción
            $conectar->commit();

            return "Compra procesada con éxito";
        } else {
            // Si el producto no existe, revierte la transacción y muestra el mensaje de error con enlace
            $conectar->rollBack();
            $mensajeError = "Producto agregado. <a href='../P_Enlace/Productos.php'>Volver a la página de productos</a>";
            return $mensajeError;
        }
    }
    public function ObtenerPedidos(){
        include_once '../conexion.php';
        $conectar= new Conexion();
        $consulta=$conectar->prepare('SELECT  * FROM t_pedidos1');
        $consulta->execute();
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        return $consulta->fetchAll();
    }
    public function EliminarPedidos(){
        include '../conexion.php';
        $conectar= new Conexion();
        $consulta=$conectar->prepare("DELETE FROM t_pedidos1
        WHERE Id=:id");
        $consulta->bindParam(":id",$id,PDO::PARAM_INT);
        $consulta->execute();
        return true;
    }
    public function ModificarPedidos($id, $direccion, $nombreRecibePedido, $codigoPostal, $telefono)
{
    include '../conexion.php';
    $conectar = new Conexion();

    try {
        // Obtén los datos actuales del pedido
        $consultaObtener = $conectar->prepare("SELECT * FROM t_pedidos1 WHERE Id = :id");
        $consultaObtener->bindParam(":id", $id, PDO::PARAM_INT);
        $consultaObtener->execute();
        $pedidoActual = $consultaObtener->fetch(PDO::FETCH_ASSOC);

        // Inicia la transacción
        $conectar->beginTransaction();

        // Actualiza los campos en t_pedidos1
        $consulta = $conectar->prepare("
            UPDATE t_pedidos1
            SET Direccion = :Direccion,
                NombreRecibePedido = :NombreRecibePedido,
                CodigoPostal = :CodigoPostal,
                Telefono = :Telefono
            WHERE Id = :id
        ");

        // Bind parameters y ejecuta la consulta
        $consulta->bindParam(":Direccion", $direccion, PDO::PARAM_STR);
        $consulta->bindParam(":NombreRecibePedido", $nombreRecibePedido, PDO::PARAM_STR);
        $consulta->bindParam(":CodigoPostal", $codigoPostal, PDO::PARAM_STR);
        $consulta->bindParam(":Telefono", $telefono, PDO::PARAM_STR);
        $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        $consulta->execute();

        // Confirma la transacción
        $conectar->commit();

        return $pedidoActual;
    } catch (Exception $e) {
        // Si hay algún error, revierte la transacción
        $conectar->rollBack();
        return false;
    }
    }
    public function ObtenerHistorial($id_usuario) {
        include '../conexion.php';
        $conectar = new Conexion();
    
        // Modificación: Seleccionar solo las compras del usuario actual
        $consulta = $conectar->prepare('SELECT t_compra1.id, t_compra1.id_usuario, t_compra1.id_producto, t_productos1.Nombre as nombre_producto, t_productos1.modelo as modelo_producto, t_productos1.precio as precio_producto
                                       FROM t_compra1
                                       JOIN t_productos1 ON t_compra1.id_producto = t_productos1.id
                                       WHERE t_compra1.id_usuario = :id_usuario');
        $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $consulta->execute();
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        return $consulta->fetchAll();
    }    

    }
?>

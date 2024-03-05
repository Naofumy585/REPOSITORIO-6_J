<?php
    class Usuario{
        //atributos

        //metodos
        public function AutenticarUsuario($correo,$password){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare("SELECT * FROM t_usuarios5
            WHERE CorreoElectronico=:correo AND Password=:password");
            $consulta->bindParam(":correo",$correo,PDO::PARAM_STR);
            $consulta->bindParam(":password",$password,PDO::PARAM_STR);
            $consulta->execute();
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            return $consulta->fetchAll();
        }
        public function InsertarUsuario($nombreCompleto,$correo,$password,$tipo){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare("INSERT INTO 
            t_usuarios5(NombreCompleto,CorreoElectronico,Password,
            Tipo,FechaRegistro) VALUES(:nombreCompleto,:correo,
            :password,:tipo,NOW())");
            $consulta->bindParam(":nombreCompleto",$nombreCompleto,PDO::PARAM_STR);
            $consulta->bindParam(":correo",$correo,PDO::PARAM_STR);
            $consulta->bindParam(":password",$password,PDO::PARAM_STR);
            $consulta->bindParam(":tipo",$tipo,PDO::PARAM_INT);
            $consulta->execute();
            return true;
        }
        public function ModificarUsuario($id,$nombreCompleto,$correo){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare("UPDATE t_usuarios5
            SET NombreCompleto=:nombreCompleto,Correo=:correo
            WHERE Id=:id");
            $consulta->bindParam(":nombreCompleto",$nombreCompleto,PDO::PARAM_STR);
            $consulta->bindParam(":correo",$correo,PDO::PARAM_STR);
            $consulta->bindParam(":id",$id,PDO::PARAM_INT);
            $consulta->execute();
            return true;
        }
        public function EliminarUsuario($id){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare("DELETE FROM t_usuarios5
            WHERE Id=:id");
            $consulta->bindParam(":id",$id,PDO::PARAM_INT);
            $consulta->execute();
            return true;
        }
        public function ObtenerUsuarios(){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare('SELECT * FROM t_usuarios5');
            $consulta->execute();
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            return $consulta->fetchAll();
        }

        public function CatalagoP(){
            include_once '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare('SELECT  * FROM t_productos1');
            $consulta->execute();
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            return $consulta->fetchAll();
        }
        public function InsertarP($nombre, $modelo, $precio, $Img){
            include '../conexion.php';
            $conectar = new Conexion();
            $consulta = $conectar->prepare("INSERT INTO t_productos1 (Nombre, modelo, precio, Img) 
                                            VALUES (:nombre, :modelo, :precio, :img)");
            
            $consulta->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $consulta->bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $consulta->bindParam(":precio", $precio, PDO::PARAM_STR);
            $consulta->bindParam(":img", $Img, PDO::PARAM_STR); // Corregido aquí, cambió a :img
            $consulta->execute();
            return true;
        }       
        public function ObtenerProductos() {
            include_once '../conexion.php';
            $conectar = new Conexion();
            $consulta = $conectar->prepare("SELECT * FROM t_productos1");
            $consulta->execute();
            $consulta->setFetchMode(PDO::FETCH_ASSOC);
            return $consulta->fetchAll();
        }
         
          public function ModificarP($id, $nombre, $modelo, $precio, $img, $descripcion){
            include '../conexion.php';
            $conectar = new Conexion();
            
            $consulta = $conectar->prepare("UPDATE t_productos1
                                            SET Nombre = :nombre, 
                                                modelo = :modelo, 
                                                precio = :precio, 
                                                Img = :img,
                                                Descripcion = :descripcion
                                            WHERE id = :id");
            
            $consulta->bindParam(":id", $id, PDO::PARAM_INT);
            $consulta->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $consulta->bindParam(":modelo", $modelo, PDO::PARAM_STR);
            $consulta->bindParam(":precio", $precio, PDO::PARAM_STR);
            $consulta->bindParam(":img", $img, PDO::PARAM_STR);
            $consulta->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $consulta->execute();
            return true;
        }
        public function EliminarP($id){
            include '../conexion.php';
            $conectar= new Conexion();
            $consulta=$conectar->prepare("DELETE FROM t_productos1
            WHERE Id=:id");
            $consulta->bindParam(":id",$id,PDO::PARAM_INT);
            $consulta->execute();
            return true;
        }
    }
?>
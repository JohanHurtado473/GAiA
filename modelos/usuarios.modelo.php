<?php

require_once "conexion.php";


class ModeloUsuarios
{


    // ************************************
    // LOGIN DE USUARIO 
    // ************************************
    static public function mdlIngresarUsuario($documento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE documento_id = :documento");
        $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }  //fin del metodo mdlIngresarUsuario


    // ************************************
    // LISA DE DE USUARIOS EN LA VENTANA PRINCIPAL
    // ************************************    
    static public function mdlListarUsuarios()
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.*, f.codigo FROM usuarios u LEFT JOIN fichas f ON f.id_ficha = u.fichas_id WHERE u.rol<>'Administrador';");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ************************************
    // LISTA DE FICHAS
    // ************************************    
    static public function mdlListarFichas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM fichas");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ************************************
    // AGREGAR USUARIO A LA BD
    // ************************************    
    static public function mdlAgregarUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (tipo_documento, documento_id, nombres, apellidos, correo, fecha_nacimiento, rol, password, fichas_id) VALUES (:tipoDocumento, :documentoId, :nombres, :apellidos, :correo, :fechaNacimiento, :rol, :password, :ficha_id)");
        $stmt->bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":documentoId", $datos["documentoId"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":ficha_id", $datos["ficha_id"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        error_log("valor en el modelo:" . $tabla);
        $stmt->execute();
        return $stmt->fetch();
    }

    // ************************************
    // EDITAR USUARIO EN LA BD
    // ************************************    
    static public function mdlEditarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_documento = :tipoDocumento, documento_id = :documentoId, nombres = :nombres, apellidos = :apellidos, correo = :correo, fecha_nacimiento = :fechaNacimiento, rol = :rol, password = :password, fichas_id = :ficha_id WHERE id = :id");
        
        $stmt->bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":documentoId", $datos["documentoId"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":ficha_id", $datos["ficha_id"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // ************************************
    // ACTUALIZAR ESTADO DE UN USUARIO
    // ************************************
    static public function mdlCambiarEstadoUsuario($tabla, $idUsuario, $estado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }  // fin del metodo mdlCambiarEstadoUsuario

} // fin de la clase ModeloUsuarios
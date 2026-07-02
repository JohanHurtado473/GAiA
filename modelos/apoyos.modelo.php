<?php

require_once "conexion.php";

class ModeloApoyos
{
    // MOSTRAR APOYOS (No importa el estado del mismo, dado que deben poder mostrarse en la pestaña de gestión)
    static public function mdlMostrarApoyos($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, iconos.nombre AS nombre_icono FROM $tabla LEFT JOIN iconos ON $tabla.apoyo_icono COLLATE utf8mb4_unicode_ci = iconos.codigo_fa COLLATE utf8mb4_unicode_ci WHERE $tabla.$item = :valor");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            if ($item == "id_apoyo") {
                return $stmt->fetch();
            } else {
                return $stmt->fetchAll();
            }
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // MOSTRAR APOYOS ACTIVOS (apoyos cuyo estado es "activo")
    static public function mdlMostrarApoyosActivos($tabla, $item, $valor)
    {
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, iconos.nombre AS nombre_icono FROM $tabla LEFT JOIN iconos ON $tabla.apoyo_icono COLLATE utf8mb4_unicode_ci = iconos.codigo_fa COLLATE utf8mb4_unicode_ci WHERE $tabla.$item = :valor AND $tabla.estado_apoyo = 1");
            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            if ($item == "id_apoyo") {
                return $stmt->fetch();
            } else {
                return $stmt->fetchAll();
            }
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado_apoyo = 1");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    // ACTUALIZAR APOYO (GENERICO)
    static public function mdlActualizarApoyo($tabla, $item1, $valor1, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :valor1 WHERE $item2 = :valor2");
        $stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":valor2", $valor2, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // CREAR APOYO
    static public function mdlCrearApoyo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (descripcion_apoyo, apoyo_dual, estado_apoyo, informacion_apoyo, apoyo_icono) VALUES (:descripcion_apoyo, :apoyo_dual, :estado_apoyo, :informacion_apoyo, :apoyo_icono)");

        $stmt->bindParam(":descripcion_apoyo", $datos["descripcion_apoyo"], PDO::PARAM_STR);
        $stmt->bindParam(":apoyo_dual", $datos["apoyo_dual"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_apoyo", $datos["estado_apoyo"], PDO::PARAM_INT);
        $stmt->bindParam(":informacion_apoyo", $datos["informacion_apoyo"], PDO::PARAM_STR);
        $stmt->bindParam(":apoyo_icono", $datos["apoyo_icono"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // EDITAR APOYO
    static public function mdlEditarApoyo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion_apoyo = :descripcion_apoyo, apoyo_dual = :apoyo_dual, estado_apoyo = :estado_apoyo, informacion_apoyo = :informacion_apoyo, apoyo_icono = :apoyo_icono WHERE id_apoyo = :id_apoyo");

        $stmt->bindParam(":descripcion_apoyo", $datos["descripcion_apoyo"], PDO::PARAM_STR);
        $stmt->bindParam(":apoyo_dual", $datos["apoyo_dual"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_apoyo", $datos["estado_apoyo"], PDO::PARAM_INT);
        $stmt->bindParam(":informacion_apoyo", $datos["informacion_apoyo"], PDO::PARAM_STR);
        $stmt->bindParam(":apoyo_icono", $datos["apoyo_icono"], PDO::PARAM_STR);
        $stmt->bindParam(":id_apoyo", $datos["id_apoyo"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // BORRAR APOYO (Inhabilitar / Eliminar)
    static public function mdlBorrarApoyo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_apoyo = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}

<?php

require_once "conexion.php";

class ModeloIconos
{
    // LISTAR ICONOS ACTIVOS
    static public function mdlListarIconosActivos($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT nombre, codigo_fa FROM $tabla WHERE estado = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

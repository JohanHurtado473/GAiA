<?php

class ControladorIconos
{
    // MOSTRAR ICONOS
    static public function ctrMostrarIconosActivos()
    {
        $tabla = "iconos";
        $respuesta = ModeloIconos::mdlListarIconosActivos($tabla);
        return $respuesta;
    }
}

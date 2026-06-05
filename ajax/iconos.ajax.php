<?php

require_once "../controladores/iconos.controlador.php";
require_once "../modelos/iconos.modelo.php";

class AjaxIconos
{
    public function ajaxCargarIconos()
    {
        $respuesta = ControladorIconos::ctrMostrarIconosActivos();
        echo json_encode($respuesta);
    }
}

if(isset($_POST["cargarIconos"])){
    $iconos = new AjaxIconos();
    $iconos->ajaxCargarIconos();
}

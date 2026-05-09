<?php

require_once "../controladores/sedes.controlador.php";
require_once "../modelos/sedes.modelo.php";

class AjaxSedes{

    public $nuevaDescripcionSede;

    public function ajaxValidarSede(){

        $item = "descripcion_sede";
        $valor = $this->nuevaDescripcionSede;

        $respuesta = ControladorSedes::ctrMostrarSedes($item, $valor);

        echo json_encode($respuesta);

    }

}

if (isset($_POST["nuevaDescripcionSede"])) {
    $valSede = new AjaxSedes();
    $valSede->nuevaDescripcionSede = $_POST["nuevaDescripcionSede"];
    $valSede->ajaxValidarSede();
}

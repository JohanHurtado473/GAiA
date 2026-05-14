<?php

require_once "../controladores/fichas.controlador.php";
require_once "../modelos/fichas.modelo.php";

class AjaxFichas{

    public $nuevoCodigoFicha;

    public function ajaxValidarFicha(){

        $item = "codigo";
        $valor = $this->nuevoCodigoFicha;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);

        echo json_encode($respuesta);

    }

}

if (isset($_POST["nuevoCodigoFicha"])) {
    $valFicha = new AjaxFichas();
    $valFicha->nuevoCodigoFicha = $_POST["nuevoCodigoFicha"];
    $valFicha->ajaxValidarFicha();
}
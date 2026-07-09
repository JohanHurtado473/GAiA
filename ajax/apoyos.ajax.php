<?php

require_once "../controladores/apoyos.controlador.php";
require_once "../modelos/apoyos.modelo.php";

class AjaxApoyos
{

    // CAMBIAR ESTADO DUAL APOYO
    public $idApoyoDual;
    public $estadoDual;

    public function ajaxCambiarDualApoyo()
    {
        $item1 = "apoyo_dual";
        $valor1 = $this->estadoDual;
        $item2 = "id_apoyo";
        $valor2 = $this->idApoyoDual;

        $respuesta = ControladorApoyos::ctrActualizarApoyo($item1, $valor1, $item2, $valor2);
        echo $respuesta ? 'ok' : 'error';
    }

    // CAMBIAR ESTADO DEL APOYO
    public $idEstadoApoyo;
    public $estadoApoyo;

    public function ajaxCambiarEstadoApoyo()
    {
        $item1 = "estado_apoyo";
        $valor1 = $this->estadoApoyo;
        $item2 = "id_apoyo";
        $valor2 = $this->idEstadoApoyo;

        $respuesta = ControladorApoyos::ctrActualizarApoyo($item1, $valor1, $item2, $valor2);
        echo $respuesta ? 'ok' : 'error';
    }

    // EDITAR APOYO
    public $idApoyo;

    public function ajaxEditarApoyo()
    {
        $item = "id_apoyo";
        $valor = $this->idApoyo;
        $respuesta = ControladorApoyos::ctrMostrarApoyos($item, $valor);
        echo json_encode($respuesta);
    }
}

/*=============================================
CAMBIAR APOYO DUAL
=============================================*/
if (isset($_POST["estadoDual"])) {
    $cambiarDual = new AjaxApoyos();
    $cambiarDual->idApoyoDual = $_POST["idApoyoDual"];
    $cambiarDual->estadoDual = $_POST["estadoDual"];
    $cambiarDual->ajaxCambiarDualApoyo();
}

/*=============================================
CAMBIAR ESTADO DEL APOYO
=============================================*/
if (isset($_POST["estadoApoyo"])) {
    $cambiarEstado = new AjaxApoyos();
    $cambiarEstado->idEstadoApoyo = $_POST["idEstadoApoyo"];
    $cambiarEstado->estadoApoyo = $_POST["estadoApoyo"];
    $cambiarEstado->ajaxCambiarEstadoApoyo();
}

/*=============================================
EDITAR APOYO
=============================================*/
if (isset($_POST["idApoyo"])) {
    $editar = new AjaxApoyos();
    $editar->idApoyo = $_POST["idApoyo"];
    $editar->ajaxEditarApoyo();
}

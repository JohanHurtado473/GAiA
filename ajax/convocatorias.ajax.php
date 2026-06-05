<?php

require_once "../controladores/convocatorias.controlador.php";
require_once "../modelos/convocatorias.modelo.php";

class AjaxConvocatorias {

    // ==============================================
    // EDITAR CONVOCATORIA (Traer datos)
    // ==============================================
    public $idConvocatoria;

    public function ajaxEditarConvocatoria() {
        // En tu tabla la PK es 'id' según deducimos.
        $item = "id"; 
        $valor = $this->idConvocatoria;

        // Trae los datos de la cabecera
        $respuestaConvocatoria = ControladorConvocatorias::ctrMostrarConvocatoria($item, $valor);
        
        // Trae los requisitos del baremo
        $respuestaBaremo = ControladorConvocatorias::ctrMostrarBaremo($valor);

        // Retorna un JSON unificado con toda la data
        echo json_encode([
            "convocatoria" => $respuestaConvocatoria,
            "baremo" => $respuestaBaremo
        ]);
    }
}

// ==============================================
// RECEPCION AJAX
// ==============================================
if(isset($_POST["idConvocatoria"])) {
    $editar = new AjaxConvocatorias();
    $editar->idConvocatoria = $_POST["idConvocatoria"];
    $editar->ajaxEditarConvocatoria();
}

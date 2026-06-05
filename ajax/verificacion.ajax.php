<?php

require_once "../controladores/verificacion.controlador.php";
require_once "../modelos/verificacion.modelo.php";
require_once "../controladores/convocatorias.controlador.php";
require_once "../modelos/convocatorias.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../modelos/inscripciones.modelo.php";

class AjaxVerificacion {

    public $idConvocatoria;
    public $documentoId;
    public $estado;
    public $observacion;

    // ==============================================
    // CARGAR INSCRITOS Y SUS DOCUMENTOS DE CONVOCATORIA
    // ==============================================
    public function ajaxCargarPostulaciones() {
        $respuesta = ControladorVerificacion::ctrListarPostulacionesGestor($this->idConvocatoria);
        
        // También obtener los requisitos para que el JS dibuje los headers correspondientes
        $requisitos = ControladorConvocatorias::ctrMostrarBaremo($this->idConvocatoria);

        echo json_encode([
            "status" => "success",
            "requisitos" => $requisitos,
            "postulaciones" => $respuesta
        ]);
    }

    // ==============================================
    // EVALUAR UN DOCUMENTO
    // ==============================================
    public function ajaxEvaluarDocumento() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $evaluadorId = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
        if (!$evaluadorId) {
            echo json_encode(["status" => "error", "message" => "Sesión de gestora inválida."]);
            return;
        }

        $respuesta = ControladorVerificacion::ctrEvaluarDocumento(
            $this->documentoId, 
            $this->estado, 
            $this->observacion, 
            $evaluadorId
        );

        echo json_encode($respuesta);
    }

}

// ==============================================
// GESTIONAR PETICIONES POST
// ==============================================
if (isset($_POST["action"])) {

    $ajax = new AjaxVerificacion();

    // 1. Cargar postulaciones
    if ($_POST["action"] === "cargarPostulaciones" && isset($_POST["idConvocatoria"])) {
        $ajax->idConvocatoria = $_POST["idConvocatoria"];
        $ajax->ajaxCargarPostulaciones();
    }

    // 2. Evaluar un documento
    if ($_POST["action"] === "evaluarDocumento" && isset($_POST["documentoId"]) && isset($_POST["estado"])) {
        $ajax->documentoId = $_POST["documentoId"];
        $ajax->estado = $_POST["estado"];
        $ajax->observacion = isset($_POST["observacion"]) ? $_POST["observacion"] : "";
        $ajax->ajaxEvaluarDocumento();
    }

}

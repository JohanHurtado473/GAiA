<?php

class ControladorInscripciones {


    // ==============================================
    // LISTAR POSTULACIONES REALIZADAS POR EL APRENDIZ
    // ==============================================
    static public function ctrListarPostulacionesUsuario() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["id"])) {
            $tablaInscripciones = "inscripciones";
            $tablaConvocatorias = "convocatorias";
            $tablaApoyos = "apoyos";
            $usuarioId = $_SESSION["id"];

            $respuesta = ModeloInscripciones::mdlListarPostulacionesUsuario($tablaInscripciones, $tablaConvocatorias, $tablaApoyos, $usuarioId);
            return $respuesta;
        }

        return array();
    }

    // ==============================================
    // CARGAR UN ARCHIVO E INTEGRAR EN BASE DE DATOS
    // ==============================================
    static public function ctrSubirDocumento($file, $convocatoriaId, $nombreDoc) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["id"])) {
            return array("status" => "error", "message" => "Sesión de usuario no válida.");
        }

        $usuarioId = $_SESSION["id"];
        $cedula = $_SESSION["documento"];
        $nombres = $_SESSION["nombres"];
        $apellidos = $_SESSION["apellidos"];
        
        // Ficha ID de respaldo en caso de que esté vacía
        $fichaId = isset($_SESSION["ficha_id"]) && $_SESSION["ficha_id"] != "" ? $_SESSION["ficha_id"] : null;
        if ($fichaId === null) {
            // Consulta de respaldo por base de datos
            $usuario = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id", $usuarioId);
            $fichaId = ($usuario && isset($usuario["ficha_id"])) ? $usuario["ficha_id"] : 1; // Default a 1 si no tiene asignada
        }

        // --- 1. VALIDACIÓN DEL ARCHIVO ---
        
        // Validar que sea PDF
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        if (strtolower($ext) != "pdf" || $file["type"] != "application/pdf") {
            return array("status" => "error", "message" => "Formato no permitido. Solo se admiten documentos PDF.");
        }

        // Validar tamaño (máximo 5MB = 5 * 1024 * 1024 bytes)
        $maxSize = 5 * 1024 * 1024;
        if ($file["size"] > $maxSize) {
            return array("status" => "error", "message" => "El archivo supera el tamaño máximo permitido de 5 MB.");
        }

        // --- 2. PREPARAR CARPETAS Y RUTAS ---
        
        // Carpeta raíz en el proyecto
        $raizProyecto = dirname(__DIR__); // C:\xampp\htdocs\GAiA
        $carpetaDocumentos = $raizProyecto . "/documentos";
        $carpetaCedula = $carpetaDocumentos . "/" . $cedula;

        // Crear carpeta general si no existe
        if (!file_exists($carpetaDocumentos)) {
            mkdir($carpetaDocumentos, 0777, true);
        }

        // Crear carpeta de la cédula del aprendiz si no existe
        if (!file_exists($carpetaCedula)) {
            mkdir($carpetaCedula, 0777, true);
        }

        // --- 3. SANITIZAR Y RENOMBRAR ARCHIVO ---
        
        // Sanitizar el nombre del requisito
        $nombreDocSanitizado = self::sanitizarCadena($nombreDoc);
        
        // Sanitizar el nombre completo del aprendiz
        $nombreAprendizCompleto = self::sanitizarCadena($nombres . " " . $apellidos);

        // Armar nombre del archivo: nombre_documento_cedula_nombreAprendiz.pdf
        $nombreArchivo = $nombreDocSanitizado . "_" . $cedula . "_" . $nombreAprendizCompleto . ".pdf";
        $rutaCompletaDestino = $carpetaCedula . "/" . $nombreArchivo;

        // Ruta relativa que se guardará en la base de datos
        $rutaDB = "documentos/" . $cedula . "/" . $nombreArchivo;

        // --- 4. PERSISTENCIA DE INSCRIPCIÓN ---
        
        // Verificar si el aprendiz ya tiene una inscripción a esta convocatoria
        $inscripcion = ModeloInscripciones::mdlMostrarInscripcionUsuario("inscripciones", $usuarioId, $convocatoriaId);

        if ($inscripcion) {
            $inscripcionId = $inscripcion["id"];
        } else {
            // Crear inscripción inicial en estado PENDIENTE
            $datosInscripcion = array(
                "usuario_id" => $usuarioId,
                "convocatoria_id" => $convocatoriaId,
                "ficha_id" => $fichaId
            );
            $inscripcionId = ModeloInscripciones::mdlCrearInscripcion("inscripciones", $datosInscripcion);
            
            if (!$inscripcionId) {
                return array("status" => "error", "message" => "Error al registrar la postulación en la base de datos.");
            }
        }

        // --- 5. ALMACENAR ARCHIVO FÍSICAMENTE ---
        if (move_uploaded_file($file["tmp_name"], $rutaCompletaDestino)) {
            
            // --- 6. REGISTRAR DOCUMENTO EN BASE DE DATOS ---
            $datosDoc = array(
                "inscripcion_id" => $inscripcionId,
                "nombre_doc" => $nombreDoc,
                "url_copia" => $rutaDB
            );

            $registroDB = ModeloInscripciones::mdlRegistrarDocumento("inscripcion_documentos", $datosDoc);

            if ($registroDB == "ok") {
                return array(
                    "status" => "success", 
                    "message" => "Archivo subido y registrado correctamente.",
                    "url" => $rutaDB,
                    "nombre_archivo" => $nombreArchivo,
                    "inscripcion_id" => $inscripcionId
                );
            } else {
                // Eliminar archivo físico en caso de fallo en BD
                if (file_exists($rutaCompletaDestino)) {
                    unlink($rutaCompletaDestino);
                }
                return array("status" => "error", "message" => "Error al guardar la ruta del archivo en la base de datos.");
            }

        } else {
            return array("status" => "error", "message" => "Error al mover el archivo al servidor. Verifica permisos de escritura.");
        }
    }

    // ==============================================
    // LIMPIAR DOCUMENTO (ELIMINACIÓN DE ARCHIVO)
    // ==============================================
    static public function ctrEliminarDocumento($idDoc, $rutaArchivo) {
        $raizProyecto = dirname(__DIR__);
        $rutaFisica = $raizProyecto . "/" . $rutaArchivo;

        // 1. Eliminar archivo físico si existe
        if (file_exists($rutaFisica)) {
            unlink($rutaFisica);
        }

        // 2. Limpiar registros en la base de datos (volver URL = NULL)
        $respuesta = ModeloInscripciones::mdlLimpiarDocumento("inscripcion_documentos", $idDoc);
        return $respuesta;
    }

    // ==============================================
    // AUXILIAR: SANITIZAR CADENAS DE TEXTO
    // ==============================================
    static private function sanitizarCadena($cadena) {
        // Reemplazar caracteres especiales y acentos
        $originales = array('Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú', 'Ñ', 'ñ', 'ü', 'Ü');
        $reemplazos = array('A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', 'N', 'n', 'u', 'U');
        $cadena = str_replace($originales, $reemplazos, $cadena);
        
        // Convertir a minúsculas
        $cadena = strtolower($cadena);
        
        // Reemplazar todo lo que no sea letras, números o espacios por guiones bajos
        $cadena = preg_replace('/[^a-z0-9\s]/', '', $cadena);
        
        // Reemplazar múltiples espacios por un guión bajo único
        $cadena = preg_replace('/\s+/', '_', trim($cadena));
        
        return $cadena;
    }

}

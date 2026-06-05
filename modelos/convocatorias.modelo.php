<?php

require_once "conexion.php";

class ModeloConvocatorias {

    // ==============================================
    // CREAR CONVOCATORIA (Transacción)
    // ==============================================
    static public function mdlCrearConvocatoria($tabla, $datos, $baremo) {
        $conexion = Conexion::conectar();
        
        try {
            // Iniciar transacción
            $conexion->beginTransaction();

            // 1. Insertar Convocatoria
            $stmt = $conexion->prepare("INSERT INTO $tabla (apoyo_id, fecha_inicio, fecha_fin, cupos_personas, duracion_meses, estado_en_convocatoria) VALUES (:apoyo_id, :fecha_inicio, :fecha_fin, :cupos_personas, :duracion_meses, :estado_en_convocatoria)");

            $stmt->bindParam(":apoyo_id", $datos["apoyo_id"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":cupos_personas", $datos["cupos_personas"], PDO::PARAM_INT);
            $stmt->bindParam(":duracion_meses", $datos["duracion_meses"], PDO::PARAM_INT);
            $stmt->bindParam(":estado_en_convocatoria", $datos["estado_en_convocatoria"], PDO::PARAM_STR);

            $stmt->execute();
            
            // Obtener ID generado (Asume que PK es AUTO_INCREMENT)
            $convocatoria_id = $conexion->lastInsertId();

            // 2. Insertar Baremo (si existe array)
            if(isset($baremo['nombre_item']) && is_array($baremo['nombre_item'])) {
                $stmtBaremo = $conexion->prepare("INSERT INTO baremo_config (convocatoria_id, nombre_item, puntaje_valor, es_critico) VALUES (:convocatoria_id, :nombre_item, :puntaje_valor, :es_critico)");

                for($i = 0; $i < count($baremo['nombre_item']); $i++) {
                    $nombre = $baremo['nombre_item'][$i];
                    $puntaje = $baremo['puntaje_valor'][$i];
                    $critico = $baremo['es_critico'][$i];

                    $stmtBaremo->bindParam(":convocatoria_id", $convocatoria_id, PDO::PARAM_INT);
                    $stmtBaremo->bindParam(":nombre_item", $nombre, PDO::PARAM_STR);
                    $stmtBaremo->bindParam(":puntaje_valor", $puntaje, PDO::PARAM_STR);
                    $stmtBaremo->bindParam(":es_critico", $critico, PDO::PARAM_INT);
                    
                    $stmtBaremo->execute();
                }
            }

            // Confirmar transacción si todo salió bien
            $conexion->commit();
            return "ok";

        } catch (Exception $e) {
            // Revertir cambios en caso de error
            $conexion->rollBack();
            return "error: " . $e->getMessage();
        }
    }

    // ==============================================
    // LISTAR TODAS LAS CONVOCATORIAS
    // ==============================================
    static public function mdlListarConvocatorias($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY 1 DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ==============================================
    // MOSTRAR UNA SOLA CONVOCATORIA
    // ==============================================
    static public function mdlMostrarConvocatoria($tabla, $item, $valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    // ==============================================
    // MOSTRAR BAREMO DE UNA CONVOCATORIA
    // ==============================================
    static public function mdlMostrarBaremo($valor) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM baremo_config WHERE convocatoria_id = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ==============================================
    // EDITAR CONVOCATORIA (Transacción)
    // ==============================================
    static public function mdlEditarConvocatoria($tabla, $datos, $baremo) {
        $conexion = Conexion::conectar();
        
        try {
            // Iniciar transacción
            $conexion->beginTransaction();

            // PK suele ser id (asumiendo por defecto)
            $id = $datos["id_convocatoria"];

            // 1. Actualizar Convocatoria (asumo PK 'id', si es distinto el query fallaría, pero se maneja en el exception)
            // Se asume PK 'id', si en tu BD es 'id_convocatoria' cambiar 'id = :id' por 'id_convocatoria = :id'
            $stmt = $conexion->prepare("UPDATE $tabla SET apoyo_id = :apoyo_id, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, cupos_personas = :cupos_personas, duracion_meses = :duracion_meses, estado_en_convocatoria = :estado_en_convocatoria WHERE id = :id");

            $stmt->bindParam(":apoyo_id", $datos["apoyo_id"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
            $stmt->bindParam(":cupos_personas", $datos["cupos_personas"], PDO::PARAM_INT);
            $stmt->bindParam(":duracion_meses", $datos["duracion_meses"], PDO::PARAM_INT);
            $stmt->bindParam(":estado_en_convocatoria", $datos["estado_en_convocatoria"], PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            
            // 2. Eliminar el Baremo Anterior
            $stmtDelete = $conexion->prepare("DELETE FROM baremo_config WHERE convocatoria_id = :id");
            $stmtDelete->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtDelete->execute();

            // 3. Insertar Baremo Nuevo (si existe array)
            if(isset($baremo['nombre_item']) && is_array($baremo['nombre_item'])) {
                $stmtBaremo = $conexion->prepare("INSERT INTO baremo_config (convocatoria_id, nombre_item, puntaje_valor, es_critico) VALUES (:convocatoria_id, :nombre_item, :puntaje_valor, :es_critico)");

                for($i = 0; $i < count($baremo['nombre_item']); $i++) {
                    $nombre = $baremo['nombre_item'][$i];
                    $puntaje = $baremo['puntaje_valor'][$i];
                    $critico = $baremo['es_critico'][$i];

                    $stmtBaremo->bindParam(":convocatoria_id", $id, PDO::PARAM_INT);
                    $stmtBaremo->bindParam(":nombre_item", $nombre, PDO::PARAM_STR);
                    $stmtBaremo->bindParam(":puntaje_valor", $puntaje, PDO::PARAM_STR);
                    $stmtBaremo->bindParam(":es_critico", $critico, PDO::PARAM_INT);
                    
                    $stmtBaremo->execute();
                }
            }

            // Confirmar transacción si todo salió bien
            $conexion->commit();
            return "ok";

        } catch (Exception $e) {
            // Revertir cambios en caso de error
            $conexion->rollBack();
            return "error: " . $e->getMessage();
        }
    }

    // ==============================================
    // LISTAR TODAS LAS CONVOCATORIAS ABIERTAS
    // ==============================================
    static public function mdlListarConvocatoriasActivas($tablaConvocatorias, $tablaApoyos) {
        $stmt = Conexion::conectar()->prepare("SELECT c.*, a.descripcion_apoyo, a.informacion_apoyo, a.apoyo_icono 
                                               FROM $tablaConvocatorias c 
                                               INNER JOIN $tablaApoyos a ON c.apoyo_id = a.id_apoyo 
                                               WHERE c.estado_en_convocatoria = 'ABIERTA' 
                                               ORDER BY c.fecha_fin ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

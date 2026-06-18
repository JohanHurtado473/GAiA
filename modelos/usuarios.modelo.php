<?php

require_once "conexion.php";


class ModeloUsuarios
{


    // ************************************
    // LOGIN DE USUARIO 
    // ************************************
    static public function mdlIngresarUsuario($documento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.*, u.doc_identidad_maestro_url AS foto FROM usuarios u WHERE documento_id = :documento");
        $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Normalizar clave `ficha_id` según el nombre real de la columna en la tabla
            if (!isset($row['ficha_id'])) {
                if (isset($row['id_ficha'])) {
                    $row['ficha_id'] = $row['id_ficha'];
                } elseif (isset($row['fichas_id'])) {
                    $row['ficha_id'] = $row['fichas_id'];
                } else {
                    $row['ficha_id'] = null;
                }
            }
        }

        return $row;
    }  //fin del metodo mdlIngresarUsuario


    // ************************************
    // LISA DE DE USUARIOS EN LA VENTANA PRINCIPAL
    // ************************************    
    static public function mdlListarUsuarios()
    {
        // Selección segura sin referenciar columnas de ficha que pueden no existir
        $stmt = Conexion::conectar()->prepare("SELECT u.* FROM usuarios u WHERE u.rol<>'Administrador';");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$rows) {
            return array();
        }

        // Normalizar clave `ficha_id` y preparar lista de fichas para obtener `codigo`
        $fichaIds = array();
        foreach ($rows as &$r) {
            if (!isset($r['ficha_id'])) {
                if (isset($r['id_ficha'])) {
                    $r['ficha_id'] = $r['id_ficha'];
                } elseif (isset($r['fichas_id'])) {
                    $r['ficha_id'] = $r['fichas_id'];
                } else {
                    $r['ficha_id'] = null;
                }
            }

            // normalizar foto
            if (!isset($r['foto']) && isset($r['doc_identidad_maestro_url'])) {
                $r['foto'] = $r['doc_identidad_maestro_url'];
            }

            if (!empty($r['ficha_id'])) {
                $fichaIds[] = (int)$r['ficha_id'];
            }
        }

        // Obtener códigos de fichas en una sola consulta si hay ids
        $codigoMap = array();
        if (!empty($fichaIds)) {
            $uniqueIds = array_values(array_unique($fichaIds));
            $in = implode(',', array_map('intval', $uniqueIds));
            $stmt2 = Conexion::conectar()->prepare("SELECT id_ficha, codigo FROM fichas WHERE id_ficha IN ($in)");
            $stmt2->execute();
            $fichas = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($fichas as $f) {
                $codigoMap[(int)$f['id_ficha']] = $f['codigo'];
            }
        }

        // Adjuntar codigo a cada fila si existe
        foreach ($rows as &$r) {
            $r['codigo'] = null;
            if (!empty($r['ficha_id'])) {
                $id = (int)$r['ficha_id'];
                if (isset($codigoMap[$id])) {
                    $r['codigo'] = $codigoMap[$id];
                }
            }
        }

        return $rows;
    }

    // ************************************
    // LISTA DE FICHAS
    // ************************************    
    static public function mdlListarFichas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM fichas");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ************************************
    // AGREGAR USUARIO A LA BD
    // ************************************    
        static public function mdlAgregarUsuario($tabla, $datos)
        {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (tipo_documento, documento_id, nombres, apellidos, correo, fecha_nacimiento, rol, password, id_ficha, doc_identidad_maestro_url) VALUES (:tipoDocumento, :documentoId, :nombres, :apellidos, :correo, :fechaNacimiento, :rol, :password, :ficha_id, :foto)");
        $stmt->bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":documentoId", $datos["documentoId"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":ficha_id", $datos["ficha_id"], PDO::PARAM_INT);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        if ($tabla === "usuarios") {
            $stmt = Conexion::conectar()->prepare("SELECT u.* FROM $tabla u WHERE $item = :valor");
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
        }
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
        error_log("valor en el modelo:" . $tabla);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tabla === "usuarios" && $row) {
            if (!isset($row['ficha_id'])) {
                if (isset($row['id_ficha'])) {
                    $row['ficha_id'] = $row['id_ficha'];
                } elseif (isset($row['fichas_id'])) {
                    $row['ficha_id'] = $row['fichas_id'];
                } else {
                    $row['ficha_id'] = null;
                }
            }

            if (!isset($row['foto']) && isset($row['doc_identidad_maestro_url'])) {
                $row['foto'] = $row['doc_identidad_maestro_url'];
            }
        }

        return $row;
    }

    // ************************************
    // EDITAR USUARIO EN LA BD
    // ************************************    
        static public function mdlEditarUsuario($tabla, $datos)
        {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_documento = :tipoDocumento, documento_id = :documentoId, nombres = :nombres, apellidos = :apellidos, correo = :correo, fecha_nacimiento = :fechaNacimiento, rol = :rol, password = :password, id_ficha = :ficha_id, doc_identidad_maestro_url = :foto WHERE id = :id");
        
        $stmt->bindParam(":tipoDocumento", $datos["tipoDocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":documentoId", $datos["documentoId"], PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":ficha_id", $datos["ficha_id"], PDO::PARAM_INT);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // ************************************
    // EDITAR PERFIL EN LA BD
    // ************************************    
    static public function mdlEditarPerfil($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres = :nombres, apellidos = :apellidos, password = :password, doc_identidad_maestro_url = :foto WHERE id = :id");
        
        $stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    // ************************************
    // ACTUALIZAR ESTADO DE UN USUARIO
    // ************************************
    static public function mdlCambiarEstadoUsuario($tabla, $idUsuario, $estado)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }  // fin del metodo mdlCambiarEstadoUsuario

    // ************************************
    // ACTUALIZAR CONTRASEÑA (MIGRACIÓN)
    // ************************************
    static public function mdlActualizarPassword($idUsuario, $password)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET password = :password WHERE id = :id");
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

} // fin de la clase ModeloUsuarios
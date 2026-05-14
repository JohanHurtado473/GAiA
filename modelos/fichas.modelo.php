<?php

require_once "conexion.php";

class ModeloFichas{

	/*=============================================
	LISTAR FICHAS
	=============================================*/
	static public function mdlListarFichas(){
		$stmt = Conexion::conectar()->prepare("SELECT f.*, s.descripcion_sede FROM fichas f LEFT JOIN sedes s ON s.id_sede = f.sede_id");
		$stmt -> execute();
		return $stmt -> fetchAll();
	}

	/*=============================================
	MOSTRAR FICHA
	=============================================*/
	static public function mdlMostrarFichas($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor");
		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	}

	/*=============================================
	AGREGAR FICHA
	=============================================*/
	static public function mdlAgregarFicha($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, sede_id) VALUES (:codigo, :sedeId)");
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":sedeId", $datos["sedeId"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
	}

}
<?php
require_once "modelos/conexion.php";

try {
    // Verificar estructura de la tabla fichas
    $stmt = Conexion::conectar()->prepare("DESCRIBE fichas;");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Columnas en 'fichas':<br>";
    foreach ($columns as $col) {
        echo $col['Field'] . " - " . $col['Type'] . "<br>";
    }
    echo "<br>";

    // Verificar estructura de la tabla usuarios
    $stmt2 = Conexion::conectar()->prepare("DESCRIBE usuarios;");
    $stmt2->execute();
    $columns2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    echo "Columnas en 'usuarios':<br>";
    foreach ($columns2 as $col) {
        echo $col['Field'] . " - " . $col['Type'] . "<br>";
    }
    echo "<br>";

    // Intentar la consulta original
    $stmt3 = Conexion::conectar()->prepare("SELECT u.*, f.codigo FROM usuarios u LEFT JOIN fichas f ON f.id = u.ficha_id WHERE u.rol<>'ADMIN';");
    $stmt3->execute();
    $result = $stmt3->fetchAll();
    echo "Consulta exitosa. Resultados: " . count($result);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
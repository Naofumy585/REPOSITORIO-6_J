<?php
// barra.php

require_once '../conexion.php';

class Barra {
    public function buscar($keyword) {
        // Construir la consulta para obtener los detalles de los podcasts
        $query = "SELECT Nombre, Genero, Autor, DireccionM FROM t_podcastm 
                  WHERE LOWER(Nombre) LIKE LOWER(:keyword) 
                  OR LOWER(Genero) LIKE LOWER(:keyword) 
                  OR LOWER(Autor) LIKE LOWER(:keyword)
                  OR LOWER(PalabraClave) LIKE LOWER(:keyword)";

        try {
            // Obtener una instancia de la conexión
            $conexion = new Conexion();

            // Preparar la consulta con PDO
            $stmt = $conexion->prepare($query);

            // Bind de parámetros
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados de la consulta
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }
}

// Verificar si se ha enviado una consulta
if(isset($_POST['query'])) {
    $keyword = $_POST['query'];
    $barra = new Barra();
    $resultados = $barra->buscar($keyword);

    if ($resultados) {
        // Redireccionar a buscar.php con los resultados
        header("Location: ../vistas/buscar.php?keyword=" . urlencode($keyword));
        exit();
    } else {
        echo "No se encontraron resultados para: " . $keyword;
    }
} else {
    echo "No se proporcionó ninguna palabra clave.";
}
?>
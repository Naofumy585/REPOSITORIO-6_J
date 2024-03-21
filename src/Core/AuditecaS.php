<?php
require('../conexion.php'); // Incluir el archivo de conexión

class Audios {
    public function AnadirP() {
        // Verificar si el formulario ha sido enviado después de la confirmación del usuario
        if (isset($_POST['confirmacion']) && $_POST['confirmacion'] === 'si') {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener la conexión desde la variable miembro
                $conexion = new Conexion();
                // Obtener los valores del formulario
                $nombre = $_POST['Nombre'];
                $genero = $_POST['Genero'];
                $autor = $_POST['Autor'];
                $fechaC = $_POST['FechaC'];
                $palabraClave = $_POST['PalabraClave'];
                $url = $_POST['URl'];
                $direccionM = '';
            
                // Verificar si se proporcionó una URL
                if (!empty($url)) {
                    // Se proporcionó una URL, usarla directamente
                    $direccionM = $url;
                } else {
                    // No se proporcionó una URL, verificar si se seleccionó un archivo para cargar
                    if (isset($_FILES['DireccionM']) && $_FILES['DireccionM']['error'] === UPLOAD_ERR_OK) {
                        // Se seleccionó un archivo, moverlo a la ubicación especificada y renombrarlo
                        $nombreArchivo = $_FILES['DireccionM']['name'];
                        $archivoTemp = $_FILES['DireccionM']['tmp_name'];
                        
                        // Obtener la extensión del archivo
                        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                        
                        // Construir el nuevo nombre de archivo con el nombre del archivo original y la extensión
                        $nuevoNombreArchivo = $nombre . '.' . $extension;
                        
                        // Definir la ruta de destino con el nuevo nombre de archivo
                        $direccionM = '../vistas/Audioteca/' . $nuevoNombreArchivo;
            
                        // Mover el archivo a la ubicación especificada con el nuevo nombre
                        if (!move_uploaded_file($archivoTemp, $direccionM)) {
                            // Error al mover el archivo
                            echo '<script>alert("Error al mover el archivo.");</script>';
                            exit(); // Detener la ejecución del script
                        }
                    } else {
                        // No se seleccionó un archivo y no se proporcionó una URL, mostrar un mensaje de error
                        echo '<script>alert("No se ha seleccionado ningún archivo ni proporcionado una URL.");</script>';
                        exit(); // Detener la ejecución del script
                    }
                }
            
                // Preparar la consulta SQL para insertar los datos en la tabla
                $sql = "INSERT INTO t_podcastm (Nombre, DireccionM, Genero, autor, FechaC, PalabraClave, URL) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
                // Preparar la sentencia SQL
                $stmt = $conexion->prepare($sql);
            
                // Ejecutar la sentencia SQL con los valores proporcionados
                $stmt->execute([$nombre, $direccionM, $genero, $autor, $fechaC, $palabraClave, $url]);
            
                // Verificar si se insertaron los datos correctamente
                if ($stmt->rowCount() > 0) {
                    // Los datos se insertaron correctamente
                    echo '<script>alert("Los datos se han insertado correctamente.");</script>';
                    // Redirigir a la página principal
                    header('Location: ../vistas/Audioteca.php');
                    exit; // Asegúrate de que no haya más salida después de redirigir
                } else {
                    // Hubo un error al insertar los datos
                    echo '<script>alert("Hubo un error al insertar los datos. Por favor, inténtalo de nuevo.");</script>';
                }
            }
        } elseif (isset($_POST['confirmacion']) && $_POST['confirmacion'] === 'no') {
            // Si el usuario cancela, redirigir al formulario de nuevo
            header('Location: ../vistas/añadirP.php');
            exit;
        }
    }
    public function Buscar($query) {
        // Preparar la consulta SQL para buscar contratos
        $sqlContratos = "SELECT * FROM datos_pdf WHERE LOWER(Direccion) LIKE LOWER(:query)";
    
        // Preparar la consulta SQL para buscar audios
        $sqlAudios = "SELECT * FROM t_podcastm
                      WHERE LOWER(Nombre) LIKE LOWER(:query)
                      OR LOWER(autor) LIKE LOWER(:query)
                      OR LOWER(Genero) LIKE LOWER(:query)
                      OR LOWER(PalabraClave) LIKE LOWER(:query)";
    
        // Obtener una instancia de la conexión
        $conn = new Conexion();
    
        try {
            // Preparar la consulta de contratos con PDO
            $stmtContratos = $conn->prepare($sqlContratos);
            $stmtContratos->bindValue(':query', '%' . $query . '%');
    
            // Ejecutar la consulta de contratos
            $stmtContratos->execute();
            $contratos = $stmtContratos->fetchAll(PDO::FETCH_ASSOC);
    
            // Preparar la consulta de audios con PDO
            $stmtAudios = $conn->prepare($sqlAudios);
            $stmtAudios->bindValue(':query', '%' . $query . '%');
    
            // Ejecutar la consulta de audios
            $stmtAudios->execute();
            $audios = $stmtAudios->fetchAll(PDO::FETCH_ASSOC);
    
            // Combinar los resultados de contratos y audios
            $resultados = array_merge($contratos, $audios);
    
            // Redireccionar a la página de búsqueda con los resultados
            header('Location: ../vistas/buscar.php?resultados=' . urlencode(json_encode($resultados)));
            exit;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            echo "Error al ejecutar la consulta: " . $e->getMessage();
        }
    }
}
// Instanciar la clase Audios
$audios = new Audios();
// Llamar al método AnadirP
$audios->AnadirP();
?>
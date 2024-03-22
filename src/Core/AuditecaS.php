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
                $direccionM = null; // Inicializar a null por defecto
    
                // Verificar si no se proporcionó una URL y si se seleccionó un archivo
                if (empty($url) && isset($_FILES['DireccionM']) && $_FILES['DireccionM']['error'] === UPLOAD_ERR_OK) {
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
                }
            
                // Preparar la consulta SQL para insertar los datos en la tabla
                $sql = "INSERT INTO t_podcastm (Nombre, DireccionM, Genero, Autor, FechaC, PalabraClave, URL) VALUES (?, ?, ?, ?, ?, ?, ?)";
            
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
            header('Location: ../vistas/anadirP.php');
            exit;
        }
    }    
}
// Instanciar la clase Audios
$audios = new Audios();
// Llamar al método AnadirP
$audios->AnadirP();
?>
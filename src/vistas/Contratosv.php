<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./src/controlador/ControlUtilerias/img/Unach.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pomperrier&display=swap">
    <link rel="stylesheet" href="../Bootstrap/css/style_index.css">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <title>Barra de busqueda</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light static-top">
    <ul class="navbar-nav ml-auto">
        <li class="navbar-brand"><p><b>RP </b>6</p></li>
        <li class="nav-item"><a class="nav-link active" href="../../index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="Contratosv.php">Acerca de</a></li>
        <li class="nav-item"><a class="nav-link" href="Audioteca.php">Audioteca</a></li>
        <li class="nav-item"><a class="nav-link disable" href="Contratosv.php" tabindex="-1" aria-disabled="true">Contratos</a></li>
        <!-- Nuevo elemento para el formulario de búsqueda -->
        <li class="nav-item ml-auto">
            <form class="navbar-form ml-auto" action="buscar.php" method="POST">
                <div class="input-group">
                     <input class="form-control" type="search" placeholder="Buscar..." aria-label="Search" name="query">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </div>
                    </div>
            </form>
        </li>
    </ul>
</nav><br>
    <?php
require_once '../conexion.php'; // Reemplaza 'ruta_de_tu_archivo_de_conexion.php' con la ruta correcta

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

try {
    // Obtener los nombres de los archivos de la base de datos
    $stmt = $conexion->prepare("SELECT direccion FROM direccion_pdf");
    $stmt->execute();
    $archivos = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    echo "Error al obtener los nombres de los archivos: " . $e->getMessage();
}

// Inicio de la tabla
echo '<h1>Resultados de búsqueda</h1>';
echo '<table border="1">';
echo '<tr>';
echo '<th>PDF</th>';
echo '<th>Imprimir</th>';
echo '</tr>';

// Iterar sobre los nombres de los archivos
foreach ($archivos as $archivo) {
    // Obtener solo los últimos caracteres del nombre del archivo
    $nombreCorto = substr($archivo, 9); // Omitir los primeros 8 caracteres
    echo '<tr>';
    echo '<td><img src="../img/pdf.svg" alt="PDF Icon" style="width: 30px; height: 30px;"> ' . $nombreCorto . '</td>';
    echo '<td><a href="../vistas/Contratos/' . $archivo . '" target="_blank"><button class="btn btn-outline-success">Imprimir</button></a></td>';
    echo '</tr>';
}

// Fin de la tabla
echo '</table>';
?>
</body>
</html>
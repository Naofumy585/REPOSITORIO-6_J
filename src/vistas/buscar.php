<?php
require_once '../conexion.php';

if(isset($_POST['query'])) {
    $keyword = $_POST['query'];

    // Aquí debes incluir tu lógica para buscar los resultados en la base de datos
    // Reemplaza esta sección con tu código existente para obtener los resultados

    // Ejemplo de consulta SQL para buscar en la tabla t_podcastm
    $sql = "SELECT Nombre, Genero, Autor, PalabraClave, DireccionM FROM t_podcastm 
            WHERE LOWER(Nombre) LIKE LOWER(:query)
            OR LOWER(Autor) LIKE LOWER(:query)";

    try {
        // Obtener una instancia de la conexión
        $conn = new Conexion();

        // Preparar la consulta con PDO
        $stmt = $conn->prepare($sql);

        // Asignar valor al parámetro :query
        $stmt->bindValue(':query', '%' . $keyword . '%', PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados de la consulta
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($resultados) {
            // Mostrar los resultados en forma de tarjetas
            ?>
            <!DOCTYPE html>
                <html lang="es-MX">
                <head>
                    <link rel="icon" href="../controlador/ControlUtilerias/img/Unach.ico" type="image/x-icon">
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pomperrier&display=swap">
                    <link rel="stylesheet" href="../Bootstrap/css/style_index.css">
                    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
                    <title>Repositorio 6°J</title>
                    <style>
                        .audio-container {
                            max-width: 100%;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            white-space: nowrap;
                        }
                    </style>
                </head>
            <section>
            <nav class="navbar navbar-expand-lg navbar-light static-top">
                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-brand"><p><b>RP </b>6</p></li>
                        <li class="nav-item"><a class="nav-link active" href="../../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="../Core/ContG.php">Acerca de</a></li>
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
                <div class="text-center">
                <h1>FACULTAD DE CONTADURIA Y ADMNINISTRACION CAMPUS I</h1>
                </div><br>
            </section>
            <body>
                <!-- Contenido HTML para mostrar los resultados -->
                <div class="container mt-4">
                    <h1>Resultados de búsqueda para: <?php echo $keyword; ?></h1>
                    <div class="row">
                        <?php foreach ($resultados as $podcast) : ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card mb-4">
                                    <h3 class="card-header"><?php echo $podcast['Nombre']; ?></h3>
                                    <div class="card-body">
                                        <p class="card-text">Autor: <?php echo $podcast['Autor']; ?></p>
                                        <p class="card-text">Género: <?php echo $podcast['Genero']; ?></p>
                                        <!-- Agregar reproductor de audio -->
                                        <div class="audio-container">
                                            <audio controls>
                                                <source src="<?php echo $podcast['DireccionM']; ?>" type="audio/mpeg">
                                                Tu navegador no soporta la reproducción de audio.
                                            </audio>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Scripts de Bootstrap -->
                <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../Bootstrap/js/bootstrap.min.js"></script>
            </body>
            </html>
            <?php
        } else {
            echo "No se encontraron resultados para: " . $keyword;
        }
    } catch (PDOException $e) {
        // Manejar errores de base de datos
        echo "Error al ejecutar la consulta: " . $e->getMessage();
    }
} else {
    echo "No se proporcionó ninguna palabra clave.";
}
?>
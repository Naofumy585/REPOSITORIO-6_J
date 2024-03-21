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
<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-light static-top">
            <ul class="navbar-nav ml-auto">
                <li class="navbar-brand"><p><b>RP </b>6</p></li>
                <li class="nav-item"><a class="nav-link active" href="../../index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="Audioteca.php">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link" href="añadirP.php">Añadir Contenido</a></li>
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
            <h1>FACULTAD DE CONTADURIA Y ADMINISTRACIÓN CAMPUS I</h1>
        </div><br>
        <!-- Formulario de filtro por género, fecha y autor -->
        <form action="" method="GET">
            <div class="form-group">
                <label>Filtrar por género:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="genero_M" name="genero_M" value="M">
                    <label class="form-check-label" for="genero_M">INDAUTOR(MÉXICO)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="genero_O" name="genero_O" value="O">
                    <label class="form-check-label" for="genero_O">Registro en otro país</label>
                </div>
            </div>
            <div class="form-group">
                <label for="fecha">Filtrar por fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control">
            </div>
            <div class="form-group">
                <label for="autor">Filtrar por autor:</label>
                <input type="text" id="autor" name="autor" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <!-- Fin del formulario de filtro -->
    </section>
    <!-- Resultados de la consulta -->
    <div class="container-fluid">
        <h2 class="text-center">Resultados:</h2>
        <div class="row">
            <!-- PHP para consultar y mostrar los audios -->
            <?php
            require('../conexion.php');
            // Construir la consulta SQL con los filtros seleccionados
            $sqlAudios = "SELECT * FROM t_podcastm WHERE 1=1";
            if (isset($_GET['genero_M'])) {
                $sqlAudios .= " AND LOWER(Genero) = 'm'";
            }
            if (isset($_GET['genero_O'])) {
                $sqlAudios .= " AND LOWER(Genero) = 'o'";
            }
            if (isset($_GET['fecha']) && !empty($_GET['fecha'])) {
                $fecha = $_GET['fecha'];
                $sqlAudios .= " AND FechaC = '$fecha'";
            }
            if (isset($_GET['autor']) && !empty($_GET['autor'])) {
                $autor = $_GET['autor'];
                $sqlAudios .= " AND LOWER(Autor) LIKE LOWER('%$autor%')";
            }
            // Ejecutar la consulta y mostrar los resultados
            $conexion = new Conexion();
            $stmt = $conexion->prepare($sqlAudios);
            $stmt->execute();
            $resultados = $stmt->fetchAll();
            foreach ($resultados as $audio) {
                echo '<div class="col-md-6 col-lg-4">';
                echo '<div class="card mb-4">';
                echo '<h3 class="card-header">' . $audio['Nombre'] . '</h3>';
                echo '<div class="card-body">';
                echo '<p class="card-text">Autor: ' . $audio['Autor'] . '</p>';
                echo '<p class="card-text">Fecha: ' . $audio['FechaC'] . '</p>';
                echo '<div class="audio-container">';
                echo '<audio controls>';
                echo '<source src="' . $audio['DireccionM'] . '" type="audio/mpeg">';
                echo 'Tu navegador no soporta la reproducción de audio.';
                echo '</audio>';
                echo '</div>'; // Cierre de audio-container
                
                // Verificar si hay una URL de Spotify disponible
                if (!empty($audio['URL'])) {
                    // Mostrar el reproductor de Spotify
                    echo '<div class="spotify-container">';
                    echo '<iframe src="' . $audio['URL'] . '" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>';
                    echo '</div>'; // Cierre de spotify-container
                }
                
                echo '</div>'; // Cierre de card-body
                echo '</div>'; // Cierre de card
                echo '</div>'; // Cierre de col-md-6
            }            
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</body>
</html>
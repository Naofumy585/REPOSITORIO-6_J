<!DOCTYPE html>
<html lang="es-MX">
<head>
    <link rel="icon" href="../controlador/ControlUtilerias/img/Unach.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pomperrier&display=swap">
    <link rel="stylesheet" href="../Bootstrap/css/style_index.css">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <title>Repositorio 6J</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <main class="content">
            <!-- Contenido principal -->
            <div class="table-container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto nav justify-content-end">
                            <li class="nav-item"><a class="nav-link active" href="../../index.php">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="PDF.php">OTROS TEMAS</a></li>
                            <li class="nav-item"><a class="nav-link" href="Audioteca.php">PODCAST</a></li>
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
                            <li class="nav-item"><a class="nav-link active" href="./Contratos/Contrato.php">Generar Contrato</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
                                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <!-- Fila para el título -->
                            <tr>
                                <td>
                                    <h1>SERVICIOS INFORMATICOS Y ENTORNO LABORAL</h1>
                                </td>
                            </tr>
                            <!-- Fila para visualizar el PDF -->
                            <tr>
                                <td>
                                    <iframe src="../vistas/PDF/CONTRATO INFORMATICO.pdf#page=1" style="width:100%; height:1080px;" frameborder="0"></iframe>
                                </td>
                            </tr>
                            <!-- Fila para el audio -->
                            <tr>
                                <td><iframe style="border-radius:12px" src="https://open.spotify.com/embed/episode/0jmyXej49BvFIFd1TCkRWI?utm_source=generator" width="100%" height="auto" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                                </td>
                            </tr>
                            <!-- Fila para el video -->
                            <tr>
                                <td>
                                    <iframe width="1080" height="450" src="https://www.youtube.com/embed/ubi5DSu06ro?si=UQgEtgacyP-0686W" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
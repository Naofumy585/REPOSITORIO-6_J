<!DOCTYPE html>
<html lang="es-MX">
<head>

    <link rel="icon" href="./src/controlador/ControlUtilerias/img/Unach.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Pomperrier&display=swap">
    <link rel="stylesheet" href="./src/Bootstrap/css/style_index.css">
    <link rel="stylesheet" href="./src/Bootstrap/css/bootstrap.min.css">
    <title>Repositorio 6°J</title>
</head>
<body>

    <div>
            <header>
            <section>
            <nav class="navbar navbar-expand-lg navbar-light static-top">
                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-brand"><p><b>RP </b>6</p></li>
                        <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php">Acerca de</a></li>
                        <li class="nav-item"><a class="nav-link" href="./src/vistas/Audioteca.php">Audioteca</a></li>
                        <li class="nav-item"><a class="nav-link disable" href="./src/vistas/Contratosv.php" tabindex="-1" aria-disabled="true">Contratos</a></li>
                        <!-- Nuevo elemento para el formulario de búsqueda -->
                        <li class="nav-item ml-auto">
                        <form class="navbar-form ml-auto" action="./src/vistas/buscar.php" method="POST">
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
            </header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-center">
                        </div>
                        <div class="col">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="1500"> <!-- Aquí agregamos los atributos data-bs-ride y data-bs-interval -->
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="src/img/RPDG1.svg" alt="Banner">
                                    </div>
                                    <div class="carousel-item">
                                    <img src="src/img/RPDG2.svg" alt="Banner">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="src/img/RPDG3.svg" alt="Banner">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col text-center">
                        </div>
                    </div>
                </div>
                <section id="Tamaños">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="Caja">
                                    <a href="./src/vistas/PDF.php" class="card-link">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="./src/img/Libro.svg" alt="Producto 1" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <div class="card-content">
                                                            <h5 class="card-title"><b>Servicios informaticos y Entorno laboral</b></h5>
                                                            <p class="card-text"> <b>Daniel Cordova Herrera</b></p>
                                                        </div>
                                                        <div class="card-text-hover">
                                                            <h5><b>Servicios informaticos y Entorno laboral</b></h5>
                                                            <p class="card-text" style="text-align: justify;"> El ensayo remarca la importancia que tiene para las partes firmantes, el incluir una cláusula de propiedad intelectual en
                                                            un contrato informático.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="Caja">
                                    <a href="./src/vistas/Audioteca.php" class="card-link">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="src/img/Libro.svg" alt="Producto 2" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <div class="card-content">
                                                            <h5 class="card-title"><b>Trámite ante el INDAUTOR de un programa de computación</b></h5>
                                                            <p class="card-text"> <b>CONACYT & INFOTEC</b></p>
                                                        </div>
                                                        <div class="card-text-hover">
                                                            <h5><b>Registro de sofware ante el INDAUTOR</b></h5>
                                                            <p class="card-text" style="text-align: justify;"> ¿Qué es indautor y cuál es su función?
                                                            Busca dar certeza y seguridad jurídica a los usuarios sobre la protección de sus
                                                             derechos de autor y derechos conexos, así como su difusión</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="Caja">
                                    <a href="./src/vistas/PFD.php" class="card-link">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="src/img/Libro.svg" alt="Producto 3" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <div class="card-content">
                                                            <h5 class="card-title"><b>Derechos informaticos</b></h5>
                                                            <p class="card-text">By <b>Nuricumbo</b></p>
                                                        </div>
                                                        <div class="card-text-hover">
                                                            <p class="card-text">Otra reseña aquí...</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <!-- Sección de redes sociales e información -->
            <section class="row">
                <div style="background-color: #271591;" >
                    <tr height="100px">
                        <td>
                            <p><b>Encuentranos</b></p>
                            <p>#</p>
                        </td>
                    </tr>
                </div>
                <div style="background-color: #a89210;">
                    <tr height="100px"><!--Pie de pagina-->
                        <td>
                            <p>&copy; <b>Derecho informatico</b> Derechos reservados</p>
                            <h6>Creado por: <b>Charly Aquino Vazquez</b></h6>
                        </td>
                    </tr>
                </div>
            </section>
    </div>
    <!-- Agrega la referencia al script de Bootstrap al final del body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./src/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./src/Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
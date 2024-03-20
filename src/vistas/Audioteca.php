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
</head>
<body>
        <section>
            <nav class="navbar navbar-expand-lg navbar-light static-top">
                    <ul class="navbar-nav ml-auto">
                        <li class="navbar-brand"><p><b>RP </b>6</p></li>
                        <li class="nav-item"><a class="nav-link active" href="../../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Acerca de</a></li>
                        <li class="nav-item"><a class="nav-link" href="añadirP.php">Añadir Contenido</a></li>
                        <li class="nav-item"><a class="nav-link disable" href="buscar.php" tabindex="-1" aria-disabled="true">Contratos</a></li>
                        <!-- Nuevo elemento para el formulario de búsqueda -->
                        <li class="nav-item ml-auto">
                        <form class="navbar-form ml-auto" action="../Core/GContrato.php" method="GET">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./src/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./src/Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
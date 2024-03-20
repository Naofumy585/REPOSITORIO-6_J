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
            <form id="uploadForm"  action="../Core/GContrato.php" method="POST" enctype="multipart/form-data">
            <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title">Subir Audio</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <div class="drop-area" id="dropArea">
                                    <p>Arrastra y suelta archivos aquí o haz clic para seleccionar archivos</p>
                                    <input type="file" id="fileInput" name="DireccionM" class="form-control-file"  style="display: none;" accept=".mp3, .wav">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="genero">Género:</label>
                                <select id="genero" name="genero" class="form-control">
                                    <option value="rock">Rock</option>
                                    <option value="pop">Pop</option>
                                    <option value="electronica">Electrónica</option>
                                    <!-- Agregar más opciones según sea necesario -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="autor">Autor:</label>
                                <input type="text" id="autor" name="autor" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" id="FechaC" name="FechaC" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="PalabraClave">Palabra Clave:</label>
                                <input type="text" id="palabra_clave" name="PalabraClave" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="url">URL:</label>
                                <input type="url" id="url" name="url" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro de que deseas subir el audio?')">Subir Audio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- Bootstrap JS (opcional, solo si se requiere funcionalidad de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropArea.classList.add('highlight');
        }

        function unhighlight(e) {
            dropArea.classList.remove('highlight');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            fileInput.files = files;
        }

        fileInput.addEventListener('change', handleFiles, false);

        function handleFiles() {
            const fileList = this.files;
            // Puedes hacer algo con los archivos seleccionados, como mostrar sus nombres en la página
            // Por ejemplo:
            // fileList.forEach(file => console.log(file.name));
        }
    </script>
    <script>
    document.getElementById("uploadForm").addEventListener("submit", function(event) {
        if (!confirm("¿Estás seguro de que deseas subir el audio?")) {
            event.preventDefault(); // Evita que el formulario se envíe
        }
    });
</script>

</body>
</html>
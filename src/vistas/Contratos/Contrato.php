<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>SERVICIO INFORMATICO</title>
    <link rel="icon" href="../../controlador/ControlUtilerias/img/Unach.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Lato|Liu+Jian+Mao+Cao&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../../Bootstrap/css/style_fpago.css">
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
<section>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ml-auto nav justify-content-end">
                            <li class="nav-item"><a class="nav-link active" href="../../../index.php">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="../P_Enlace/Productos.php">Productos</a></li>
                            <li class="nav-item"><a class="nav-link" href="../P_Enlace/Nosotros.php">Nosotros</a></li>
                            <li class="nav-item"><a class="nav-link disable" href="#" tabindex="-1" aria-disabled="true">Contacto</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            </section>
            <form action="../../Core/GContrato.php" method="post" class="form">
                <div class="row">
                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" class="form-control" placeholder=" " name="lugar">
                            <label for="form2Example17" class="form__label">Lugar</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form__div">
                            <input type="date" class="form-control" name="fecha">
                            <label for="form2Example17" class="form__label">Fecha</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" class="form-control" placeholder=" " name="nombre_propietario">
                            <label for="form2Example17" class="form__label">Nombre del Propietario</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" class="form-control" placeholder=" " name="nombre_cliente">
                            <label for="form2Example17" class="form__label">Nombre del Cliente</label>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="form__div">
                            <input type="date" class="form-control" name="dia_contrato">
                            <label for="form2Example17"class="form__label">Dia de contrato</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form__div">
                            <input type="Text" class="form-control" name="mes_contrato">
                            <label for="form2Example17"class="form__label">Mes del contrato</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form__div">
                            <input type="Text" class="form-control" name="ano_contrato">
                            <label for="form2Example17"class="form__label">Año de inicio del contrato</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form__div">
                                <input type="number" class="form-control"name="cantidad_pagos" pattern="\d+(\.\d{2})?">
                                <label for="form2Example17" class="form__label">Cantidad de Pagos</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form__div">
                                <input type="number" class="form-control" placeholder="MXN $" name="monto_primer_anticipo" pattern="\d+(\.\d{2})?" title="Formato incorrecto. Ejemplo válido: 123.45">
                                <label for="form2Example17" class="form__label">Monto del Primer Anticipo</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form__div">
                                <input type="number" class="form-control" placeholder="MXN $" name="monto_total_pago" pattern="\d+(\.\d{2})?" title="Formato incorrecto. Ejemplo válido: 123.45">
                                <label for="form2Example17" class="form__label">Monto Total de Pago</label>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" class="form-control" placeholder=" " name="Direccion">
                            <label for="" class="form__label">Direccion</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form__div">
                            <input type="tel" class="form-control" placeholder=" " name="Telefono">
                            <label for="" class="form__label">Numero telefonico</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Generar Contrato</button>
                    </div>
                </div>
            </form>
            <div class="modal" tabindex="-1" role="dialog" id="successModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">¡Éxito!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Datos registrados, generando PDF...</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="../../Bootstrap/js/main.js"></script>
    <script>  // Mostrar modal de éxito al enviar el formulario
    document.querySelector('.form').addEventListener('submit', function() {
        $('#successModal').modal('show');
    });</script>
</body>
</html>
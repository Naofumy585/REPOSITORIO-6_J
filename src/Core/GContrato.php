<?php
require('../controlador/fpdf186/fpdf.php');
require('../conexion.php'); // Incluir el archivo de conexión

class ContratoPDF {
    public function Capturar_datos($lugar, $fecha, $nombre_propietario, $nombre_cliente, $dia_contrato, $mes_contrato, $ano_contrato, $cantidad_pagos, $monto_primer_anticipo, $monto_total_pago, $direccion, $telefono) {
        // Instanciar la clase Conexion
        $conexion = new Conexion();

        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                // Preparar la consulta SQL
                $sql = "INSERT INTO datos_pdf (lugar, fecha, nombre_propietario, nombre_cliente, dia_contrato, mes_contrato, ano_contrato, cantidad_pagos, monto_primer_anticipo, monto_total_pago, Direccion, Telefono) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                // Preparar la consulta SQL con PDO
                $stmt = $conexion->prepare($sql);

                // Ejecutar la consulta SQL
                $stmt->execute([$lugar, $fecha, $nombre_propietario, $nombre_cliente, $dia_contrato, $mes_contrato, $ano_contrato, $cantidad_pagos, $monto_primer_anticipo, $monto_total_pago, $direccion, $telefono]);

                // Mostrar mensaje de éxito
                echo '<script>alert("Datos registrados, generando PDF...");</script>';
            } catch (PDOException $e) {
                // Mostrar mensaje de error si la consulta falla
                echo "Error: " . $e->getMessage();
            }
        }
    }
    public function Generar_Pdf() {
        // Crear una nueva instancia de FPDF
        $pdf = new FPDF();
    
        // Agregar una página al PDF
        $pdf->AddPage();
    
        // Establecer la fuente para el texto
        $pdf->SetFont('Arial','',12);
    
        // Obtener una instancia de la conexión
        $conn = new Conexion();
    
        // Consulta SQL para obtener los datos de la tabla datos_pdf
        $sql = "SELECT * FROM datos_pdf";
        $result = $conn->query($sql);
    
        if ($result->rowCount() > 0) {
            // Obtener la fila de datos
            $row = $result->fetch(PDO::FETCH_ASSOC);
    
            // Rellenar el contrato con los datos obtenidos de la tabla datos_pdf
            $this->Rellenar_Contrato($pdf, $row);
    
            // Construir el nombre del archivo PDF con el nombre del cliente
            $nombreCliente = $row['nombre_cliente'];
            $nombreArchivo = 'Contrato_' . $nombreCliente . '_' . date('YmdHis') . '.pdf';
            $pdfFile = '../vistas/Contratos/' . $nombreArchivo;
    
            // Guardar el PDF en la carpeta de contratos
            $pdf->Output($pdfFile, 'F');
    
            // Insertar la dirección del PDF en la tabla direccion_pdf
            $direccionPdf = basename($pdfFile); // Obtener solo el nombre del archivo y la extensión
            $sqlInsert = "INSERT INTO direccion_pdf (direccion) VALUES (?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->execute([$direccionPdf]);
    
            // Mostrar mensaje de éxito
            echo '<script>alert("PDF generado y guardado correctamente.");</script>';
            header('Location: ../../index.php'); // Redireccionar a la página principal
            exit; // Asegúrate de que no haya más salida después de redirigir
        } else {
            echo "No se encontraron datos en la tabla datos_pdf";
        }
    }    
    // Método para rellenar el contrato con los datos obtenidos
    private function Rellenar_Contrato($pdf, $datos) {
        // Aquí colocamos el contenido del contrato y reemplazamos los marcadores con los datos obtenidos de la tabla datos_pdf
        $contenido = "CONTRATO DE PRESTACIÓN DE SERVICIOS INFORMÁTICOS
        En [Lugar], a los [días] días del mes de [mes] de [año], entre [Nombre Propietario], en su carácter de propietario, con domicilio en [Lugar], en adelante denominado '[Nombre Propietario]', por una parte, y [Nombre de quien solicita el servicio], con domicilio en [Dirección Cliente], en adelante denominado '[Nombre Propietario]', por la otra parte, celebran el presente CONTRATO DE PRESTACIÓN DE SERVICIOS INFORMÁTICOS, de conformidad con las siguientes cláusulas:
        PRIMERA: OBJETO
        El PROPIETARIO [Nombre Propietario] se compromete a prestar al CLIENTE [Nombre de quien solicita el servicio] los servicios de desarrollo y soporte técnico sobre el sistema-software denominado, conforme a los términos y condiciones establecidos en el presente contrato.
        SEGUNDA: PLAZO
        El presente contrato tendrá una duración hasta de [Cantidad de Pagos] pagos, contados a partir de la fecha de inicio de pago, la cual se establece en [Fecha de Inicio de Pago].
        TERCERA: PAGO
        El CLIENTE realizará el pago por los servicios prestados de acuerdo al siguiente esquema:
        Un pago (varios pagos)
        Cantidad de pagos: [Cantidad de Pagos]
        Monto del primer anticipo: $[Monto del Primer Anticipo]
        Monto total de pago: $[Monto Total de Pago]
        CUARTA: OBLIGACIONES DEL PROPIETARIO [Nombre Propietario]
        El PROPIETARIO [Nombre Propietario] se compromete a realizar los servicios informáticos de manera profesional y dentro de los plazos acordados. Además, se compromete a mantener la confidencialidad de la información del CLIENTE.
        QUINTA: OBLIGACIONES DEL CLIENTE [Nombre de quien solicita el servicio]
        El CLIENTE proporcionará al PROPIETARIO acceso a los recursos necesarios para la prestación de los servicios. Asimismo, se compromete a pagar los honorarios acordados en los términos y condiciones establecidos en este contrato.
        SEXTA: RESPONSABILIDAD
        El PROPIETARIO será responsable por cualquier daño directo causado al CLIENTE como resultado de un incumplimiento de sus obligaciones bajo este contrato, hasta el límite de los honorarios pagados por el CLIENTE.
        SÉPTIMA: CONFIDENCIALIDAD
        Ambas partes acuerdan mantener la confidencialidad de la información comercial y técnica a la que tengan acceso en el marco de la prestación de los servicios.
        OCTAVA: LEY APLICABLE Y JURISDICCIÓN
        Este contrato se regirá e interpretará de acuerdo con las leyes de México. Cualquier disputa derivada de este contrato será sometida a la jurisdicción exclusiva de los tribunales competentes de  el Código Civil Federal,  que se regulan en los artículos 1794, 1796, 1803, 1811, 1834 y 1834, del  Código de Comercio que establece su reglamentación en los artículos 89, 89 bis, 93, 97 y 1205..
        DECIMA PRIMERA: Obligaciones del CLIENTE
        El CLIENTE se encuentra obligado a la Instalación, Configuración y mantenimiento de los softwares de Base necesarios, los cuales deben contar con la configuración requerida por La EMPRESA para la implementación del sistema que por el presente se contrata.
        DECIMA SEGUNDA: Limitación de Responsabilidad
        La EMPRESA no será responsable, en ningún caso, por la pérdida de datos ya sea por errores en los dispositivos físicos de backup, políticas de seguridad de acceso no definidas, instalación de softwares, cortes de energía, etc.
        DECIMA TERCERA: Pago
        El CLIENTE abonará por los servicios pactados la suma de [Monto del Primer Anticipo] pesos mexicanos por mes, a abonar los primeros cinco (5) días del mes. Los servicios adicionales se facturarán al concluirse los mismos. Todos los pagos deberán efectuarse mediante transferencia bancaria a la cuenta bancaria proporcionada por la EMPRESA.
        DECIMA CUARTA: Incumplimiento
        La falta de cumplimiento por parte del CLIENTE de cualquiera de las obligaciones asumidas, la falta de pago en término de los servicios a prestarse con motivo del presente contrato, facultará a la EMPRESA a rescindir el contrato, pudiendo reclamar el total de las sumas adeudadas por el CLIENTE con más los daños y perjuicios que pudieran haberse ocasionado.
        DECIMA QUINTA: Domicilios Especiales y Jurisdicción
        Las PARTES constituyen sus domicilios especiales en los lugares indicados en este contrato, donde se considerarán válidas todas las notificaciones relacionadas con el presente acuerdo. Asimismo, ambas partes se someten a la jurisdicción de los Tribunales competentes en [Lugar], renunciando a cualquier otro fuero o jurisdicción que pudiera corresponderles.
        ANEXO I: DESARROLLO DEL SISTEMA Y FOLLETERÍA
        A.- Descripción técnica del servicio:
        Carga de datos: Se cargará la información referente al producto, detalle del producto, precio e imágenes que el cliente envíe a la empresa especificando que esos son los datos a cargar.
        Descripción del menú digital: Menú digitalizado en el cual se podrá interactuar y hacer modificaciones desde la comandera que la empresa le otorga al cliente.
        B.- El MENÚ DIGITAL será accesible a través de la lectura mediante la cámara de un teléfono celular de un Código QR (en adelante el CODIGO). La EMPRESA se compromete a entregar cantidad suficiente de folletería que incluya el CODIGO, entendiendo por cantidad suficiente un mínimo de un (1) folleto por mesa pasible de ocupación por un comensal en el local del CLIENTE.
        A los fines de la impresión del folleto, el CLIENTE autoriza de forma irrestricta a la EMPRESA a utilizar su nombre, logo y signos distintivos a forma de plasmarlos en el folleto.
        La EMPRESA se compromete a entregar los folletos con el CÓDIGO al CLIENTE, bajo la figura del COMODATO, por lo cual, no renuncia a su propiedad y los mismos deberán ser devueltos a la EMPRESA, al momento de finalización del presente CONTRATO.
        Este Anexo forma parte integrante del Contrato de Prestación de Servicios Informáticos celebrado entre EL PROPIETARIO y EL CLIENTE en [Lugar], a los [días] días del mes de [mes] de [año].
        En prueba de conformidad, las partes firman el presente contrato en [Lugar], a los [días] días del mes de [mes] de [año].
        [Nombre Propietario] [Nombre Cliente]
        Firma: _________________________ Firma: _________________________
        Nombre: _________________________ Nombre: _________________________
        DNI/INE: _________________________ DNI/INE: _________________________";

        // Reemplazar los marcadores con los datos obtenidos
        $contenido = str_replace('[Lugar]', $datos['lugar'], $contenido);
        $contenido = str_replace('[días]', $datos['dia_contrato'], $contenido);
        $contenido = str_replace('[mes]', $datos['mes_contrato'], $contenido);
        $contenido = str_replace('[año]', $datos['ano_contrato'], $contenido);
        $contenido = str_replace('[Nombre Propietario]', $datos['nombre_propietario'], $contenido);
        $contenido = str_replace('[Nombre de quien solicita el servicio]', $datos['nombre_cliente'], $contenido);
        $contenido = str_replace('[Dirección Cliente]', $datos['Direccion'], $contenido);
        $contenido = str_replace('[Cantidad de Pagos]', $datos['cantidad_pagos'], $contenido);
        $contenido = str_replace('[Fecha de Inicio de Pago]', $datos['fecha'], $contenido);
        $contenido = str_replace('[Cantidad de Pagos]', $datos['cantidad_pagos'], $contenido);
        $contenido = str_replace('[Monto del Primer Anticipo]', $datos['monto_primer_anticipo'], $contenido);
        $contenido = str_replace('[Monto Total de Pago]', $datos['monto_total_pago'], $contenido);

        // Agregar el contenido al PDF
        $pdf->MultiCell(0, 10, utf8_decode($contenido));
    }
}



// Instanciar la clase ContratoPDF
$contratoPDF = new ContratoPDF();

// Llamar al método Capturar_datos con los datos del formulario
$contratoPDF->Capturar_datos($_POST['lugar'], $_POST['fecha'], $_POST['nombre_propietario'], $_POST['nombre_cliente'], $_POST['dia_contrato'], $_POST['mes_contrato'], $_POST['ano_contrato'], $_POST['cantidad_pagos'], $_POST['monto_primer_anticipo'], $_POST['monto_total_pago'], $_POST['Direccion'], $_POST['Telefono']);

// Llamar al método Generar_Pdf para generar el PDF
$contratoPDF->Generar_Pdf();
?>
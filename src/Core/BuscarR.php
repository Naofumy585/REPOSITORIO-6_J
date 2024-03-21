<?php
require_once 'barra.php';

if(isset($_POST['query'])) {
    $keyword = $_POST['query'];
    $barra = new Barra();
    $resultados = $barra->buscar($keyword);

    if ($resultados) {
        header("Location: ../vistas/buscar.php?query=" . urlencode($keyword) . "&resultados=" . urlencode(serialize($resultados)));
        exit();
    } else {
        echo "No se encontraron resultados para: " . $keyword;
    }
} else {
    echo "No se proporcionó ninguna palabra clave.";
}
?>
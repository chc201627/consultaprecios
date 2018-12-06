<?php
    
    include("config/conexionsql.php");

    $con=conectar();

    if (isset($_POST['codigo'])) {
        $codigo = $_POST['codigo'];
        $procedure_params = array(
                array($codigo, SQLSRV_PARAM_IN)
            );

        $sql = "EXEC sp_price_query @p_cod_barras = ?";
        
        $stmt = sqlsrv_prepare($con, $sql, $procedure_params);
        if (!sqlsrv_execute($stmt)) {
            echo "Your code is fail!";
            die;
        }


        while ($fila = sqlsrv_fetch_array($stmt)) {
            echo '<h1>'."Precios: ".utf8_encode($fila['f_simbolo'])."".number_format($fila['f_precio_vta'],0,",",".").'</h1>';
            echo "<br>";
            echo '<h1>'.utf8_encode($fila['f_item_resumen']).'</h1>';
            echo "<br>";
        }

        header('refresh:5; url=http://localhost/carousel/index.php');
    }
?>

<html>
<head>
</head>
<body>

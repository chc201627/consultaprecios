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
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "<div class='container'>";
            echo "<div class='row'> ";
            echo "<div class='col-xs-7 col-xs-offset-5'>";
            echo '<h1>'.utf8_encode($fila['f_simbolo'])."".number_format($fila['f_precio_vta'],0,",",".").'</h1>';
            echo "<br>";
            echo "<br>";
            echo "<br>";
            echo "</div>";
            echo "</div>";
            echo "<div class='row'> ";
            echo "<div class='col-xs-9 col-xs-offset-2'>";
            $cadena = utf8_encode($fila['f_item_resumen']);
            echo '<h1>'.preg_replace('/[0-9]{7}/', '', $cadena).'</h1>';
            echo "<br>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }

        header('refresh:5; url=http://localhost/carousel/index.php');
    }
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

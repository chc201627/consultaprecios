<?php
function conectar() {
    $serverName = "169.45.245.82,20446";
    $connectionInfo = array( "Database"=>"SUnoEE_InverAlicante_Real", "UID"=>"admindata", "PWD"=>"S13s42015");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn ) {
        // echo "Conexión establecida.<br />";
    }else{
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }

    return $conn;
}


?>


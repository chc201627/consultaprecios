<?php
$DB_HOST="127.0.0.1";//Servidor donde se encuentra alojada nuestra base de datos
$DB_NAME= "carousel";// Nombre de la base de datos
$DB_USER= "root";//Usuario de la base de datos
$DB_PASS= "";//Contraseña del usuario de la base de datos
# conectare la base de datos
$con=mysqli_connect('127.0.0.1', 'root','' , 'carousel');
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}
if(!$con){
    die("imposible conectarse: ".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
?>

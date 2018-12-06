<?php
$title="Carousel Bootstrap 3 con PHP y MySQL";
/* Llamar la Cadena de Conexion*/ 
include ("config/conexion.php");
include 'config/conexionsql.php';

$consql=conectar();

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    var_dump($codigo);
    $procedure_params = array(
        array($codigo, SQLSRV_PARAM_IN)
    );

    $sql = "EXEC sp_price_query @p_cod_barras = ?";

    $stmt = sqlsrv_prepare($consql, $sql, $procedure_params);
    if (!sqlsrv_execute($stmt)) {
        echo "Your code is fail!";
        die;
    }


    while ($fila = sqlsrv_fetch_array($stmt)) {
        echo "Precios: ".utf8_encode($fila['f_simbolo'])."".number_format($fila['f_precio_vta'],0,",",".");
        echo "<br>";
        echo "Descrip Items: ".utf8_encode($fila['f_item_resumen']);
        echo "<br>";
    }

    header('refresh:15; url=http://localhost/carousel/consultarInicial.php');
}
$active="active";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title;?></title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  </head>
  <body>


        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">
			<div id="carousel-example-captions" class="carousel slide" data-ride="carousel"> 
				<?php
					$sql_slider=mysqli_query($con,"select * from slider where estado=1 order by orden");
					$nums_slides=mysqli_num_rows($sql_slider);
				?>
					<ol class="carousel-indicators">
						<?php
						for ($i=0; $i<$nums_slides; $i++){
							$active="active";
							?>
							<li data-target="#carousel-example-captions" data-slide-to="<?php echo $i;?>" class="<?php echo $active;?>"></li>
							<?php
							$active="";
						}
						?>
						
					</ol> 
				<div class="carousel-inner" role="listbox"> 
				<?php
					$active="active";
					while ($rw_slider=mysqli_fetch_array($sql_slider)){
				?>
						<div class="item <?php echo $active;?>">
							<img data-src="holder.js/900x500/auto/#777:#777" alt="900x500" src="img/slider/<?php echo $rw_slider['url_image'];?>" data-holder-rendered="true">
							<div class="carousel-caption"> 
								<h3><?php echo $rw_slider['titulo'];?></h3>
								<p><?php echo $rw_slider['descripcion'];?></p>
								<a class='btn btn-<?php echo $rw_slider['estilo_boton'];?> text-right' href="<?php echo $rw_slider['url_boton'];?>"><?php echo $rw_slider['texto_boton'];?></a>
							</div> 
						</div>
						<?php
						$active="";
					}
				?>
					
					 
					
				</div> 
			</div>
        </div>

          



  <div class="col-xs-9">
      <form action="consultarInicial.php" method="post">
          <input type="text" class="form-control" name="codigo">
          <input type="submit" name="consultar" id="" class="form-control btn btn-primary">
      </form>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>


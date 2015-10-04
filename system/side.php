<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Anuncios</h3>
		</div>
</div>
<div id="contenedor">
    <div id="myCarousel" class="carousel slide">
      <!-- Carousel items -->
	  <div class="carousel-inner vertical">
	  <div class="active item"><img src="../../img/noticias.jpg" ></div>
	<?php
		$sqlRol = $db->executeQuerySQL("SELECT * FROM anuncio WHERE dtt_anunfechainicio <= current_date AND dtt_anunfechafin >=  current_date AND vch_anunestado='A';");

		while($row=$db->query_Fetch_Array($sqlRol))
		{
	?>
        <div class="item">
			<div class="panel panel-primary">
				<div class="panel-heading">
				<h3 class="panel-title">Fecha de Publicacion: <?php echo $row[dtt_anunfechainicio]; ?></td></h3>
				</div>
				<div class="panel-body">
				<tr><a href="../../modulo/inicio/mostrarAnuncio.php?id=<?php echo $row[pk_anuncio]; ?>"><?php echo $row[vch_anuntitulo]; ?></a><tr>
				</div>
			</div>
		</div>
	<?php
		$cont=$cont+1;
		}
	?>
		</div>
	  
	  <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	<?php 
	for ($i = 1; $i <= $cont; $i++) {
	?>
        <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>"></li>
	<?php
	}
	?>
      </ol>
	  
      <!-- Carousel nav -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
</div>
 
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
        $('.myCarousel').carousel({
            interval: 3000
        });
    });
</script>

<?php
	session_start();
	if(isset($_SESSION['name']))
	{}else{
		header("Location: ../../index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.- GESTEC OTB -.</title>

    <!-- Bootstrap -->
    <link rel="icon" href="../../gotb2.png">

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">

 	<link rel="stylesheet" href="../../js/DataTables/media/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../../js/DataTables/media/css/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="../../css/style.css">

    <script src="../../js/jquery.js" type="text/javascript"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

    <script src="../../js/DataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/DataTables/media/js/dataTables.responsive.min.js" type="text/javascript"></script>


    <script type="text/javascript">
		$(document).ready(function() {

			$("#menu a").each(function() {
				var href = $(this).attr("href");
				$(this).attr({href : "#"});
				$(this).click(function() {
					$("#central").load(href);
				});
			});

			$("#btnView").click(function(){
				$("#central").load("viewrol.php");
			});

			$('#gridx').DataTable();

		});
    </script>

</head>
<body>

<header id="header">
	<?php
    	include_once("../../system/header.php");
	?>
</header>


<nav class="navbar navbar-inverse">
    <?php
        include_once("../../system/menu.php");
    ?>
</nav><!--/nav-->


<div class="container-fluid contenedor">
	<div class="row">
    	<?php include_once("../../system/section.php"); ?>
      	<?php include_once("../../system/side.php"); ?>
	</div>
</div>


<footer id="footer" class="panel-footer">
    <?php include_once("../../system/footer.php"); ?>
</footer><!--/#footer-->

</body>
</html>

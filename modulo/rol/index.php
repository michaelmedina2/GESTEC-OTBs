<?php
	include("../../class/dbmanager.class.php");
	$db = ManagerBDPostgres::getInstanceBDPostgres();			
?><head>
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
			
			$("a").each(function() {
				var href = $(this).attr("href");
				$(this).attr({href : "#"});
				$(this).click(function() {
					$("#contenidoCRUD").load(href);
				});
			});

			$("#btnNew").click(function(){
				$("#contenidoCRUD").load("rol/newrol.php");
			});
			
			$('#gridx').DataTable();
			
		});
    </script>

</head>

<a href="#" class="btn btn-primary" id="btnNew">New</a>
<center>

<div id="contenidoCRUD"></div>
<caption> <h1>Gestion Roles</h1></caption>
<table id="gridx" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">	       
    <thead>
        <tr>
            <th>Nombre Rol</th>
            <th>Estado</th>
            <th>Control</th>
        </tr>
    </thead>
    <tbody> 
    	<?php
        	$sqlRol = $db->executeQuerySQL("select * from rol");
			
			while($row=$db->query_Fetch_Array($sqlRol))
			{
		?>      	
        <tr>
        	<td><?php echo $row[vch_rolnombre]; ?></td>
			<td><center><?php echo $row[vch_rolestado]; ?></center></td>
			<td>
            	<center>
            	<div class="btn-group btn-group-xs">
                  <a href="rol/viewrol.php?id=<?php echo $row[pk_rol]; ?>" class="btn btn-success btnView">Vista</a>
                  <a href="rol/updaterol.php?id=<?php echo $row[pk_rol]; ?>" class="btn btn-warning" id="btnUpdate">Actualizar</a>
                </div>
                </center>
            </td>
        </tr>                 
        <?php
			}
		?>
    </tbody>
</table>
</center>
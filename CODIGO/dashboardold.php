<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>App de ahorro social</title>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body>
<div id="metaListPage" data-role="page">

	<div data-role="header" data-position="fixed">
		<h1>Dashboard de Ahorro Social</h1>
	</div>

	<div data-role="content">
         <ul id="metaList" data-role="listview" data-filter="true" data-split-icon="star">
         <?php
	$conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("admobilefb")
         or die ("No se puede seleccionar la base de datos");

      $fecha = date ("Y-m-d"); // Fecha actual
      $instruccion = "select * from metas";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);
       while ($row=mysql_fetch_assoc($consulta))
       {
 ?>
         
             <li><a href="metadetails.php?idmeta=<?php echo $row[id]; ?>">
                  <img alt="hola" src="<?php echo $row[imagen]; ?>"/>
                      <h4><?php echo $row[titulo]; ?></h4>
                      <p><?php echo $row[descripcion]; ?></p>
                      <span class="ui-li-count"><h3><?php echo $row[coste]."€"; ?></h3></span></a>
                 <a href="editmeta.php?idgame=1">Edit</a>
             </li>
 <?php
       }
       ?>
         </ul>
        </div>		
        <div id="loading" style="display: none"><img alt="loading..." src="./pics/progressbar3.gif" /></div>
        <div data-role="footer" data-id="toolbar" data-position="fixed">	
                        <div data-role="navbar">
                                <ul>
                                        <li>
                                                <a href="crear_proyecto.html" data-icon="star" data-transition="fade">
                                                Crear nuevo proyecto</a>
                                        </li>	
                                        <li><a class="ui-btn-active" href="modificar_proyecto.html" data-icon="check" data-transition="fade">
                                                Modificar un proyecto</a>
                                        </li>	
                                </ul>
                        </div>
        </div><!-- /footer -->	    
    <div id="result"></div>
</div>

</body>

</html>
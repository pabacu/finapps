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
        <ul id="metaList" data-role="listview" data-filter="true" data-divider-theme="d">
         <?php
	$conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("admobilefb")
         or die ("No se puede seleccionar la base de datos");

      if(isset ($_GET['idmeta']))
      {
      $fecha = date ("Y-m-d"); // Fecha actual
      $instruccion = "select * from transferencias where id_meta=".$_GET['idmeta'];
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);
       while ($row=mysql_fetch_assoc($consulta))
       {
 ?>

             <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-d" data-theme="d" data-iconpos="right" data-icon="arrow-r" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperEls="div">
                 <div class="ui-btn-inner ui-li">
                     <div class="ui-btn-text">

                             <div class="ui-li-aside ui-li-desc"><h2><?php echo $row['cantidad'] ?>&euro;</h2>
                     </div>
                 </div>
                     </div>
                <h3 class="ui-li-heading"><?php echo $row['concepto'] ?></h3>
             </li>

 <?php
       }
      }
       ?>
         </ul>
        </div>		
        <div id="loading" style="display: none"><img alt="loading..." src="./pics/progressbar3.gif" /></div>
        <div data-role="footer" data-id="toolbar" data-position="fixed">	
                        <div data-role="navbar">
                                <ul>
                                        <li>
<?php

?>                              
                                                <a href="crear_proyecto.html" data-icon="star" data-transition="fade">
                                                Crear nuevo proyecto</a>
                                        </li>	
                                        <li><?php echo $instruccion2 ?><a class="ui-btn-active" href="modificar_proyecto.html" data-icon="check" data-transition="fade">
                                                Modificar un proyecto</a>
                                        </li>	
                                </ul>
                        </div>
        </div><!-- /footer -->	    
    <div id="result"></div>
</div>

</body>

</html>
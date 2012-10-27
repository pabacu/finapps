<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
        <?php
        $conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
                or die ("No se puede conectar con el servidor");
        mysql_select_db ("admobilefb")
                or die ("No se puede seleccionar la base de datos");

        if(isset ($_GET['idmeta'])) {
            $fecha = date ("Y-m-d"); // Fecha actual
            $instruccion = "select * from metas where id=".$_GET['idmeta'];
            $consulta = mysql_query ($instruccion, $conexion)
                    or die ("Fallo en la consulta");
            mysql_close ($conexion);
            $row=mysql_fetch_assoc($consulta);
            ?>
        <title>App de ahorro social - <?php echo $row[titulo]; ?></title>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
    </head>
    <body>
        <div id="metaListPage" data-role="page">

            <div data-role="header" data-position="fixed">
                <h1><?php echo $row[titulo]; ?></h1>
    <?php $costetotal = $row[coste]; ?>
                    <?php
		
                    ?>
            </div>

            <div data-role="content">
                <ul id="metaList" data-role="listview" data-filter="true" data-divider-theme="d">
    <?php
                        $conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
                                or die ("No se puede conectar con el servidor");
                        mysql_select_db ("admobilefb")
                                or die ("No se puede seleccionar la base de datos");

                        if(isset ($_GET['idmeta'])) {
                            $fecha = date ("Y-m-d"); // Fecha actual
                            $instruccion = "select * from transferencias where id_meta=".$_GET['idmeta'];
                            $consulta = mysql_query ($instruccion, $conexion)
                                    or die ("Fallo en la consulta");
                            mysql_close ($conexion);
                            $total = 0;
                            while ($row=mysql_fetch_assoc($consulta)) {
                                $total +=$row['cantidad'];

                                ?>

                    <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-d" data-theme="d" data-iconpos="right" data-icon="arrow-r" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperEls="div">
                        <div class="ui-btn-inner ui-li">
                            <div class="ui-btn-text">
                                <div class="ui-li-aside ui-li-desc"><h2><?php echo $row['cantidad'] ?>&euro;</h2>
                                </div>
                            </div>
                        </div>
                        <h3><?php echo $row['concepto'] ?></h3>
                        <h4><?php echo $row['fecha'] ?><a href="http://www.facebook.com/dialog/feed?app_id=435104126547108&redirect_uri=http%3A%2F%2Fadmobile.es%2Ffinapps%2Fmetadetails.php?idmeta=1&message=3,5TAE%20Interes&picture=http://admobile.es/finapps/logonostr.jpg&name=Ahorro%20Social%20con%20La%20Caixa%203,5%&link=http%3A%2F%2Fadmobile.es%2Ffinapps%2F&description=Ven%20y%20convierte%20tus%20sue%C3%B1os%20en%20realidad.%20Ahora,%20por%20primera%20vez%20en%20la%20historia,%20ya%20puedes%20ahorrar%20dinero%20con%20tus%20amigos%20a%20trav%C3%A9s%20de%20las%20redes%20sociales%20Facebook,%20Twitter,%20Linkedin.%20Ahorrar%20en%20grupo%20para%20el%20viaje%20de%20fin%20de%20carrera%20a%20Riviera%20Maya,%20para%20una%20boda%20al%203,5%"><img width="40" height="40" src="http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/facebook_1.png"></a><a href="
https://twitter.com/intent/tweet?original_referer=http://admobile.es/finapps/&source=tweetbutton&text=La mejor plataforma de ahorro social&url=http://admobile.es/finapps/metadetails.php?idmeta=1&via=ahorrosocial"><img width="40" height="40" src="http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/twitter_1.png"></a><a href="#"><img width="40" height="40" src="http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/linkedin_1.png"></a></h4>
                    </li>

            <?php
        }
    }
                        ?>
                </ul>
            </div>
    <?php
}
?>
            <div id="loading" style="display: none"><img alt="loading..." src="./pics/progressbar3.gif" /></div>
            <div data-role="footer" data-id="toolbar" data-position="fixed">
                <div data-role="navbar">
                    <ul>
                        <li>
                            <h4>
                             Tu meta es de:
                            </h4>
                             <h3>
                            <?php echo number_format($costetotal, 2)  ?>€</h3>
                            
                        </li>
                        <li><h4>Has conseguido:</h4>
                            <h3>
                            <?php echo number_format($total,2) ?>€ (<?php echo number_format($total*100/$costetotal,0); ?>%)
                            </h3>
                        </li>
                    </ul>
                </div>
            </div><!-- /footer -->
            <div id="result"></div>
        </div>

    </body>

</html>
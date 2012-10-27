<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>App de ahorro social</title>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
<link rel="stylesheet" href="style.css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head>

<body>

<?PHP
   //////////////////////////////////////////////////////////////////////////
   // si el formulario ha sido enviado
   //    validar formulario
   // fsi
   // si el formulario ha sido enviado y los datos son correctos
   //    procesar formulario
   // si no
   //    mostrar formulario
   // fsi
   //////////////////////////////////////////////////////////////////////////

// Obtener valores introducidos en el formulario
   $insertar = $_REQUEST['Submit'];
   $descripcion = $_REQUEST['descripcion'];
   $titulo = $_REQUEST['titulo'];
   $imagen = $_REQUEST['imagen'];
   $fecha = $_REQUEST['fecha'];
   $cantidad = $_REQUEST['cantidad'];

   $error = false;
   if (isset($insertar))
   {

   // Comprobar que se han introducido todos los datos obligatorios
   // Título
      if (trim($titulo) == "")
      {
         $errores["titulo"] = "¡Debe introducir un título!";
         $error = true;
      }
      else
         $errores["titulo"] = "";

   // Texto
      if (trim($cantidad) == "")
      {
         $errores["texto"] = "¡Debe introducir una cantidad!";
         $error = true;
      }
      else
         $errores["texto"] = "";

   // Subir fichero
      $copiarFichero = false;

   // Copiar fichero en directorio de ficheros subidos
   // Se renombra para evitar que sobreescriba un fichero existente
   // Para garantizar la unicidad del nombre se añade una marca de tiempo
      if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
      {
         $nombreDirectorio = "img/";
         $nombreFichero = $_FILES['imagen']['name'];
         $copiarFichero = true;

      // Si ya existe un fichero con el mismo nombre, renombrarlo
         $nombreCompleto = $nombreDirectorio . $nombreFichero;
         if (is_file($nombreCompleto))
         {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
         }
      }
   // El fichero introducido supera el límite de tamaño permitido
      else if ($_FILES['imagen']['error'] == UPLOAD_ERR_FORM_SIZE)
      {
      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
         $errores["imagen"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
         $error = true;
      }
   // No se ha introducido ningún fichero
      else if ($_FILES['imagen']['name'] == "")
         $nombreFichero = '';
   // El fichero introducido no se ha podido subir
      else
      {
         $errores["imagen"] = "¡No se ha podido subir el fichero!";
         $error = true;
      }
   }

// Si los datos son correctos, procesar formulario
   if (isset($insertar) && $error==false)
   {
	   
   // Insertar la noticia en la Base de Datos
      $conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("admobilefb")
         or die ("No se puede seleccionar la base de datos");

      $instruccion = "insert into metas (id, id_user, titulo, descripcion, fecha, coste, imagen) values ('', '', '$titulo', '$descripcion', '$fecha', '$cantidad', '$imagen')";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombreDirectorio . $nombreFichero);

   // Mostrar datos introducidos
      print ("<H1>Ya ha sido creado su nuevo proyecto</H1>\n");
      print ("<H2>Puede compartir su proyecto en las redes sociales<a href='http://www.facebook.com/dialog/feed?app_id=435104126547108&redirect_uri=http%3A%2F%2Fadmobile.es%2Ffinapps%2Fmetadetails.php?idmeta=1&message=3,5TAE%20Interes&picture=http://admobile.es/finapps/logonostr.jpg&name=Ahorro%20Social%20con%20La%20Caixa%203,5%&link=http%3A%2F%2Fadmobile.es%2Ffinapps%2F&description=Ven%20y%20convierte%20tus%20sue%C3%B1os%20en%20realidad.%20Ahora,%20por%20primera%20vez%20en%20la%20historia,%20ya%20puedes%20ahorrar%20dinero%20con%20tus%20amigos%20a%20trav%C3%A9s%20de%20las%20redes%20sociales%20Facebook,%20Twitter,%20Linkedin.%20Ahorrar%20en%20grupo%20para%20el%20viaje%20de%20fin%20de%20carrera%20a%20Riviera%20Maya,%20para%20una%20boda%20al%203,5%'><img width='40' height='40' src='http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/facebook_1.png'></a><a href='
https://twitter.com/intent/tweet?original_referer=http://admobile.es/finapps/&source=tweetbutton&text=La mejor plataforma de ahorro social&url=http://admobile.es/finapps/metadetails.php?idmeta=1&via=ahorrosocial'><img width='40' height='40' src='http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/twitter_1.png'></a><a href='#'><img width='40' height='40' src='http://www.mindandfingers.com/CONTENIDO/OTHERS/wordpress/wp-content/themes/elcep/CONTENIDO/HOME/linkedin_1.png'></a></H2>\n");
      print ("<BR>");
      print ("<a href='dashboard.php' target='_top' data-role='button'>Acceder al Dashboard</a>");

   }
   else
   {
?>
<h1>Crear nuevo proyecto</h1>
<form action="crear_proyecto.php" method="post" ENCTYPE="multipart/form-data">  
    <label for="titulo">Titulo:</label>
	<input type="text" name="titulo" id="titulo" value="" placeholder="Titulo"/>
    <label for="descripcion">Descripción:</label>
	<input type="text" name="descripcion" id="descripcion" value="" placeholder="Descripción"/>
        <label for="fecha">Fecha:</label>
	<input type="date" name="fecha" id="fecha" value="" placeholder="00/00/00"/>
    <label for="cantidad">Cantidad</label>
	<input type="number" name="cantidad" id="cantidad" value="" placeholder="Cantidad"/>
   
<label>URL de Imagen:</label>
	<INPUT TYPE="text" SIZE="44" NAME="imagen">     
     <input type='submit' name='Submit' value='Enviar', data-theme="b" />

</form>

<?PHP
   }
?>
</body>
</html>

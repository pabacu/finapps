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
   $email = $_REQUEST['email'];
   $password = $_REQUEST['password'];
   $nombre = $_REQUEST['nombre'];
   $papellido = $_REQUEST['papellido'];
   $sapellido = $_REQUEST['sapellido'];
   $nacimiento = $_REQUEST['bday'];

   $error = false;
   if (isset($insertar))
   {

   // Comprobar que se han introducido todos los datos obligatorios
   // Título
      if (trim($password) == "")
      {
         $errores["titulo"] = "¡Debe introducir un password!";
         $error = true;
      }
      else
         $errores["titulo"] = "";

   // Texto
      if (trim($email) == "")
      {
         $errores["texto"] = "¡Debe introducir el email!";
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

      $instruccion = "insert into users (id, email, password, imagen, nombre, papellido, sapellido, nacimiento, gender, idfb) values ('', '$email', '$password', '$nombreFichero', '$nombre', '$papellido', '$sapellido', '$nacimiento', '$gender', '$id')";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);

   // Mover fichero de imagen a su ubicación definitiva
      if ($copiarFichero)
         move_uploaded_file ($_FILES['imagen']['tmp_name'],
         $nombreDirectorio . $nombreFichero);

   // Mostrar datos introducidos
      print ("<H1>Ha sido registrado</H1>\n");
      print ("<H2>En breves momentos recibirá un correo electrónico verificando el registro</H2>\n");
      print ("<BR>");
      print ("<a href='dashboard.php' target='_top' data-role='button'>Acceder al Dashboard</a>");

   }
   else
   {
?>
<h1>Bienvenido a la 1ª App de ahorro social mundial</h1>
<form action="form.php" method="post" ENCTYPE="multipart/form-data">  
    <label for="nombre">Nombre:</label>
	<input type="text" name="nombre" id="nombre" value="" placeholder="Nombre"/>
    <label for="papellido">Primer apellido:</label>
	<input type="text" name="papellido" id="papellido" value="" placeholder="Primer apellido"/>
        <label for="sapellido">Segundo apellido:</label>
	<input type="text" name="sapellido" id="sapellido" value="" placeholder="Segundo apellido"/>
    <label for="email">Email:</label>
	<input type="email" name="email" id="email" value="" placeholder="Email"/>
    <?PHP
   if (isset($insertar))
      print ("$email");
   if ($errores["texto"] != "")
      print ("<a style='color: #F00;'>" . $errores["texto"] . "</a>");
?></P>
    <label for="password">Password:</label>
	<input type="password" name="password" id="password" value="" placeholder="Password"/>
    <label for="password">Repetir password:</label>
	<input type="password" name="password" id="password" value="" placeholder="Repetir password"/>
         <?PHP
   if (isset($insertar))
      print ("$password");
   if ($errores["titulo"] != "")
      print ("<a style='color: #F00;'>" . $errores["titulo"] . "</a>");
?>
</P>
        <label for="bday">Fecha de nacimiento:</label>
     <input type="date" name="bday" placeholder="00/00/0000" />
<label>Imagen:</label>
<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="102400">
	<INPUT TYPE="FILE" SIZE="44" NAME="imagen">
         <label for="codigo">Código promocional:</label>
	<input type="text" name="codigo" id="codigo" value="" placeholder="Código promocional"/>
     
     <input type='submit' name='Submit' value='Enviar', data-theme="b" />

</form>

<?PHP
   }
?>
</body>
</html>

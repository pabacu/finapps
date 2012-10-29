<?php
define('FACEBOOK_APP_ID', '435104126547108');
define('FACEBOOK_SECRET', '15bf7ca284d2fe744cc61080c747e4ef');

function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}
?>
<?php
$name = $response[registration][name];
$email = $response[registration][email];
$gender = $response[registration][gender];
$nacimiento = $response[registration][birthday];
$password = $response[registration][password];
$id = $response[user_id];
// Example 1
$pieces = explode(" ", $name);
echo $pieces[0]; // piece1
echo $pieces[1]; // piece2
echo $pieces[2]; // piece3
?>
<?php
$conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
         or die ("No se puede conectar con el servidor");
      mysql_select_db ("admobilefb")
         or die ("No se puede seleccionar la base de datos");

      $instruccion = "insert into users (id, email, password, imagen, nombre, papellido, sapellido, nacimiento, gender, idfb) values ('', '$email', '$password', '$nombreFichero', '$pieces[0]', '$pieces[1]', '$pieces[2]', '$nacimiento', '$gender', '$id')";
      $consulta = mysql_query ($instruccion, $conexion)
         or die ("Fallo en la consulta");
      mysql_close ($conexion);
?>
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
<H1>Ha sido registrado</H1>
<H2>En breves momentos recibirá un correo electrónico verificando el registro</H2>
<BR>
<a href="dashboard.php" target="_top" data-role="button">Acceder al Dashboard</a>
</body>

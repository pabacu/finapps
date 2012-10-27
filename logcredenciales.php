<?php
session_start();
ob_clean();
ob_end_clean();
if($_POST) {
    //$id_user = 1;
    //header('Location: dashboard.php?id_name='.$id_user);

            $credenciales = $_POST['user'].":".$_POST['password'];
            $service_url = 'http://finappsapi.bdigital.org/api/2012/9b32e3b83e/access/login';
            $headers = array('Accept: application/json','Content-Type: application/json');
            $curl = curl_init($service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERPWD, $credenciales );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $curl_response = curl_exec($curl);
            curl_close($curl);
            //echo $curl_response;
            $resultado = json_decode($curl_response);


            //echo "result:".$resultado->{'status'};

            if($resultado->{'status'}=="OK")
            {
                $_SESSION['token']=$resultado->{'token'};

                $conexion = mysql_connect ("mysql5-7.start", "admobilefb", "finapps4")
                        or die ("No se puede conectar con el servidor");
                mysql_select_db ("admobilefb")
                        or die ("No se puede seleccionar la base de datos");

                $instruccion = sprintf("select id, alias from users where alias = '%s'",$_POST['user']);
                //echo $instruccion;

                $consulta = mysql_query ($instruccion, $conexion)
                        or die ("Fallo en la consulta");
                mysql_close ($conexion);
                $row=mysql_fetch_assoc($consulta);
                $id_user = $row['id'];
                if($id_user!="")
                {
                    $_SESSION['id'] = $id_user;
                    //echo "iduser:".$id_user;
                //Si es token correcto
                    header('Location: dashboard.php?id_name='.$id_user);
                 //header('Location: http://www.admobile.es/finapps/dashboard.php?id_name='.$id_user);
                }
            }else
                    header('Location: login.php?error="Usuario o contraseña incorrectas."');

        }else{

            if(isset($_SESSION['id']))
                header('Location: dashboard.php?id_name='.$_SESSION['id']);
            else
                header('Location: login.php?error="Usuario o contraseña incorrectas."');
        }
?>
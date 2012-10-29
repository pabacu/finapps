<?php
session_start();
$cuentas = array();

 $service_url ='http://finappsapi.bdigital.org/api/2012/9b32e3b83e/'.$_SESSION['token'].'/operations/account/list';
 $headers = array('Accept: application/json','Content-Type: application/json');
       $curl = curl_init($service_url);
       //$curl_post_data = '{"accountNumber": "2100 1111 53 0000000177","value": 1000,"additionalData": {"concept": "ingres","payee": "algu"}}';
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	   //curl_setopt($curl, CURLOPT_USERPWD, "mviladomat:123456");
	   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
       //curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
       $curl_response = curl_exec($curl);
       curl_close($curl);
       $resultado = json_decode($curl_response);

       if($resultado->{'status'}=="OK")
       {
           $datos= $resultado->{'data'};
           $i=0;

           foreach ($datos as $item)
           {
               $service_url ='http://finappsapi.bdigital.org/api/2012/9b32e3b83e/'.$_SESSION['token'].'/operations/account/'.$item;
               $headers = array('Accept: application/json','Content-Type: application/json');
               $curl = curl_init($service_url);
               //$curl_post_data = '{"accountNumber": "2100 1111 53 0000000177","value": 1000,"additionalData": {"concept": "ingres","payee": "algu"}}';
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                   //curl_setopt($curl, CURLOPT_USERPWD, "mviladomat:123456");
                   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
               //curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
               $curl_response = curl_exec($curl);
               curl_close($curl);
               $resultado = json_decode($curl_response);
              if($resultado->{'status'}=="OK")
              {
                 $cuentas[$i] = $resultado->{'data'};
              }
           }
            echo("<pre>");
            print_r($cuentas);
            echo("</pre>");

            echo $curl_response."<br>";

            ob_start();
            include_once('micuenta.php');
            $html=ob_get_contents();
            ob_end_clean();

           
            echo $html;
       }else
           echo "Error en la descarga de nformación.";
 
?>

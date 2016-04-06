<?php

/*	1- si es un ingreso lo guardo en ticket.txt
 	2- si es salida leo el archivo:
 	leer del archivo todos los datos, guardarlos en un array
	si la patente existe en el archivo .
	 sobreescribo el archivo con todas las patentes
	 y su horario si la patente solicitada
	... calculo el costo de estacionamiento a 
	20$ el segundo y lo muestro.
	si la patente no existe mostrar mensaje y 
	el boton que me redirija al index  
	3- guardar todo lo facturado en facturado.txt*/


  // var_dump($_POST);
  // array(2) { ["patente"]=> string(1) "5" ["estacionar"]=> string(7) "ingreso" } 

  $patente = $_POST["patente"];
  $accion = $_POST["estacionar"];
  $ahora = date("Y-m-d H:i:s");
  $listaEstacionados = array();
  $esta = false;

    if($accion=="ingreso"){    	
    	$archivo = fopen("ticket.txt", "a");
    	fwrite($archivo, $patente."[".$ahora."\n");
    	fclose($archivo);

    }elseif ($accion=="egreso") {
    	$archivo = fopen("ticket.txt", "r");
    	$tiempo = 0;
    	
    	while(!feof($archivo)){
    		$renglon = fgets($archivo);
    		$auto = array();
    		$auto = explode("[", $renglon);
    		$esta = true;   	
    		if($auto[0] == $patente){
    			 		
    			$tiempo = strtotime($ahora) -  strtotime($auto[1]);
    			echo $tiempo;
    		}else{
    			if($auto[0]!=""){
    				$listaEstacionados [] = $auto;
    			}

    		}    		
    	}
    	fclose($archivo);
	    if($esta){
    	$archivo = fopen("ticket.txt", "w");
    	foreach ($listaEstacionados as $autoAux) {
			fwrite($archivo, $autoAux[0]."[".$autoAux[1]."\n");
		}
		fclose($archivo);
		}
    }

        	




  
?>
<br>
<br>
<a href="index.php">volver</a>
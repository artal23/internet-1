<?php 
	require_once("..\clases/conexion/conexion.php");
	if(isset($_POST('asunto')) && !empty($_POST('asunto')) && isset($_POST('mensaje')) && !empty($_POST('mensaje'))){
		
	    session_start();
	    $con=$conexion;    
	    $sql="SELECT correo FROM participante";
	    $query=mysqli_query($con,$sql);
	    $array=mysql_fetch_row ($query)
	    $i=0;
		while($array[$i]){
			$destino=$array[$i];
			$desde = "FROM:"."Administradivo UNSA";
			$asunto =($_POST('asunto'));
			$mensaje =($_POST('mensaje'));
			mail($destino,$asunto,$mensaje,$desde);
			$i++;
		}
		echo "Correos Enviados...";
	}else {
		echo "Problemas al enviar el correo ,porfavor verifique los datos";
	}
	?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="estilos.css">
<meta http-equiv="refresh"  content="5">
<style type="text/css">

		#caja{
			background:#CACFD2;
			width:250px;
			border:1px solit white;
			margin :200px auto;
			padding:1em;
			border-radius:8px;
		}
		h1,h2,h3,h4{
			front-family:arial;
			color:#0080ff;
		}
</style>
</head>
<div id="caja">
	<body>
	<h3>
	<form action="correo.php" method="post">
		<input name="reseptor" value="submit"  type="hidden">Para:<br>
		<input name="asunto"  placeholder="E-mail" size="30" type="text"><br> Agregar Asunto:<br>
		<input name="mensaje"  placeholder="Asunto" size="30" type="text"><br> Mensaje:<br>
		<textarea name="mensaje" rows="7" cols="30">
		</textarea><br>
		<input value="Enviar" type="submit">
	</form>
	<h3>
	</body>
</div>
</html>

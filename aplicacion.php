<?PHP include ("seguridad.php");?>
<html>
	<head>
		<title>Aplicaci�n segura</title>
	</head>
	<body>
	  <h1>Bienvenido <?PHP echo $_SESSION["name"];?></h1>
	  <br>
	  ----
	  <br>
	  Usuario: <?PHP echo $_SESSION["user"];?>
	  <br>
	   ----
	  <br><br>
	  <a href="otra.php">Continuar</a>
	 </body>
</html>

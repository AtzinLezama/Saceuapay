<?php
//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
	die("no hay conexion " . mysqli_connect_error());
}

//recuperar las variables
$concepto = $_POST["txtConcepto"];
$costo = $_POST["txtCosto"];

//consulta de nombre duplicado
//$consulta = mysqli_query($conn,"SELECT * FROM tbl_concepto WHERE nombre='$nombre' ");

//condicion de login ya registrado
//consulta de nvo ingreso duplicado
$consulta = mysqli_query($conn, "SELECT * FROM tbl_concepto WHERE nombre	 = '$concepto' ");

//condicion de login ya registrado
if (mysqli_num_rows($consulta) > 0) {
	echo '
	<script>
	alert("Este concepto ya esta registrado");
	window.location.href = "Concepto.html";
	</script>
	';
} else {




	//insert tabla usuario  
	$insertarconcepto = "INSERT INTO tbl_concepto ( nombre, costo) VALUES ('$concepto','$costo')";                             //columnas											//informacion a subir
	$query = mysqli_query($conn, $insertarconcepto);

	//ejecutamos la sentencia de sql
	if (!$query) {

		echo '
		<script>
		alert("hubo algun error");
		window.location.href = "Concepto.html";
		</script>
		';
	} else {
		echo '
		<script>
		alert("Datos guardados correctamente");
		window.location.href = "Concepto.html";
		</script>
		';
	}
}

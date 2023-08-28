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

//variables 
$numcontrol = $_POST["txtNumcontrol"];
$alumno = $_POST["txtRalumno"];
$cuatrimestre = $_POST["txtCuatrimestre"];
$carrera = $_POST["txtCarrera"];
$concepto = $_POST["txtConcepto"];
$estatus = $_POST["txtEstatus"];
$cantidad = $_POST["txtCantidad"];
$descuento = $_POST["txtDescuento"];
$total = $_POST["txtTotal"];
$tpago = $_POST["txtTpago"];
$comentarios = $_POST["txtComentarios"];

//consulta de id_alumno para insertar llave foranea
$consultaAlumno = "SELECT id_alumno FROM tbl_alumno WHERE numero_control = '$numcontrol'";
$query = mysqli_query($conn, $consultaAlumno);
$row = mysqli_fetch_array($query);
$aluid = $row[0];


///consulta de id_conceptos para insertar llave foranea
$consultaConcepto = "SELECT id_concepto FROM tbl_concepto WHERE id_concepto = '$concepto'";
$query2 = mysqli_query($conn, $consultaConcepto);
$row1 = mysqli_fetch_array($query2);
$conseptoid = $row1[0];


$consultapagonc = "SELECT * FROM tbl_cargo where  (numero_control = '$numcontrol' and id_conceptos = '$concepto' and fecha = CURDATE())";
$query4 = mysqli_query($conn, $consultapagonc);
$row2 = mysqli_fetch_array($query4);


if (mysqli_num_rows($query4) > 0) {

	echo '
			<script>
	 		alert("Pago existente");
	 		window.location.href = "saceuapay.php";
	 		</script>
			';
} else {

	//insert tabla cargo
	$insertarpago = "INSERT INTO tbl_cargo 
	(numero_control, id_alumno ,cuatrimestre, carrera, id_conceptos , status, cantidad, descuento, total, tipo_pago, observaciones,fecha) VALUES 
	('$numcontrol','$aluid','$cuatrimestre','$carrera','$conseptoid','$estatus','$cantidad','$descuento','$total','$tpago','$comentarios', CURRENT_TIMESTAMP())";



	$query3 = mysqli_query($conn, $insertarpago);
	$usuarioid = mysqli_insert_id($conn);


	if (!$query3) {

		echo '
		<script>
		alert("hubo algun error");
		window.location.href = "saceuapay.php";
		</script>
		';
	} else {

		echo '
		<script>
		alert("cargo creado correctamente");
		window.location.href = "readSaceuapay.php";
		</script>
		';
	}
}

// if ($ra == $ra2) {
// 	echo '
// 		<script>
// 		alert("Pago existente");
// 		window.location.href = "saceuapay.php";
// 		</script>
// 		';
// } else {

// 	//insert tabla cargo
// 	$insertarpago = "INSERT INTO tbl_cargo 
// 	(numero_control, id_alumno ,cuatrimestre, carrera, id_conceptos , status, cantidad, descuento, total, tipo_pago, observaciones,fecha) VALUES 
// 	('$numcontrol','$aluid','$cuatrimestre','$carrera','$conseptoid','$estatus','$cantidad','$descuento','$total','$tpago','$comentarios', CURRENT_TIMESTAMP())";



// 	$query3 = mysqli_query($conn, $insertarpago);
// 	$usuarioid = mysqli_insert_id($conn);


// 	if (!$query3) {

// 		echo '
// 		<script>
// 		alert("hubo algun error");
// 		window.location.href = "saceuapay.php";
// 		</script>
// 		';
// 	} else {

// 		echo '
// 		<script>
// 		alert("cargo creado correctamente");
// 		window.location.href = "saceuapay.php";
// 		</script>
// 		';
// 	}
// }
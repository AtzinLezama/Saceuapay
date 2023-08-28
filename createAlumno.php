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
$usuario = $_POST["txtUsuario"];
$password = $_POST["txtPassword"];
$nombre = $_POST["txtNombre"];
$numcontrol = $_POST["txtNumcontrol"];
$carrera = $_POST["txtCarrera"];
$cuatrimestre = $_POST["txtCuatrimestre"];
$tipo = $_POST["txtTipo"];

//consulta de duplicado
$consulta = mysqli_query($conn, "SELECT * FROM tbl_usuario WHERE login='$usuario' ");

//condicion de login ya registrado
if (mysqli_num_rows($consulta) > 0) {
	echo '
	<script>
	alert("Este usuario ya existe");
	window.location.href = "createAlumnos.php";
	</script>
	';
} else {

	$insertarusuario = "INSERT INTO tbl_usuario (login, password, tipo_usuario) VALUES ('$usuario','$password','$tipo')";                             //columnas											//informacion a subir
	$query = mysqli_query($conn, $insertarusuario);
	$usuarioid = mysqli_insert_id($conn);


	if (!$query) {

		echo '
		<script>
		alert("hubo algun error");
		window.location.href = "createAlumnos.php";
		</script>
		';
	} else {
		$insertaralumno = "INSERT INTO tbl_alumno (nombre, numero_control, id_carrera, cuatrimestre, id_usuario) VALUES ('$nombre','$numcontrol','$carrera','$cuatrimestre', '$usuarioid')";
		$queryy = mysqli_query($conn, $insertaralumno);
		echo '
		<script>
		alert("Usuario creado correctamente");
		window.location.href = "readAlumno.php";
		</script>
		';
	}
}

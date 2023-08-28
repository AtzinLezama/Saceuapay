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
$login = $_POST["txtUsuario"];
$password = $_POST["txtPassword"];
$tipo = $_POST["txtTipo"];

$nombre = $_POST["txtNombre"];
$puesto = $_POST["txtPuesto"];
$email = $_POST["txtEmail"];
$telefono = $_POST["txtTelefono"];


//consulta de login duplicado
$consulta = mysqli_query($conn, "SELECT * FROM tbl_usuario WHERE login='$login' ");

//condicion de login ya registrado
if (mysqli_num_rows($consulta) > 0) {
	echo '
	<script>
	alert("Este usuario ya existe");
	window.location.href = "../createUser.html";
	</script>
	';
} else {

	//insert tabla usuario  
	$insertarusuario = "INSERT INTO tbl_usuario (login, password, tipo_usuario) VALUES ('$login','$password','$tipo')";                             //columnas											//informacion a subir
	$query = mysqli_query($conn, $insertarusuario);

	$usuarioid = mysqli_insert_id($conn);

	//ejecutamos la sentencia de sql
	if (!$query) {

		echo '
		<script>
		alert("hubo algun error");
		window.location.href = "../createUser.html";
		</script>
		';
	} else {
		//insert tabla empleado
		$insertarempleado = "INSERT INTO tbl_empleado (nombre, id_usuario , puesto, email, contraseña, telefono) VALUES ('$nombre','$usuarioid','$puesto','$email','$password', '$telefono')";
		$queryy = mysqli_query($conn, $insertarempleado);
		//header("Location: /agregarusu.php");

		echo '
		<script>
		alert("Datos guardados correctamente");
		window.location.href = "../readUsuario.php";
		</script>
		';
	}
}

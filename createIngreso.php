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

$ncontrol = $_POST["txtNcontrol"];
$nombre = $_POST["txtNombre"];
$descuento = $_POST["txtDescuento"];
$adeudo = $_POST["txAdeudo"];
$periodo = $_POST["txPeriodo"];
$saldo = $_POST["txtSaldo"];
$comentarios = $_POST["txtComentarios"];



//consulta de nvo ingreso duplicado
$consulta = mysqli_query($conn, "SELECT * FROM tbl_ingreso WHERE num_control	 = '$ncontrol' ");

//condicion de login ya registrado
if (mysqli_num_rows($consulta) > 0) {
    echo '
	<script>
	alert("Este alumno de nvo ingrso ya esta registrado");
	window.location.href = "nvoIngreso.php";
	</script>
	';
} else {

    //insert tbl ingrso  
    $insertingreso = "INSERT INTO tbl_ingreso 
    (num_control, nombre, descuento, adeudo, periodo, mes1, mes2, mes3, mes4, saldo, comentarios) 
    VALUES 
    ('$ncontrol','$nombre','$descuento','$adeudo','$periodo','2640','2640','2640','2640','$saldo','$comentarios')";                             //columnas											//informacion a subir
    $query = mysqli_query($conn, $insertingreso);

    $usuarioid = mysqli_insert_id($conn);
    echo '
	<script>
	alert("alumno de nvo ingrso registrado correctamente");
	window.location.href = "nvoIngreso.php";
	</script>
	';
}

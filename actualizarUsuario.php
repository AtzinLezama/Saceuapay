<?php
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null ||      $varsesion = '') {
	header("Location: index.html");
}

//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
	die("no hay conexion " . mysqli_connect_error());
}

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_empleado WHERE id_empleado = '$id'";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);






?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="styles/estiloFormAdmin.css" />
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Formulario Alumno</title>
</head>
<header>

	<section>
		<img src="images/logoarkos.png" id="logo">

		<nav>
			<ul>
				<li><a href="menuadmin.php">Inicio</a></li>
				<li><a href="menuadmin.php">Regresar</a></li>
				<ul>
					<li><a><?php echo $_SESSION['usuario'] ?> </a></li>
					<li><a href="php/logout.php">Cerrar sesion</a></li>

				</ul>

				</li>
			</ul>
		</nav>
	</section>
</header>

<body>

	<form action="http://localhost/Saceuapay/updateUsuario.php" method="post">
		<h1 align="center">Actualizar usuario</h1>
		<h3>

			<label>Id :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtId" placeholder="Nombre" required value="<?php echo $row['id_empleado'] ?>" readonly><br><br>

			<label>Nombre :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtNombre" placeholder="Nombre" required value="<?php echo $row['nombre'] ?>"><br><br>

			<label>Puesto:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtPuesto" placeholder="Numero de Control" required value="<?php echo $row['puesto'] ?>"><br><br>

			<label>Email:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtEmail" placeholder="Numero de Control" required value="<?php echo $row['email'] ?>"><br><br>

			<label>Contraseña:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtContraseña" placeholder="Cuatrimestre" required value="<?php echo $row['contraseña'] ?>"><br><br>

			<label>Telefono:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="number" class="campo" name="txtTelefono" placeholder="Cuatrimestre" required value="<?php echo $row['telefono'] ?>"><br><br>




			</select>
			<br>
		</h3><br><br><br>

		<a>
			<input type="submit" name="admguardar" class="btn btnn" value="Actualizar Usuario"></a>


	</form>

</body>

</html>
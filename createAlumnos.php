<?php
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null ||      $varsesion = '') {
	header("Location: index.html");
}

$conn = mysqli_connect(
	'localhost',
	'root',
	'',
	'saceuapay'
);


$ncontrol = "SELECT numero_control FROM tbl_alumno ORDER BY id_alumno DESC LIMIT 1;";
$query = mysqli_query($conn, $ncontrol);
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



				</li>
			</ul>
		</nav>
	</section>
</header>

<body>

	<form action="http://localhost/Saceuapay/createAlumno.php" method="post">
		<h1 align="center">Registro de Alumnos</h1>
		<h3>

			<label> Usuario :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtUsuario" placeholder="Usuario" required><br><br>

			<label> Password :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="password" class="campo" name="txtPassword" placeholder="Password" required><br><br>

			<label>Nombre :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input type="text" class="campo" name="txtNombre" placeholder="Nombre" required><br><br>

			<label>Numero de Control:</label> &nbsp &nbsp
			<input min="1" type="number" class="campo" name="txtNumcontrol" placeholder="Numero de Control" required value="<?php echo ($row[0] + 1) ?>" readonly><br><br>

			<label> Carrera :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<select name="txtCarrera" style="width: 280px" required>
				<?php
				//imprime los conceptos guardados en la db
				$conceptos = "SELECT * FROM tbl_carrera";
				$resultado = mysqli_query($conn, $conceptos);
				while ($valores = mysqli_fetch_array($resultado)) {
					echo '<option value="' . $valores['id_carrera'] . '">' . $valores['nombre'] . '</option>';
				}
				?>
			</select><br><br>

			<label>Cuatrimestre:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			<input min="1" type="number" class="campo" name="txtCuatrimestre" placeholder="Cuatrimestre" required><br><br>



		</h3>

		<a>
			<input type="submit" name="admguardar" class="btn btnn" value="Registrar Usuario"></a>


	</form>

</body>

</html>
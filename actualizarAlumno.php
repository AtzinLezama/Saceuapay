<?php
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null ||      $varsesion = ''){
   header("Location: index.html");
}

//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){
    die("no hay conexion ".mysqli_connect_error());
}

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_alumno WHERE id_alumno = '$id'";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$carrera = $row['id_carrera'];




?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles/estiloFormAdmin.css"/>
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
      <li><a ><?php echo $_SESSION['usuario']?> </a></li>
      <li><a href="php/logout.php">Cerrar sesion</a></li>

   </ul>

 </li>
</ul>
</nav>
</section>
</header>
<body>

	<form  action="http://localhost/Saceuapay/updateAlumno.php" method="post">
		<h1 align="center">Registro de Alumnos</h1>
		<h3>
		
		<label>Id :</label>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<input type="text" class="campo" name="txtId" placeholder="Nombre" required value="<?php echo$row['id_alumno']?>"readonly><br><br>

		<label>Nombre :</label>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<input type="text" class="campo" name="txtNombre" placeholder="Nombre" required value="<?php echo$row['nombre']?>"><br><br>

		<label>Numero de Control:</label>  &nbsp &nbsp 
		<input type="text" class="campo" name="txtNumcontrol" placeholder="Numero de Control" required value="<?php echo$row['numero_control']?>"><br><br>

		<label> Carrera :</label>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 	&nbsp &nbsp  &nbsp 
		<select name="txtCarrera" style="width: 280px" required > 
		<?php
			//imprime los conceptos guardados en la db
			$sql2 = "SELECT nombre FROM tbl_carrera WHERE id_carrera = '$carrera'";

			$query = mysqli_query($conn, $sql2);
			$res = mysqli_fetch_array($query);
			$max = $res[0];
			
			echo'<option   value="'.$carrera.'">'.$max.'</option>';

			$conceptos = "SELECT * FROM tbl_carrera ";
			$resultado = mysqli_query($conn, $conceptos);
			
				
			while($valores = mysqli_fetch_array($resultado)){
					
					echo'<option   value="'.$valores['id_carrera'].'">'.$valores['nombre'].'</option>';
				}
				?>
		</select><br><br>

		<label>Cuatrimestre:</label>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<input type="number" class="campo" name="txtCuatrimestre" placeholder="Cuatrimestre" required value="<?php echo$row['cuatrimestre']?>"><br><br>


		
			
		</select>
		<br></h3><br><br><br>
		
		<a >
			<input type="submit" name="admguardar" class="btn btnn" value="Actualizar Usuario"></a>
	

</form>

</body>
</html>
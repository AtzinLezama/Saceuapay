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

session_start();

$varsesionn = $_SESSION['usuario'];

$consultaUsuario = "SELECT 	tipo_usuario  FROM tbl_usuario WHERE login = '$varsesionn'";
$query = mysqli_query($conn, $consultaUsuario);

$row = mysqli_fetch_array($query);
$max = $row[0];


echo "<script>console.log('Console: " . $max . "' );</script>";
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="styles/estiloPay.css" />
	<meta charset="utf-8">
	<title>SACEUAPAY DATOS DEL ESTUDIANTE</title>

	<script type="text/javascript" src="lib/jquery-1.12.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/jquery-ui.css">
	<script type="text/javascript" src="lib/jquery-ui.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="styles/estilo.css">


</head>
<header>

	<section>
		<img src="images/logoarkos.png" id="logo">


		<nav>
			<ul>


				<li><a href="#">Alumno</a>
					<div class="submenu">
						<ul>
							<li><a href="readAlumno.php">Consultar o eliminar Alumno</a></li>
							<li><a href="createAlumnos.php">Agregar Alumno</a></li>
						</ul>
				<li><a href=" <?php
								//regrresar dependiendo tipo de sesion
								if ($max == 2) {
									echo "menuadmin.php";
								} elseif ($max == 3) {
									echo "caja.php";
								} elseif ($max == 4) {
									echo "cobranza.php";
								}
								?>">Inicio</a></li>


				</li>

				</div>

				</li>
			</ul>
		</nav>
	</section>
</header>

<body>

	<div class=""> <br><br>
		<form action="http://localhost/Saceuapay/createSaceuapay.php" method="post" autocomplete="OFF">

			<fieldset class="form-body">
				<br>
				<br>


				<p class="text">PAGOS</p>


				<label style="margin-left: 57px; margin-right: 40px;">Numero de control</label>
				<input type="number" style="width: 300px;" required="required" id="tag" name="txtNumcontrol" min="1" />





				<br><label style="margin-left: 57px; margin-right: 43.5px;">Recibi del alumno</label>
				<textarea readonly id="nombre" type="text" name="txtRalumno" required="required" cols="40" rows="1" style="resize: none;"> </textarea>



				<br><label style="margin-left: 57px;">Cuatrimestre </label>
				<textarea readonly required="required" id="cuatrimestre" type="text" name="txtCuatrimestre" required="required" cols="40" rows="1" style="resize: none;"> </textarea>



				<br><label style="margin-left: 57px;">Licenciatura o maestria </label> &nbsp
				<textarea readonly required="required" id="carrera" type="text" name="txtCarrera" required="required" cols="40" rows="1" style="resize: none;"> </textarea>




				<br>
				<p class="text">Concepto de pago</p>

				<label style="margin-left: 57px;">Valido por </label> &nbsp

				<select id="concepto" name="txtConcepto" required="required" />
				<option value=""></option>

				<?php
				//imprime los conceptos guardados en la db
				$conceptos = "SELECT * FROM tbl_concepto";
				$resultado = mysqli_query($conn, $conceptos);
				while ($valores = mysqli_fetch_array($resultado)) {
					echo '<option value="' . $valores['0'] . '">' . $valores['1'] . '</option>';
				}
				?>


				</select>
				<br><label style="margin-left: 56px;">Estatus </label> &nbsp

				<select name="txtEstatus" required="required" />
				<option value=""></option>
				<option value="Pagado">Pagado</option>
				<option value="Pendiente">Pendiente</option>

				</select>

				<div id="contenido" name="formulario">
					<br><label style="margin-left: 60px; margin-right: 10px;">Por la cantidad de $</label>
					<input min="1" type="number" pattern="[0-9]+([\.,][0-9]+)?" step="00.01" name="txtCantidad" class="form-control" id="saleP" onkeyup="discount();" required="required" />
					<!--<input type="text" name="txtCantidad" id="v1" step="0.001"  style="width: 100px;" value="23">-->


					<label style="margin-left: 56px;">Descuento</label>
					<select name="txtDescuento" class="form-control" id="discountP" onkeyup="discount();">
						<!--<select id="Descuento" name="txtDescuento" style="width: 100px" id="v2" step="0.001" > -->
						<option value="0">0 %</option>
						<option value="5">5 %</option>
						<option value="10">10% </option>
						<option value="15">15% </option>
						<option value="20">20 %</option>
						<option value="25">25% </option>
						<option value="30">30% </option>
						<option value="35">35 %</option>
						<option value="40">40%</option>
						<option value="45">45%</option>
						<option value="50">50%</option>
						<option value="55">55%</option>
						<option value="60">60%</option>
						<option value="65">65%</option>
						<option value="70">70%</option>
						<option value="75">75%</option>
						<option value="80">80%</option>
						<option value="85">85%</option>
						<option value="90">90%</option>
						<option value="95">95%</option>
						<option value="100">100%</option>
					</select>



					<br> <label style="margin-left: 56px;">Total $ : </label>
					<input type="number" name="txtTotal" placeholder="Total" class="form-control" id="discountInput" readonly>
					<!--<input type="text" name="txtTotal" style="width: 300px;" id="total" step="0.001"  value="55" readonly> -->

					<script type="text/javascript">
						window.setInterval(function discount() {


							let price = +document.getElementById('saleP').value;
							let discount = ((+document.getElementById('discountP').value));
							let cal = (price * discount) / 100;
							let total = price - cal;
							document.getElementById('discountInput').value = total;

							console.log(discount);


						}, 500);
					</script>


				</div>


				<br><label style="margin-left: 65px;">Tipo de pago</label>
				<select name="txtTpago" required="required" />
				<option value=""></option>
				<option value="Efectivo">Efectivo</option>
				<option value="Tarjeta">Tarjeta</option>
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option><br>
				</select>

				<div align="center">

					<fieldset> <label style="margin-left: 57px; margin-right: 43.5px;">Fecha actual</label>
						<div id="current_date" name="txtFecha">

							<script class="fecha">
								date = new Date();
								day = date.getDate();
								month = date.getMonth() + 1;
								year = date.getFullYear();
								document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
							</script>
					</fieldset> <br>

					<label style="margin-left: 65px; margin-right: 45px;">Comentarios</label>
					<input type="text" name="txtComentarios" style=" height: 100px;"><br><br>
				</div><br>

				<input type="submit" class="btn btnn" value="Registrar pago"><br><br>





			</fieldset>

		</form>
	</div><br><br>




</body>


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>




<?php

$conalumnos = ("SELECT * FROM tbl_alumno");
$result = mysqli_query($conn, $conalumnos);
$array = array();

if ($result) {
	while ($row = mysqli_fetch_array($result)) {
		$equipo = utf8_encode($row[2]);
		array_push($array, $equipo); // equipos
	}
}

$conprecio = ("SELECT * FROM tbl_concepto");
$result2 = mysqli_query($conn, $conprecio);
$array2 = array();

if ($result2) {
	while ($row = mysqli_fetch_array($result2)) {
		$equipo2 = utf8_encode($row[2]);
		array_push($array, $equipo2); // equipos
	}
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		var items = <?= json_encode($array) ?>

		$("#tag").autocomplete({
			source: items,
			select: function(event, item) {
				var params = {
					alumno: item.item.value
				}
				$.get("peticiones.php", params, function(response) {
					console.log(response);
					var json = JSON.parse(response);
					if (json.status == 200) {
						$("#nombre").val(json.nombre);

						$("#cuatrimestre").html(json.cuatrimestre);
						$("#carrera").html(json.id_carrera);

					} else {

					}
				});
			}

		});
	});

	$(document).ready(function() {
		var precio = <?= json_encode($array2) ?>

		$("#concepto").autocomplete({
			source: precio,
			select: function(event, precio) {
				var params = {
					alumno: precio.precio.value
				}
				console.log(precio.precio.value);
				$.get("peticiones.php", params, function(response) {
					console.log(response);
					var json = JSON.parse(response);
					if (json.status == 200) {
						$("#nombre").val(json.nombre);

					} else {

					}
				});
			}

		});
	});
</script>

</html>


<!-- <fieldset> <label style="margin-left: 57px; margin-right: 43.5px;">Del </label>
	<div id="current_date" name="txtFecha">

		<script class="fecha">
			date = new Date();
			day = date.getDate();
			month = date.getMonth() + 1;
			year = date.getFullYear();
			document.getElementById("current_date").innerHTML = day + "/" + month + "/" + year;
		</script>
</fieldset> <br> -->
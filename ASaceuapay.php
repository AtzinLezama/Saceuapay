<?php
//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){
    die("no hay conexion ".mysqli_connect_error());
}

session_start();

$varsesionn = $_SESSION['usuario'];

$consultaUsuario = "SELECT 	tipo_usuario  FROM tbl_usuario WHERE login = '$varsesionn'";
$query = mysqli_query($conn, $consultaUsuario);

$row = mysqli_fetch_array($query);
$max = $row[0];


$id = $_GET['id'];

$sql = "SELECT * FROM tbl_alumno WHERE id_alumno = '$id'";

$query = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles/estiloPay.css"/>
	<meta charset="utf-8">
	<title>SACEUAPAY DATOS DEL ESTUDIANTE</title>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
	

	
</head>
<header>
   
<section>
<img src="images/logoarkos.png" id="logo">


<nav>
<ul>
<li><a href="menuadmin.php">Inicio</a></li>
        <div class="submenu">
   <ul>
      <li><a href="#">Consultar o eliminar pago</a></li>
   </ul>
</div>
</li>

<li><a href="#">Alumno</a>
<div class="submenu">
   <ul>
      <li><a href="readAlumno.php">Consultar o eliminar Alumno</a></li>
      <li><a href="createAlumno.html">Agregar Alumno</a></li>
   </ul>
   <li><a href=" <?php 
   //regrresar dependiendo tipo de sesion
   if($max == 2){
    echo "menuadmin.php";
   }elseif($max == 3){
    echo "caja.php";
   }elseif($max == 4){
    echo "cobranza.php";
   }
   ?>" >Regresar</a></li>
   <li><a href="formAdmin.html"><img src = "images/usuario.png"  width="30" height="30" /><br></a>
   <div class="submenu">
      <ul>
      <li><a href="php/logout.php">Cerrar sesion</a></li>

   </ul>

 </li>

</div>

</li>
</ul>
</nav>
</section>
</header>
<body>

<div class="forma"> <br><br>
<form action="http://localhost/Saceuapay/createSaceuapay.php" method="post" autocomplete="OFF">
	
	<fieldset class="uu">
		<br>
	<br>


	<h1>PAGOS</h1><br><br>
		
	 
	<br><br><label style="margin-left: 57px; margin-right: 40px;" autocomplete="OFF" >Numero de control</label>
		<input type="text" name="txtNumcontrol"  id="campo"style="width: 300px;"   required="required" value="<?php echo$row2['numero_control']?>"> 
		<ul id="lista" class="lista" style="list-style-type: none;width: 300px;height: auto;position: absolute;margin-top: 10px;
		margin-left: 10px;margin-left: 235px;margin-right: 50px;cursor: pointer;background-color: #EEEEEE;border-top: 1px solid #9e9e9e;">
		</ul>
        

		<br><br><label style="margin-left: 57px; margin-right: 43.5px;">Recibi del alumno</label> 
		<input type="text" name="txtRalumno" style="width: 300px;"required="required" id="campon" value="<?php echo$row2['nombre']?>"><br><br><b><br>

		<br><br><label style="margin-left: 57px;">Cuatrimestre </label> &nbsp &nbsp
		<select id="Cuatrimestre" name="txtCuatrimestre" style="width: 300px"required="required" readonly> 
            <?php echo'<option   value="'.$row2['cuatrimestre'].'">'.$row2['cuatrimestre'].'</option>';?>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>

		<br><br><label style="margin-left: 57px;">Licenciatura o maestria </label> &nbsp 
		<select name="txtCarrera" style="width: 280px" required > 
		<?php
			//imprime los conceptos guardados en la db
			$sql2 = "SELECT nombre FROM tbl_carrera WHERE id_carrera = '$carrera'";

			$queryy = mysqli_query($conn, $sql2);
			$res = mysqli_fetch_array($queryy);
			$maxx = $res[0];
			
            if($row2['id_carrera'] == 0){
			    echo'<option   value="0">Mercadotecnia</option>';
            }elseif($row2['id_carrera'] == 1){
                echo'<option   value="1">Contaduria</option>';
            }elseif($row2['id_carrera'] == 2){
                echo'<option   value="2">Derecho</option>';
            }elseif($row2['id_carrera'] == 3){
                echo'<option   value="3">Ciencias de la comunicación</option>';
            }elseif($row2['id_carrera'] == 4){
                echo'<option   value="4">Administración de empresas turísticas</option>';
            }

			$conceptos = "SELECT * FROM tbl_carrera ";
			$resultado = mysqli_query($conn, $conceptos);
			
				
			while($valores = mysqli_fetch_array($resultado)){
					
					echo'<option   value="'.$valores['id_carrera'].'">'.$valores['nombre'].'</option>';
				}
				?>
		</select>


		<br><br>	<h2>Concepto de pago</h2>
		<br><br> &nbsp  &nbsp  &nbsp  &nbsp  &nbsp 
		<label style="margin-left: 15px;">Valido por </label> &nbsp 

		<select name="txtConcepto" style="width: 500px;"required="required"/> 
			<option value=""></option>
			
			<?php
			//imprime los conceptos guardados en la db
			$conceptos = "SELECT * FROM tbl_concepto";
			$resultado = mysqli_query($conn, $conceptos);
				while($valores = mysqli_fetch_array($resultado)){
					echo'<option value="'.$valores['0'].'">'.$valores['1'].'</option>';
				}
				?>


		</select>  <br><br>
		<br><br><label style="margin-left: 56px;">Estatus </label> &nbsp 

		<select name="txtEstatus" style="width: 500px;"required="required"/> 
			<option value=""></option>
			<option value="Pagado">Pagado</option>
			<option value="Pendiente">Pendiente</option>

		</select>  
		
	<div id="contenido" name="formulario">
		<br><br><label style="margin-left: 60px; margin-right: 10px;">Por la cantidad de $</label> 
		<input type="number"  pattern="[0-9]+([\.,][0-9]+)?" step="00.01" name="txtCantidad" class="form-control" id="saleP" onkeyup="discount();" required="required"/>
		<!--<input type="text" name="txtCantidad" id="v1" step="0.001"  style="width: 100px;" value="23">-->


		<label style="margin-left: 10%;">Descuento</label>
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


	
		 <br><br> <br> <label style="margin-left: 148px;" >Total $ : </label> 
		 <input type="number" name="txtTotal" placeholder="Total"  class="form-control" id="discountInput" readonly>
		 <!--<input type="text" name="txtTotal" style="width: 300px;" id="total" step="0.001"  value="55" readonly> -->
		
		<script type="text/javascript">
	window.setInterval(function discount() {


		let price = + document.getElementById('saleP').value;
  		let discount = ((+ document.getElementById('discountP').value));
		let cal =  (price * discount)/100;
		let total =  price - cal;
 		 document.getElementById('discountInput').value = total ;

		 console.log(discount);


	}, 500);

</script>
		

	</div>

		
		<br><br> <label style="margin-left: 65px;">Tipo de pago</label>
		<select name="txtTpago" style="width: 500px; margin-left: 6px;"required="required"/> 
			<option value=""></option>
			<option value="1">Efectivo</option>
			<option value="2">Tarjeta</option>
			<option value="3">Transferencia</option>
			<option value="4">Cheque</option><br>
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
				<input type="text" name="txtComentarios" style="width: 500px; height: 50px;"><br><br>
			</div><br>
		
			<input type="submit" class="btn btnn" value="Registrar pago"  >





	</fieldset> 

</form>
</div>



<script src="peticiones.js"></script>
</body>


</script>
</html>
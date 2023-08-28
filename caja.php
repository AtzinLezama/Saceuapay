<?php
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null ||      $varsesion = ''){
   header("Location: index.html");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles/estilo.css"/>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Caja</title>
</head>
<header>
   
<section>
<img src="images/logoarkos.png" id="logo">




<nav>
<ul>

<li><a href="#about">Alumnos</a>
        <div class="submenu">
   <ul>
      <li><a href="readSaceuapayCaja.php">Consultar saldos</a></li>
   </ul>
   <li><a href="#about">Pagos</a>
   <div class="submenu">
   <ul>
    <li><a href="saceuapay.php">Realizar pago</a></li>
  </ul>
  
</div>
 <li><a href="formAdmin.html"><img src = "images/usuario.png"  width="30" height="30" /><a ><?php echo $_SESSION['usuario']?> </a></a>
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


   
   <img class="logoA" src="images/logoarkos.png"></body>
</html>

<?php
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null ||      $varsesion = '') {
   header("Location: index.html");
}

?>

<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" type="text/css" href="styles/estilo.css" />
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <title>Menu Admin</title>
</head>
<header>

   <section>

      <img src="images/logoarkos.png" id="logo">

      <nav>
         <ul>



            <li><a href="#">Alumno</a>
               <div class="submenu">
                  <ul>
                     <li><a href="readAlumno.php">Consultar</a></li>
                     <li><a href="createAlumnos.php">Agregar</a></li>


                  </ul>

            </li>

            <li><a href="#">Usuarios</a>
               <div class="submenu">

                  <ul>
                     <li><a href="createUser.html">Agregar</a></li>
                     <li><a href="readUsuario.php">Consultar</a></li>
                  </ul>

               </div>
            </li>

            <li><a href="Concepto.html">Servicio</a>
               <div class="submenu">
                  <ul>
                     <li><a href="readServicios.php">Lista de servicios</a></li>
                  </ul>

            <li><a href="#">Pagos</a>
               <div class="submenu">
                  <ul>
                     <li><a href="saceuapay.php"> Agregar cobro</a></li>
                     <li><a href="readSaceuapay.php">Pagos realizados </a></li>


                  </ul>

            <li><a>Reportes</a>
               <div class="submenu">
                  <ul>
                     <li><a href="facturasFecha.php">Reporte de ventas </a></li>

                  </ul>

            <li><a href="periodos.html">Periodo</a>
               <div class="submenu">
                  <ul>
                     <li><a href="readPeriodo.php">Reportes Periodos</a></li>
                  </ul>

            <li><a href="formAdmin.html"><img src="images/usuario.png" width="30" height="30" /><a><?php echo $_SESSION['usuario'] ?> </a></a>
               <div class="submenu">
                  <ul>
                     li><a href="actualizarAlumnoa.php">Cambiar usuario y contraseña</a>
            </li>
            <li><a href="php/logout.php">Cerrar sesion</a></li>
         </ul>

         </li>

         </div>
         </li>
         </ul>
      </nav>
   </section>
</header>

<body><img class="logoA" src="images/logoarkos.png"></body>

</html>
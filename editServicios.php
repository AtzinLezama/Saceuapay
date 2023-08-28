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

$sql = "SELECT * FROM tbl_concepto WHERE id_concepto = '$id'";

$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio</title>
    <link rel="stylesheet" href="styles/estilo.css">

</head>

<header>

    <section>
        <img src="images/logoarkos.png" id="logo">


        <input type="checkbox" id="toggle-1">
        <nav>

            <ul>

                <li><a href="menuadmin.html">Inicio</a></li>
                <li><a href="menuadmin.php">Regresar</a></li>
                <ul>
                    <li><a><?php echo $_SESSION['usuario'] ?> </a></li>
                    <li><a href="php/logout.php">Cerrar sesion</a></li>
                </ul>
        </nav>
    </section>
</header>

<body>

    <div class="form-body" text-align="left">


        <center>
            <p class="text">Agregar nuevo servicio</p>
        </center>

        <form method="post" action="updateServicio.php">
            <input type="text" name="txtId" placeholder="id" required value="<?php echo $row['id_concepto'] ?>" readonly><br><br>
            <input type="text" name="txtNombre" placeholder="CONCEPTO" required value="<?php echo $row['nombre'] ?>">

            <center>
                <p class="text"> COSTO $: </p>
            </center>
            <input type="number" name="txtCosto" placeholder="$" required value="<?php echo $row['costo'] ?>">


            <button>Actualizar concepto </button>
        </form>
        <center><img class="logoA" src="images/logoarkos.png"></center>


    </div>


</body>

</html>
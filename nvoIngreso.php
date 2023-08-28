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


$ncontrol = "SELECT num_control FROM tbl_ingreso ORDER BY id_ingrso DESC LIMIT 1;";
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

    <form action="http://localhost/Saceuapay/createIngreso.php" method="post">
        <h1 align="center">Nuevo Ingreso</h1>
        <h3>

            <label> N.control :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input min="1" type="number" class="campo" name="txtNcontrol" placeholder="N.control" required value="<?php echo ($row[0] + 1) ?>" readonly><br><br>

            <label> Nombre :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type="text" class="campo" name="txtNombre" placeholder="Nombre" required><br><br>

            <label>Descuento :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input min="1" type="number" class="campo" name="txtDescuento" placeholder="Descuento" required><br><br>

            <label>Adeudo:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp
            <select name="txAdeudo" style="width: 280px" required>
                <option value="1">Si</option>';
                <option value="2">No</option>';
            </select><br><br>

            <label> Periodo :</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <select name="txPeriodo" style="width: 280px" required>
                <option value="1">Ene - Abr</option>';
                <option value="2">May - Ago</option>';
                <option value="3">Sep - Dic</option>';

            </select><br><br>

            <label>Saldo:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input min="1" type="number" class="campo" name="txtSaldo" placeholder="Saldo" required><br><br>

            <label>Comentarios:</label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type="text" class="campo" name="txtComentarios" placeholder="Comentarios" required><br><br>



            <br>
        </h3><br><br><br>

        <a>
            <input type="submit" name="admguardar" class="btn btnn" value="Registrar Nvo.Alumno"></a>


    </form>

</body>

</html>
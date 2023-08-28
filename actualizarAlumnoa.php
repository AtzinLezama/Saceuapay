<?php
session_start();
$varsesion = $_SESSION['usuario'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/estilo.css">
    <title>Periodos</title>
</head>
<header>

    <section>
        <img src="images/logoarkos.png" id="logo">


        <input type="checkbox" id="toggle-1">
        <nav>

            <ul>


                <li><a href="menualumno.php">Regresar</a></li>

        </nav>
    </section>
</header>

<body>

    <div class="form-body" text-align="left">

        <center>
            <p class="text">Actualizar datos de session</p>
        </center>

        <form method="post" action="updateAlumnoa.php">
            <input name="txtactual" value=" <?php echo $_SESSION['usuario'] ?>" readonly><br><br>
            <input type="email" name="txtemail" placeholder="Ingrese nuevo email" required><br>
            <input type="password" name="txtpass" placeholder="Ingrese nueva contraseña" required><br>
            <input type="password" name="txtpass2" placeholder="Confirme contraseña" required><br>
            <input type="submit" name="admguardar" class="btn btnn" value="Actualizar ">


        </form>

        <center><img class="logoA" src="images/logoarkos.png"></center>


    </div>


</body>

</html>
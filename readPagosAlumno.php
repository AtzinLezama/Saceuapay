<script type="text/javascript">
    function confirmacion() {
        var respuesta = confirm("estas seguro que desea eliminar?");

        if (respuesta == true) {
            return true;
        } else {
            return false;
        }

    }
</script>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <meta charset="utf-8">
    <title>Buscar</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            ;
        }
    </style>
    <link rel="stylesheet" href="styles/estiloBuscar.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, inirial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


</head>
<header>

    <section>
        <img src="images/logoarkos.png" id="logo">

        <nav>
            <ul>


                <div class="submenu">
                    <ul>
                        <li><a href="#">Consultar o eliminar pago</a></li>
                        <li><a href="#">Agregar Nuevo pago</a></li>
                    </ul>
                </div>
                </li>


                <li><a href="menualumno.php">Inicio</a></li>
                </div>

                </li>
            </ul>
        </nav>
    </section>
</header>


<body>

    </fieldset>


    <div class="table-wrapper">
        <form action="deletePeriodo.php" method="post">
            <table class="fl-table">
                <thead>
                    <br><br>
                    <tr>

                        <th>N.control</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Descuento</th>
                        <th>Servicio</th>
                        <th>Status</th>
                        <th>Folio</th>
                        <th>Imprimir</th>



                    </tr>
                </thead>

                <tbody>

                    <?php
                    session_start();

                    $conn = mysqli_connect(
                        'localhost',
                        'root',
                        '',
                        'saceuapay'
                    );

                    $ids = $_SESSION['id_usuario'];

                    //select id alumno
                    $aluc = "SELECT * FROM tbl_alumno where id_usuario = '$ids'";
                    $query0 = mysqli_query($conn, $aluc);
                    $row0 = mysqli_fetch_array($query0);




                    $query = "SELECT * FROM tbl_cargo  WHERE id_Alumno = '$row0[0]'";
                    $resultalu = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($resultalu)) {

                        $alu = $row['id_alumno'];
                        $sql2 = "SELECT * FROM tbl_alumno WHERE id_alumno = '$alu'";
                        $query2 = mysqli_query($conn, $sql2);
                        $row3 = mysqli_fetch_array($query2);

                        $concepto = $row['id_conceptos'];
                        $sql4 = "SELECT * FROM tbl_concepto WHERE id_concepto = '$concepto'";
                        $query4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_array($query4);
                    ?>
                        <tr>
                            <td><?php echo $row['numero_control']  ?></td>
                            <td><?php echo $row3['nombre']  ?></td>
                            <td><?php echo $row['fecha']  ?></td>
                            <td><?php echo $row['cantidad']  ?></td>
                            <td><?php echo $row['descuento']  ?></td>
                            <td><?php echo $row4['nombre']  ?></td>
                            <td><?php echo $row['status']  ?></td>
                            <td><?php echo $row['id_cargo']  ?></td>
                            <td><a href="saceuapaypdf.php?id= <?php echo $row['id_cargo'] ?>"><img src="images/print.png" width="30" height="30" /></a></td>';



                        </tr>
                    <?php } ?>



                </tbody>
            </table>

    </div>

    </form>
</body>

</html>
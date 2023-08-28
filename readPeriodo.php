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


                <li><a href="menuadmin.php">Inicio</a></li>
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
                        <th>Id</th>
                        <th>Año</th>
                        <th>Periodo</th>
                        <th>Eliminar</th>



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



                    $query = "SELECT * FROM tbl_periodo";
                    $resultalu = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($resultalu)) { ?>
                        <tr>
                            <td><?php echo $row['id_periodo']  ?></td>
                            <td><?php echo $row['año']  ?></td>
                            <td><?php echo $row['periodo']  ?></td>

                            <th>
                                <a href="deletePeriodo.php?id=<?php echo $row['id_periodo'];  ?>" onclick="return confirmacion()">
                                    <img src="images/icondelete.svg" width="30" height="30" />
                                </a>
                            </th>
                        </tr>
                    <?php } ?>



                </tbody>
            </table>

    </div>
    <button class="btn btnn"> <a href="periodos.html">Agregar Periodo</a></button>


    </form>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio</title>
    <link rel="stylesheet" href="styles/estilo.css">


    <style type="text/css">
        table,
        td,
        th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 3px;
            width: 30px;
            height: 25px;
        }

        td {
            background: #C4DBEE;
        }

        th {
            background: #3E6889;
            color: white;
        }

        .even {
            background: #fbf8f0;
        }

        .odd {
            background: #fefcf9;
        }

        h2 {
            text-align: right;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 90%;
            padding: 10px;
            margin: auto;
            margin-top: 20px;
        }

        .r {
            text-align: right;
        }

        body {

            margin: 0;

            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }


        input[type=date] {
            height: 35px;


            font-family: arial, sans-serif;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            background-color: #959595;
            outline: none;
            border: 0;
            border-radius: 3px;
            padding: 0 3px;
            color: #fff;
            text-align: center;
        }

        input[type=date]::-webkit-clear-button {
            font-size: 18px;
            height: 30px;
            position: relative;
            right: 5px;
            margin-right: 4px;
        }

        input[type=date]::-webkit-inner-spin-button {
            height: 30px;
        }

        input[type=date]::-webkit-calendar-picker-indicator {
            font-size: 18px;
        }

        input[type=date]::-webkit-calendar-picker-indicator:hover {
            background-color: #959595;
            color: #e6e6e6;
            cursor: pointer;
        }

        input[type=date]::-webkit-calendar-picker-indicator:active {
            color: blue;
        }

        .center {
            text-align: center;
        }

        .boton {
            box-shadow: inset 0px 1px 0px 0px #ffffff;
            background: linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%);
            background-color: #ffffff;
            border-radius: 6px;
            border: 1px solid #dcdcdc;
            display: inline-block;
            cursor: pointer;
            color: #666666;
            font-family: Arial;
            font-size: 15px;
            font-weight: bold;
            padding: 6px 24px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffffff;
        }
    </style>
</head>

<header>

    <section>
        <img src="images/logoarkos.png" id="logo">


        <input type="checkbox" id="toggle-1">
        <nav>

            <ul>

                <li><a href="menuadmin.php">Inicio</a></li>

                <ul>

                </ul>
        </nav>
    </section>
</header>

<body>


    <div id="demo-content">
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <div id="content"> </div>
    </div>




    <section>
        <div class="container">
            <div class="row">
                <div class="center">
                    <div class="col-md-12 text-center mt-5">
                        <form action="reporteFecha.php" method="post" accept-charset="utf-8">
                            <div class="row">
                                <div class="col">
                                    <input type="date" name="fecha_ingreso" class="form-control" placeholder="Fecha de Inicio" required>
                                </div>
                                <br>
                                <div class="col">
                                    <input type="date" name="fechaFin" class="form-control" placeholder="Fecha Final" required>

                                </div>
                                <br>
                                <div class="col">
                                    <span class="boton" id="filtro">Filtrar</span>
                                    <button type="submit" class="boton">Descargar Reporte</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12 text-center mt-5">
                    <span id="loaderFiltro"> </span>
                </div>
                <br><br>


                <?php
                $dbhost = "localhost";
                $dbuser = "root";
                $dbpass = "";
                $dbname = "saceuapay";


                $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                if (!$conn) {
                    die("no hay conexion " . mysqli_connect_error());
                }


                $tarjetas = "SELECT SUM(total) FROM tbl_cargo WHERE tipo_pago = 'Tarjeta'";
                $resultado = mysqli_query($conn, $tarjetas);
                $row = mysqli_fetch_array($resultado);

                $efectivo = "SELECT SUM(total) FROM tbl_cargo WHERE tipo_pago = 'Efectivo'";
                $resultado2 = mysqli_query($conn, $efectivo);
                $row2 = mysqli_fetch_array($resultado2);

                $transferencia = "SELECT SUM(total) FROM tbl_cargo WHERE tipo_pago = 'Transferencia'";
                $resultado3 = mysqli_query($conn, $transferencia);
                $row3 = mysqli_fetch_array($resultado3);

                $cheque = "SELECT SUM(total) FROM tbl_cargo WHERE tipo_pago = 'Cheque'";
                $resultado4 = mysqli_query($conn, $cheque);
                $row4 = mysqli_fetch_array($resultado4);
                ?>


                <div class="table-responsive resultadoFiltro">
                    <div style=" display:flex;">
                        <h1 style="color: #fff; display:inline">Efectivo:</h1>
                        <input readonly style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row2[0] ?>" required>
                        <h1 style="color: #fff; display:inline">Tarjeta:</h1>
                        <input readonly style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row[0] ?>" required>
                        <h1 style="color: #fff; display:inline">Transferencia:</h1>
                        <input readonly style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row3[0] ?>" required>
                        <h1 style="color: #fff; display:inline">Cheque:</h1>
                        <input readonly style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row4[0] ?>" required>

                    </div>
                    <table class="table table-hover" id="tableEmpleados">
                        <thead>
                            <tr>


                                <th scope="col">Folio</th>
                                <th scope="col">Num. control</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cuatrimestre</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Status</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tipo_pago</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Observaciones</th>
                            </tr>
                        </thead>
                        <?php
                        $dbhost = "localhost";
                        $dbuser = "root";
                        $dbpass = "";
                        $dbname = "saceuapay";


                        $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
                        if (!$con) {
                            die("no hay conexion " . mysqli_connect_error());
                        }
                        $sqlTrabajadores = ('SELECT * FROM tbl_cargo ORDER BY fecha ASC');
                        $query = mysqli_query($con, $sqlTrabajadores);
                        $i = 1;




                        while ($dataRow = mysqli_fetch_array($query)) {
                            //carrera
                            $carrera = $dataRow['carrera'];
                            $sql5 = "SELECT * FROM tbl_carrera WHERE id_carrera = '$carrera'";
                            $query5 = mysqli_query($con, $sql5);
                            $row5 = mysqli_fetch_array($query5);

                            $alu = $dataRow['id_alumno'];
                            $sql2 = "SELECT * FROM tbl_alumno WHERE id_alumno = '$alu'";
                            $query2 = mysqli_query($con, $sql2);
                            $row3 = mysqli_fetch_array($query2);
                        ?>

                            <tbody>
                                <tr>

                                    <td><?php echo $dataRow['id_cargo'] ?></td>
                                    <td><?php echo $dataRow['numero_control'] ?></td>
                                    <td><?php echo $row3['nombre'] ?></td>
                                    <td><?php echo $dataRow['cuatrimestre']; ?></td>
                                    <td><?php echo $row5['nombre']; ?></td>
                                    <td><?php echo $dataRow['status']; ?></td>
                                    <td><?php echo $dataRow['cantidad']; ?></td>
                                    <td><?php echo $dataRow['descuento']; ?></td>
                                    <td><?php echo $dataRow['total']; ?></td>
                                    <td><?php echo $dataRow['tipo_pago']; ?></td>
                                    <td><?php echo $dataRow['fecha']; ?> </td>
                                    <td><?php echo $dataRow['observaciones']; ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>

            </div>
        </div>
    </section>







    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="assets/js/material.min.js"></script>
    <script>
        $(function() {
            setTimeout(function() {
                $('body').addClass('loaded');
            }, 1000);


            //FILTRANDO REGISTROS
            $("#filtro").on("click", function(e) {
                e.preventDefault();

                loaderF(true);

                var f_ingreso = $('input[name=fecha_ingreso]').val();
                var f_fin = $('input[name=fechaFin]').val();
                console.log(f_ingreso + '' + f_fin);

                if (f_ingreso != "" && f_fin != "") {
                    $.post("filtro.php", {
                        f_ingreso,
                        f_fin
                    }, function(data) {
                        $("#tableEmpleados").hide();
                        $(".resultadoFiltro").html(data);
                        loaderF(false);
                    });
                } else {
                    $("#loaderFiltro").html('<p style="color:red;  font-weight:bold;">Debe seleccionar ambas fechas</p>');
                }
            });


            function loaderF(statusLoader) {
                console.log(statusLoader);
                if (statusLoader) {
                    $("#loaderFiltro").show();
                    $("#loaderFiltro").html('<img class="img-fluid" src="assets/img/cargando.svg" style="left:50%; right: 50%; width:50px;">');
                } else {
                    $("#loaderFiltro").hide();
                }
            }
        });
    </script>

</body>

</html>
<?php
//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die("no hay conexion " . mysqli_connect_error());
}


$fechai = $_POST['fecha_ingreso'];
$fechaf = $_POST['fechaFin'];

$sqlTrabajadores = ("SELECT * FROM tbl_cargo WHERE fecha BETWEEN '$fechai' AND '$fechaf' ORDER BY fecha ASC ");


$query = mysqli_query($con, $sqlTrabajadores);
$i = 1;


$html2 = '';

while ($dataRow = mysqli_fetch_array($query)) {
    //carrera
    $carrera = $dataRow['carrera'];
    $sql5 = "SELECT * FROM tbl_carrera WHERE id_carrera = '$carrera'";
    $query5 = mysqli_query($con, $sql5);
    $row5 = mysqli_fetch_array($query5);


    $html2 .=  '
    <tr>
     <td>' .  $dataRow['id_cargo'] . '</td>
        <td>' .  $dataRow['numero_control'] . '</td>
       <td>' .  $dataRow['cuatrimestre'] . '</td>
       <td>' .  $row5['nombre'] . '</td>
       <td>' .  $dataRow['status'] . '</td>
      <td>' .  $dataRow['cantidad'] . '</td>
     <td>' .  $dataRow['descuento'] . '</td>
      <td>' .  $dataRow['total'] . '</td>
      <td>' .  $dataRow['tipo_pago'] . '</td>
     <td>' . $dataRow['fecha'] . '</td>
     <td>' .  $dataRow['observaciones'] . '</td>
    </tr>' .
        $html5 = '';
}


//total

$tarjetas = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Tarjeta') AND (`fecha`BETWEEN '$fechai'AND '$fechaf')";
$resultado = mysqli_query($con, $tarjetas);
$row = mysqli_fetch_array($resultado);

$efectivo = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Efectivo') AND (`fecha`BETWEEN '$fechai'AND '$fechaf')";
$resultado = mysqli_query($con, $efectivo);
$row2 = mysqli_fetch_array($resultado);

$transferencia = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Transferencia') AND (`fecha`BETWEEN '$fechai'AND '$fechaf')";
$resultado = mysqli_query($con, $transferencia);
$row3 = mysqli_fetch_array($resultado);

$cheque = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Cheque') AND (`fecha`BETWEEN '$fechai'AND '$fechaf')";
$resultado = mysqli_query($con, $cheque);
$row4 = mysqli_fetch_array($resultado);



//imprimir
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

require_once('lib/dompdf/autoload.inc.php');

$html = '   
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
                

                <div class="col-md-12 text-center mt-5">
                    <span id="loaderFiltro"> </span>
                </div>


                <div class="table-responsive resultadoFiltro">
                    <table class="table table-hover" id="tableEmpleados">
                        <thead>
                        
                            <tr>


                                <th scope="col">Folio</th>
                                <th scope="col">Num. control</th>
                                <th scope="col">Cuatri</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Status</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Total</th>
                                <th scope="col">Tipo_pago</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Notas</th>
                            </tr>
                        </thead>
                        
                        <tbody> 

                     
                       ' .



    $html2 .


    '

    </tbody>
   


                        

                           
                          
                    </table>
                </div>

            </div>
        </div>
    </section>
    <div style=" display:flex;">
    <p>Efectivo:</p>
    <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ ' .  $row2[0] . '" required>
    <p>Taejeta:</p>
    <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$' .  $row[0] . '" required>
    <p>Transferencia:</p>
    <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ ' .  $row3[0] . '" required>
    <p->Cheque:</p->
    <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ ' .   $row4[0] . '" required>

</div>


            
 
</body></html>';



// echo $html;


$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->setPaper('a4', 'portrait');
$dompdf->stream("reporte'.pdf", array("Attachment" => false));

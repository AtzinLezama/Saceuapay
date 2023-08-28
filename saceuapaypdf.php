<?php
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

$sql = "SELECT * FROM tbl_cargo WHERE id_cargo = '$id'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$alu = $row['id_alumno'];
$sql2 = "SELECT * FROM tbl_alumno WHERE id_alumno = '$alu'";
$query2 = mysqli_query($conn, $sql2);
$row3 = mysqli_fetch_array($query2);


//carrera
$carrera = $row['carrera'];
$sql5 = "SELECT * FROM tbl_carrera WHERE id_carrera = '$carrera'";
$query5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($query5);

//concepto
$concepto = $row['id_conceptos'];
$sql6 = "SELECT * FROM tbl_concepto WHERE id_concepto = '$concepto'";
$query6 = mysqli_query($conn, $sql6);
$row6 = mysqli_fetch_array($query6);

//pago
$pago = $row['id_conceptos'];
$sql6 = "SELECT * FROM tbl_concepto WHERE id_concepto = '$pago'";
$query6 = mysqli_query($conn, $sql6);
$row6 = mysqli_fetch_array($query6);


//imprimir
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

require_once('lib/dompdf/autoload.inc.php');



$html =
    '<head>
   
    <meta charset="utf-8">
    <title>SACEUAPAY DATOS DEL ESTUDIANTE</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <style type="text/css">

    table , td, th {
        border: 1px solid #595959;
        border-collapse: collapse;
    }
    td, th {
        padding: 3px;
        width: 30px;
        height: 25px;
    }
    td{
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
    h2{
        text-align: right;
    }
    h1{
        text-align:center;
    }
    table{
        width: 90%;
        padding: 10px;
        margin: auto;
        margin-top: 20px;
    }
    .r{
        text-align: right;
    }

    body{
       
       margin: 0;
            
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
    }
</style>
    </header>

<body >


    <div class="forma"> <br><br>
        <form action="http://localhost/Saceuapay/updateSaceuapay.php" method="post" autocomplete="OFF">

            <fieldset class="uu">
                <br>
                <br>

                <img src="https://images.pexels.com/photos/7477753/pexels-photo-7477753.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                    
                <h1 >RECIBO DE PAGOS</h1>
                <h2>' . $row['fecha'] . ' </h2>
                <table>
                    <tbody>
                        <tr>
                            <th>FOLIO</th>
                            <td>' . $row['id_cargo'] . '</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                <tbody>
                   
                    <tr>
                        <th>NUM.CONTROL</th>
                        <td>' . $row['numero_control'] . '</td>
                        <th>NOMBRE </th>
                        <td>' . $row3['nombre'] . '</td>
                    </tr>
                    <tr>
                        <th>CUATRIMESTRE</th>
                        <td>' . $row['cuatrimestre'] . '</td>
                        <th>CARRERA</th>
                        <td>' . $row5['nombre'] . '</td>
                    </tr>
                </tbody>
            </table>
            <table>
            <tbody>
                <tr>
                    <th>VALIDO POR</th>
                    <td text-align: right;>' . $row6['nombre'] . '</td>
                    <th>STATUS</th>
                    <td>' . $row['status'] . '</td>
                </tr>
            </tbody>
        </table>
            
        <table >
        <tbody>
            <tr>
                <th colspan="2">POR LA CANTIDAD DE </th>
                <td colspan="2">' . $row['cantidad'] . '</td>
            </tr>
            <tr>
                <th colspan="2">DESCUENTO</th>
                <td colspan="2">' . $row['descuento'] . '%</td>
            </tr>
            <tr>
                <th></th>
                <th colspan="2">TOTAL</th>
                <td>' . $row['total'] . '</td>
            </tr>
        </tbody>
    </table>
    <table>
	<tbody>
		<tr>
			<th>TIPO DE PAGO</th>
			<td>' . $row['tipo_pago'] . '</td>
		</tr>
		<tr>
			<th>COMENTARIOS</th>
			<td>' . $row['observaciones'] . '</td>
		</tr>
	</tbody>
</table>
                
     
    </body></html>';

// echo $html;

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("recibo-cargo'- $row[1] '.pdf", array("Attachment" => false));

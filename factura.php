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


$date = $_POST['txtDate'];

//imprimir
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

require_once('lib/dompdf/autoload.inc.php');



$html =
    '<head>
    <link rel="stylesheet" type="text/css" href="styles/estiloPay.css" />
    <meta charset="utf-8">
    <title>SACEUAPAY DATOS DEL ESTUDIANTE</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    </header>

<body>
<body>


    <div class="forma"> <br><br>
        <form action="http://localhost/Saceuapay/updateSaceuapay.php" method="post" autocomplete="OFF">

            <fieldset class="uu">
                <br>
                <br>


                <h1 style="text-align:center;">CENTRO DE ESTUDIOS ARKOS A.C</h1>
                
                <h3 style="text-align:center;">Recibo de ventas por cliente</h3>
                <h3 style="text-align:center;">Del ' . $date . '</h3><br>
                <table class="fl-table">
                <thead>
                    <br><br>
                    <tr>
                        <th>Num.control</th>
                        <th>nombre</th>
                        <th>Periodo</th>
                        <th>Eliminar</th>


 
                    </tr>
                </thead>

                <tbody>





</tbody>
</table>





</body>

</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("factura.pdf", array("Attachment" => false));

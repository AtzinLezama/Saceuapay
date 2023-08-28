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


                <h1 >RECIBO DE PAGOS</h1>
               
                
     
    </body></html>';

// echo $html;

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("recibo-cargo'- $row[1] '.pdf", array("Attachment" => false));

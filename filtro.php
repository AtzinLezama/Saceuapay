<?php
sleep(1);
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";


$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$con) {
    die("no hay conexion " . mysqli_connect_error());
}

/**
 * Nota: Es recomendable guardar la fecha en formato año - mes y dia (2022-08-25)
 * No es tan importante que el tipo de fecha sea date, puede ser varchar
 * La funcion strtotime:sirve para cambiar el forma a una fecha,
 * esta espera que se proporcione una cadena que contenga un formato de fecha en Inglés US,
 * es decir año-mes-dia e intentará convertir ese formato a una fecha Unix dia - mes - año.
 */

$fechaInit = date("Y-m-d", strtotime($_POST['f_ingreso']));
$fechaFin  = date("Y-m-d", strtotime($_POST['f_fin']));

$sqlTrabajadores = ("SELECT * FROM tbl_cargo WHERE  `fecha` BETWEEN '$fechaInit' AND '$fechaFin' ORDER BY fecha ASC");
$query = mysqli_query($con, $sqlTrabajadores);
//print_r($sqlTrabajadores);
$total   = mysqli_num_rows($query);
echo '<strong>Total: </strong> (' . $total . ')';

//total
$tarjetas = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Tarjeta') AND (`fecha`BETWEEN '$fechaInit'AND '$fechaFin')";
$resultado = mysqli_query($con, $tarjetas);
$row = mysqli_fetch_array($resultado);

$efectivo = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Efectivo') AND (`fecha`BETWEEN '$fechaInit'AND '$fechaFin')";
$resultado = mysqli_query($con, $efectivo);
$row2 = mysqli_fetch_array($resultado);

$transferencia = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Transferencia') AND (`fecha`BETWEEN '$fechaInit'AND '$fechaFin')";
$resultado = mysqli_query($con, $transferencia);
$row3 = mysqli_fetch_array($resultado);

$cheque = "SELECT SUM(total) FROM tbl_cargo WHERE (tipo_pago = 'Cheque') AND (`fecha`BETWEEN '$fechaInit'AND '$fechaFin')";
$resultado = mysqli_query($con, $cheque);
$row4 = mysqli_fetch_array($resultado);
?>

<table class="table table-hover">
    <div style=" display:flex;">
        <h1 style="color: #fff; display:inline">Efectivo:</h1>
        <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row2[0] ?>" required>
        <h1 style="color: #fff; display:inline">Taejeta:</h1>
        <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row[0] ?>" required>
        <h1 style="color: #fff; display:inline">Transferencia:</h1>
        <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row3[0] ?>" required>
        <h1 style="color: #fff; display:inline">Cheque:</h1>
        <input style=" display:flex;" type="text" name="fecha_ingreso" class="form-control" value="$ <?php echo $row4[0] ?>" required>

    </div>

    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">numero control</th>
            <th scope="col">cuatrimestre</th>
            <th scope="col">carrera</th>
            <th scope="col">status</th>
            <th scope="col">cantidad</th>
            <th scope="col">descuento</th>
            <th scope="col">total</th>
            <th scope="col">tipo_pago</th>
            <th scope="col">fecha</th>
            <th scope="col">observaciones</th>
        </tr>
    </thead>
    <?php
    $i = 1;
    while ($dataRow = mysqli_fetch_array($query)) { ?>
        <tbody>
            <tr>

                <td><?php echo $dataRow['id_cargo'] ?></td>
                <td><?php echo $dataRow['numero_control'] ?></td>
                <td><?php echo $dataRow['cuatrimestre']; ?></td>
                <td><?php echo $dataRow['carrera']; ?></td>
                <td><?php echo $dataRow['status']; ?></td>
                <td><?php echo $dataRow['cantidad']; ?></td>
                <td><?php echo $dataRow['descuento']; ?></td>
                <td><?php echo $dataRow['total']; ?></td>
                <td><?php echo $dataRow['tipo_pago']; ?></td>
                <td><?php echo $dataRow['fecha']; ?></td>
                <td><?php echo $dataRow['observaciones']; ?></td>
            </tr>
        </tbody>
    <?php } ?>
</table>
<?php
//conexion bd
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "saceuapay";
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){
    die("no hay conexion ".mysqli_connect_error());
}



//declaracion de variables
$usuario = $_POST["txtUsuario"];
$password = $_POST["txtPassword"];
$tipo = $_POST["txtTipo"];




//validacion de usuario
$query = mysqli_query($conn,"SELECT id_usuario from tbl_usuario where login = '".$usuario."' and password = '".$password."' and tipo_usuario = ".$tipo);
$nc = mysqli_num_rows($query);
$nr = mysqli_fetch_array($query);   
 
if($nc == 1){

//logeo a cada tipo de usuario
    if($tipo == 1){
        echo "1";
        session_start();
        $_SESSION['id_usuario'] = $nr["id_usuario"];
        $_SESSION['usuario'] = $usuario;
          header("Location: ../menualumno.php");

    }

    else if ($tipo == 2){
        echo "2";
        session_start();
        $_SESSION['id_usuario'] = $nr["id_usuario"];
        $_SESSION['usuario'] = $usuario;
          header("Location: ../menuadmin.php");

    }
    else if ($tipo == 3){
        echo "3";
        session_start();
         $_SESSION['id_usuario'] = $nr["id_usuario"];
        $_SESSION['usuario'] = $usuario;
        header("Location: ../caja.php");
    }
    else if ($tipo == 4){
        echo "4";
        session_start();
         $_SESSION['id_usuario'] = $nr["id_usuario"];
        $_SESSION['usuario'] = $usuario;
        header("Location: ../cobranza.php");
    }
}

//usuario incorrecto
else if ($nr == 0){
    header("Location: ../incorrecto.html");
    echo"Usuario, Contraseña o Tipo de usuario incorrecto <br><a href='../loginadmin.html'>Volver</a>";
   
}
?> 
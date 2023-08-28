<!DOCTYPE html>
<html>
<head>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    
	<meta charset="utf-8">
    
	<title>Buscar</title>
    
	<style> 
table, th, td{
	border: 1px solid black;;
}
	</style>
	<link rel="stylesheet"  href="../styles/estiloBuscar.css">
	
	<meta name="viewport" content="width=device-width, user-scalable=no, inirial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	

</head>
<header>
   
<section>
<img src="../images/logoarkos.png" id="logo">

<nav>
<ul>


        <div class="submenu">
   <ul>
      <li><a href="#">Consultar o eliminar pago</a></li>
      <li><a href="#">Agregar Nuevo pago</a></li>
   </ul>
</div>
</li>

<li><a href="#">Registrar Alumno</a>
<div class="submenu">
   <ul>
      <li><a href="../readAlumno.php">Consultar o eliminar Alumno</a></li>
      <li><a href="../createAlumno.html">Agregar Alumno</a></li>
   </ul>
   <li><a href="../menuadmin.php">Regresar</a></li>
</div>

</li>
</ul>
</nav>
</section>
</header>


<body>

</fieldset>
<h1 align="center" style="color:#ffffff";>Nvo.Ingreso Contaduria</h1>

<div class="table-wrapper">
<form action="" method="post" style="text-align: center; ">
                        <img src = "../images/buscar.png"  width="50" height="50" />
                        <label for="campo" style="color:#FFFFFF"; >Buscar: </label>
                        <input type="text" name="campo" id="campo">
                    </form>

    <table class="fl-table">
        <thead>
            <br><br>
        <tr>
            <th>Numero de control</th>
           
            <th>Nombre</th>
            <th>Beca</th>
            <th>Inscripcion</th>
            <th>Sep</th>
            <th>Oct</th>
            <th>Nov</th>
            <th>Dic</th>
            <th>Comentarios</th>
            <th>Estado</th>
            <th>Saldo</th>  
            
        </tr>
        </thead>

        <tbody id="content">

        </tbody>
    </table>

</div>
						
                 
                      
                  
</form> 
<script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", getData)

        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let content = document.getElementById("content")
            let url = "loadAlumno.php"
            let formaData = new FormData()
            formaData.append('campo', input)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data
                }).catch(err => console.log(err))
        }
    </script>

    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
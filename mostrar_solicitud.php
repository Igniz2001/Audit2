<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>AuditUdem Solicitar</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
    /* Modify the background color */
     
    .navbar-custom {
        background-color: rgb(30, 32, 30);
    }
    /* Modify brand and text color */
     
    .navbar-custom .navbar-brand,
    .navbar-custom .navbar-text {
        color: rgb(255, 255, 255);
    }

</style>
</head>
<body>
<center>
<nav class="navbar navbar-custom">
        <a href="index.html"><img src="resources/logo_udemedellin2.png" width="190" height="50"></a>
      </nav>
  <h3>Solicitud Enviada</h3>
  <?php
  // Obtener el número de solicitud del parámetro en la URL
  $numero_solicitud = $_GET["numero_solicitud"];

  // Mostrar el número de solicitud al usuario
  echo '<h2>Su número de radicado es: ' . $numero_solicitud . '</h2>';
  ?>

  <!-- Botón para continuar al menú principal (index.html) -->
  <a href="index.html"><button class ="btn" style="background-color: #399fa7; color: aliceblue; margin:auto;display:block">Continuar</button></a>
</center>
</body>
</html>

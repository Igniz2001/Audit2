<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AuditUdem Consultar</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
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

    <br />
    <center>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener el número de radicado enviado desde el formulario
            $radicado = $_POST["radicado"];

            // Establecer la conexión a la base de datos (reemplaza los datos de conexión con los tuyos)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "auditudem_db";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }

            // Realizar la consulta en la base de datos para obtener la solicitud con el número de radicado
            $sql = "SELECT * FROM solicitudes WHERE numero_solicitud = '$radicado'";

            // Ejecutar la consulta
            $resultado = $conn->query($sql);

            // Verificar si se encontraron resultados
            if ($resultado->num_rows > 0) {
                // Mostrar la tabla con los datos de la solicitud
                echo '<table>
                        <tr>
                            <th>Numero de radicado</th>
                            <th>Fecha</th>
                            <th>Categoría</th>
                            <th>Tipo de persona</th>
                            <th>Razón</th>
                            <th>Estado</th>
                            <th>Solución</th>
                        </tr>';

                // Recorrer los resultados y mostrarlos en la tabla
                while ($fila = $resultado->fetch_assoc()) {
                    echo '<tr>
                            <td>' . $fila["numero_solicitud"] . '</td>
                            <td>' . $fila["fecha"] . '</td>
                            <td>' . $fila["categoria"] . '</td>
                            <td>' . $fila["tipo_persona"] . '</td>
                            <td>' . $fila["detalle_caso"] . '</td>
                            <td>' . $fila["estado"] . '</td>
                            <td>' . $fila["solucion"] . '</td>
                        </tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No se encontró ninguna solicitud con el número de radicado proporcionado.</p>';
            }

            // Cerrar la conexión a la base de datos
            $conn->close();
        }
        ?>
    </center>
</body>

</html>


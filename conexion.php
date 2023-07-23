<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auditudem_db";

// Establecer la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $categoria = $_POST["categoria"];
    $tipo_persona = $_POST["tipo_persona"];
    $detalle_caso = $_POST["detalle_caso"];

    // Generar el código de solicitud
    $numero_solicitud = generarCodigo();

    // Verificar si se ha cargado un archivo
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Se ha cargado un archivo
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

        // Ruta de destino para el archivo adjunto
        $upload_dir = 'uploads/';
        $file_path = $upload_dir . $file_name;

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Archivo movido correctamente
            $sql = "INSERT INTO solicitudes (categoria, tipo_persona, detalle_caso, archivo_adjunto, numero_solicitud) VALUES ('$categoria', '$tipo_persona', '$detalle_caso', '$file_path', '$numero_solicitud')";

            if ($conn->query($sql) === TRUE) {
                // Redireccionar al usuario a la página de mostrar_solicitud.php con el número de solicitud como parámetro
                header("Location: mostrar_solicitud.php?numero_solicitud=" . $numero_solicitud);
                exit; // Finalizar el script para evitar que se siga ejecutando el resto del código
            } else {
                echo "Error al guardar la solicitud: " . $conn->error;
            }
        } else {
            echo "Error al mover el archivo adjunto";
        }
    } else {
        // No se ha cargado ningún archivo
        $sql = "INSERT INTO solicitudes (categoria, tipo_persona, detalle_caso, numero_solicitud) VALUES ('$categoria', '$tipo_persona', '$detalle_caso', '$numero_solicitud')";

        if ($conn->query($sql) === TRUE) {
            // Redireccionar al usuario a la página de mostrar_solicitud.php con el número de solicitud como parámetro
            header("Location: mostrar_solicitud.php?numero_solicitud=" . $numero_solicitud);
            exit; // Finalizar el script para evitar que se siga ejecutando el resto del código
        } else {
            echo "Error al guardar la solicitud: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();

// Función para generar el código de solicitud
function generarCodigo() {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 8;
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}
?>

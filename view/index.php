<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project 2</title>
    <!-- Agrega los enlaces a los archivos de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <?php
        require_once('../controller/controller.php');
        

        $API_URL = "https://api-inference.huggingface.co/models/microsoft/git-large-coco";
        $token = ""; // Tu token de autorización
    ?>
    <div class="container">
        <h1 class="mb-4">Cargar y Mostrar Imagen</h1>
        <!-- Formulario para cargar la imagen -->
        <form enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="imagen" class="form-label">Selecciona una imagen:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            </div>
            <?php
        if ($_FILES && isset($_FILES['imagen'])) {
            $imagen = $_FILES['imagen'];
            $imagen_tmp = $imagen['tmp_name'];
            $nombre_imagen = $imagen['name'];
            $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
            $carpeta_destino = './img_temp/'; 
            $nombre_unico = uniqid('imagen_') . '.' . $extension;
            $ruta_imagen_nueva = $carpeta_destino . $nombre_unico;
            $imagenes_previas = glob($carpeta_destino . 'imagen_*.*');
            foreach ($imagenes_previas as $imagen_previa) {
                if ($imagen_previa !== $ruta_imagen_nueva) {
                    unlink($imagen_previa);
                }
            }            
            if (move_uploaded_file($imagen_tmp, $carpeta_destino . $nombre_unico)) {
                echo '<div class="imagen-container">';
                echo '<h2 class="mt-4">Imagen Cargada:</h2>';
                echo '<img src="' . $carpeta_destino . $nombre_unico . '" class="img-fluid" alt="Imagen Cargada">';
                echo '</div>';
            } else {
                echo '<p class="text-danger">Hubo un error al subir la imagen.</p>';
            }
                    // Obtiene la lista de archivos en la carpeta después de subir una nueva imagen
            $archivos = glob($carpeta_destino . 'imagen_*.*');
        
            foreach ($archivos as $archivo) {
                // echo "<h2>Texto extraído de $archivo:</h2>";
                imageToText($API_URL, $token, $archivo);
            }
        }

        ?>
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Subir Imagen</button>
            </div>
        </form>
        <!-- Procesar la imagen cargada -->
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

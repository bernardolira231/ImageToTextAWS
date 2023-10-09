Gilberto Hernández Quintero  --  Modelo<br>
Guillermo González González  --  Conexión al API (Controlador)<br>
Eric Garibo García  --  Implementación del sitio web en la Instancia EC2<br>
Bernardo Lira Ramírez de Aguilar  --  Vista<br>

# Project 2 - Procesamiento de Imágenes y Texto

Este proyecto permite cargar imágenes, analizar lo que se muestra en la imagen utilizando el modelo de lenguaje GIT (GenerativeImage2Text) de Hugging Face y mostrar los resultados en una interfaz web.

## Requisitos

- PHP 7.0 o superior
- Servidor web (por ejemplo, Apache)
- Token de autorización de Hugging Face para usar el modelo GIT

## Configuración

1. Clona este repositorio o descarga los archivos en tu servidor web local.

2. Abre el archivo `index.php` en tu editor de código.

3. Actualiza las siguientes variables con tus propios valores:
   - `$API_URL`: La URL del modelo de lenguaje de Hugging Face que deseas utilizar.
   - `$token`: Tu token de autorización de Hugging Face para acceder al modelo.

4. Configura la carpeta de imágenes en la que deseas almacenar las imágenes cargadas. Por defecto, se utiliza la carpeta `img_temp/`. Asegúrate de que esta carpeta tenga permisos de escritura.

## Uso

1. Ejecuta tu servidor web local.

2. Accede a la aplicación a través de un navegador web visitando la URL del servidor.

3. En la página principal, puedes cargar una imagen haciendo clic en "Selecciona una imagen". La aplicación subirá la imagen y mostrará el texto extraído utilizando el modelo GIT.

4. Si deseas procesar varias imágenes, simplemente carga más imágenes una tras otra.

## Estructura de archivos

- `index.php`: Página principal de la aplicación que muestra el formulario de carga de imágenes y el resultado de la extracción de texto.
- `functions.php`: Archivo que contiene la función `imageToText` para procesar las imágenes y extraer el texto.
- `css/style.css`: Archivo CSS para estilizar la interfaz web.

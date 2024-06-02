<?php
session_start();
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] != 2) {
  header("Location: ../../index.php");
}
function mostrarFoto()
{
  $directorio = "../img/imgs-usuarios";
  $carpeta = scandir($directorio);
  $jpgUsuario = $_SESSION["nick"] . ".jpg";
  $dir = (in_array($jpgUsuario,  $carpeta)) ? $directorio . "/" . $jpgUsuario : $directorio . "/default.webp";
  return $dir;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoraStream-Admin</title>
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/cabecera.css">
  <link rel="stylesheet" href="../css/PagAdmin.css">
  <link rel="stylesheet" href="../css/Index.css">
</head>

<body class="d-flex flex-column justify-content-center body">
  <header class="d-flex  flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <div class=" ms-2 mb-2 mb-md-0 d-flex justify-content-center align-items-center headerIzq">
      <a href="../../Index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
        <img src="../img/LogoSoraStream3.png" width="200px" alt="">
      </a>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <!-- <li><a href="#" class="px-2 BotonHeader">Home</a></li> -->
        <li><a href="./cuenta.php" class="px-2 BotonHeader">Tu lista</a></li>
        <li><a href="../../categorias.php" class="px-2 BotonHeader">Categorias</a></li>
        <?php
        if (isset($_SESSION["rol"])) {
          if ($_SESSION["rol"] == 2) {
            echo "<li><a href='./PagAdmin.php' class='px-2 BotonHeader'>Administradores</a></li>";
          }
        }
        ?>

      </ul>
    </div>
    <div class="d-flex align-items-center">
      <?php
      if (!isset($_SESSION["id"])) {
        echo '  <div class="me-2 text-end d-flex">
        <a href ="./Login.php" class="BotonHeader font-sm bold auth-link">Registrarse</a>
        <a href="./Login.php" class="BotonInicioRegistro font-sm bold auth-link">Iniciar sesión</a>
      </div>';
      } else {
        echo '<div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">
          <img src="' . mostrarFoto() . '" width="200px" class="dropbtn" alt="">
        </button>
        <div id="myDropdown" class="dropdown-content">
          <a href="./cuenta.php">Configuración de la cuenta</a>
          <a href="./logout.php">Cerrar sesión</a>
        </div>
      </div>
      ';
      }
      ?>

    </div>
  </header>
  <div class="contenedorFormularios">
    <div class=" ContenedorColor p-5 mr-2 d-flex align-items-center flex-column justify-content-center">
      <div class="pestañas">
        <div class="pestaña " id="animePestaña" onclick="mostrarPestaña('anime')">Crear Anime</div>
        <div class="pestaña activa" id="capituloPestaña" onclick="mostrarPestaña('capitulo')">Crear Capítulo</div>
      </div>
      <div id="anime" class="content  form-container">
        <h2 class="text-light">Crear Anime</h2>
        <form class="formularios" method="post" enctype="multipart/form-data">
          <input type="text" class="izquierda" name="titulo" placeholder="Título" required>
          <input type="text" class="izquierda categoria" name="categoria" placeholder="Categoría" required>
          <label for="imagen_horizontal">Imagen Horizontal</label>
          <input type="file" name="imagen_horizontal" class="form-control" id="imagen_horizontal" hidden>
          <label for="imagen_vertical">Imagen Vertical</label>
          <input type="file" name="imagen_vertical" class="form-control" id="imagen_vertical" hidden>
          <textarea name="Descripción" class="textAreaDescripcion" placeholder="Descripción" required></textarea>
          <button type="submit" value="CrearAnime" class="mb-4 botonEnviar" name="CrearAnime">Guardar Anime</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['CrearAnime'])) {
          if ((isset($_FILES["imagen_horizontal"]) && isset($_FILES["imagen_vertical"])) && ($_FILES["imagen_horizontal"]["size"] > 0 || $_FILES["imagen_vertical"]["size"] > 0)) {
            include "./db.php";

            // Recoger los datos del formulario
            $titulo = htmlspecialchars($_POST["titulo"]);
            $descripcion = htmlspecialchars($_POST["Descripción"]);
            $categoria = htmlspecialchars($_POST["categoria"]);

            // Preparar y ejecutar la consulta
            $animeNew = $db->prepare("INSERT INTO animes (Titulo, Descripcion, Categoria) VALUES (:titulo, :descripcion, :categoria)");
            $animeNew->bindParam(":titulo", $titulo);
            $animeNew->bindParam(":descripcion", $descripcion);
            $animeNew->bindParam(":categoria", $categoria);
            $animeNew->execute();


            $idAnimeNew = $db->lastInsertId();
            $imagenHorizontal = $_FILES["imagen_horizontal"]["tmp_name"];
            $imagenVertical = $_FILES["imagen_vertical"]["tmp_name"];

            // Guardar las imágenes en la carpeta de imágenes
            move_uploaded_file($imagenHorizontal, "../img/ids_categoria/" . $idAnimeNew . ".png");
            move_uploaded_file($imagenVertical, "../img/ids/" . $idAnimeNew . ".png");

            echo "<strong class='w-100 d-flex justify-content-center textoCreacion error-crear-anime'>Anime creado</strong>";
          } else {
            echo "<strong class='w-100 d-flex justify-content-center text-danger textoCreacion error-crear-anime'>Completa todos los campos</strong>";
          }
        }
        ?>
      </div>

      <div id="capitulo" class="content form-container activa">
        <h2 class="text-light">Crear Capítulo</h2>
        <form class="formularios formularioCapitulo" method="post" enctype="multipart/form-data">
          <input type="number" placeholder="Temporada" name="Temporada" required>
          <input type="number" class="izquierda" name="NumeroEpisodio" placeholder="Número de Episodio" required>
          <input type="number" class="izquierda" name="Duracion" placeholder="Duración (minutos)" required>
          <input type="number" name="IDAnime" placeholder="ID del Anime" required>
          <input type="text" class="TituloEpisodio" name="TituloEpisodio" placeholder="Título del Episodio" required>
          <label for="video">Video</label>
          <input type="file" name="video" class="form-control" id="video" hidden>
          <button type="submit" name="CrearCapitulo" class="mb-4 botonEnviar" value="CrearCapitulo">Guardar Capítulo</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['CrearCapitulo'])) {
          if ((isset($_FILES["video"]) && $_FILES["video"]["size"] > 0)) {
            include "./db.php";
            // Recoger los datos del formulario
            $numeroEpisodio = htmlspecialchars($_POST["NumeroEpisodio"]);
            $duracion = htmlspecialchars($_POST["Duracion"]);
            $idAnime = htmlspecialchars($_POST["IDAnime"]);
            $temporada = htmlspecialchars($_POST["Temporada"]);
            $tituloEpisodio = htmlspecialchars($_POST["TituloEpisodio"]);

            //consultar si existe el IDanime en la tabla de animes
            $consultaAnime = $db->prepare("SELECT * FROM animes WHERE ID = :idAnime");
            $consultaAnime->bindParam(":idAnime", $idAnime);
            $consultaAnime->execute();
            $resultadoAnime = $consultaAnime->fetch();

            if ($resultadoAnime == null) {
              echo "<strong class='w-100 d-flex justify-content-center text-warning'>No se ha encontrado el anime con el ID " . $idAnime . "</strong>";
            } else {
              $idAnimeStmt = $db->prepare("INSERT INTO capitulos (Num_Episodio, Titulo, Temporada, Duracion, ID_Anime, Fecha_publicacion) VALUES (:numeroEpisodio, :tituloEpisodio, :temporada, :duracion, :idAnime, :Fecha_publicacion)");
              $idAnimeStmt->bindParam(":numeroEpisodio", $numeroEpisodio);
              $idAnimeStmt->bindParam(":tituloEpisodio", $tituloEpisodio);
              $idAnimeStmt->bindParam(":temporada", $temporada);
              $idAnimeStmt->bindParam(":duracion", $duracion);
              $idAnimeStmt->bindParam(":idAnime", $idAnime);
              $idAnimeStmt->bindParam(":Fecha_publicacion", date("Y-m-d"));
              $idAnimeStmt->execute();

              $idCapituloNew = $db->lastInsertId();
              $video = $_FILES["viedo"]["tmp_name"];

              // Guardar las videos en la carpeta de videos
              move_uploaded_file($imagenHorizontal, "../img/ids-categoria/" . $idAnime . "-" . $temporada . "-" . $idCapituloNew . ".mp4");

              echo "<strong class='w-100 d-flex justify-content-center textoCreacion'>Capítulo creado</strong>";
            }
          } else {
            echo "<strong class='w-100 d-flex justify-content-center text-danger textoCreacion error-crear-capitulo'>Completa todos los campos</strong>";
          }
        }
        ?>
      </div>
    </div>
  </div>
  <script src="../js/PagAdmin.js"></script>
  <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
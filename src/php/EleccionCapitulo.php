<?php
session_start();
function AnimeReproductor($id)
{
  include "./db.php";
  $animes = "SELECT * from animes where ID = $id";
  $animeq = $db->query($animes);
  return $animeq;
}
function filtroEpisodios($idAnime, $temporadaActiva = 1)
{
  include "./db.php";
  $episodios = "SELECT * from capitulos where ID_Anime = $idAnime and Temporada = $temporadaActiva";
  $episodiosq = $db->query($episodios);
  return $episodiosq;
}
function filtroTemporadas($id)
{
  include "./db.php";
  $capitulos = "SELECT DISTINCT Temporada from capitulos where ID_anime = $id";
  $capitulosq = $db->query($capitulos);
  return $capitulosq;
}
$id = $_GET["id"];
if (isset($_GET["temporada"])) {
  $temporadaActiva = $_GET["temporada"];
  $episodiosq = filtroEpisodios($id, $temporadaActiva);
} else {
  $episodiosq = filtroEpisodios($id);
}
$animeq = AnimeReproductor($id);
$temporadaq = filtroTemporadas($id);
if (isset($_POST["temporadaEleccion"])) {
  $_SESSION["temporadaActiva"] = $_POST["temporadaEleccion"];
} else {
  $_SESSION["temporadaActiva"] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SoraSttream</title>
  <link rel="stylesheet" href="../css/cabecera.css">
  <link rel="stylesheet" href="../css/Portada.css
  <!-- Uso de librerias -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/EleccionCapitulo.css">
</head>

<body class="body d-flex flex-column justify-content-center">
  <header class="d-flex  flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
    <div class=" ms-2 mb-2 mb-md-0 d-flex justify-content-center align-items-center headerIzq">
      <a href="../../Index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
        <img src="../../src/img/LogoSoraStream3.png" width="200px" alt="">
      </a>
      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <!-- <li><a href="#" class="px-2 BotonHeader">Home</a></li> -->
        <li><a href="#" class="px-2 BotonHeader">Tu lista</a></li>
        <li><a href="../../categorias.php" class="px-2 BotonHeader">Categorias</a></li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
      <div class="buscador-container me-3">
        <input type="text" placeholder="Buscar...">
        <button class="buscador" type="submit">Buscar</button>
      </div>
      <?php


      if (!isset($_SESSION["id"])) {
        echo '  <div class="me-2 text-end d-flex">
                  <a href="./Login.php" class="BotonHeader font-sm bold auth-link">Registrarse</a>
                  <a href="./Login.php" class="BotonInicioRegistro font-sm bold auth-link">Iniciar sesión</a>
                </div>';
      } else {
        echo '<div class="dropdown">
                  <button onclick="myFunction()" class="dropbtn">Logout</button>
                  <div id="myDropdown" class="dropdown-content">
                    <a href="./cuenta.php">Configuración de la cuenta</a>
                    <a href="#">Cerrar sesión</a>
                  </div>
                </div>
                ';
      }
      ?>
    </div>
  </header>
  <section class="d-flex justify-content-center portadaReproductor">
    <?php
    echo "<img src='../../src/img/ids_categoria/" . $id . ".png' alt='' class='imagenFondoPortada'>"
    ?>
    <div>
      <?php
      echo "<img src='../../src/img/ids_categoria/" . $id . ".png' alt=''>"
      ?>
    </div>
  </section>
  <main class="container mb-4">
    <h1 class="TituloAnimeRepro">Dragon Ball Z</h1>
    <section class="ListaEpisodiosBody">
      <div class="d-flex justify-content-between">
        <h4 class="ms-4 mb-4">Episodios</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id&temporada=" . $_SESSION["temporadaActiva"] ?>" method="post">
          <select onchange='this.form.submit()' name="temporadaEleccion" class="desplegableTemporada form-select">
            <?php
            foreach ($temporadaq as $temporada) {
              if (isset($_GET["temporada"])) {
                if ($temporada["Temporada"] == $_GET["temporada"]) {
                  echo " <option selected value=" . $temporada["Temporada"] . ">Temporada " . $temporada["Temporada"] . "</option>";
                } else {
                  echo " <option value=" . $temporada["Temporada"] . ">Temporada " . $temporada["Temporada"] . "</option>";
                }
              } else {
                echo " <option value=" . $temporada["Temporada"] . ">Temporada " . $temporada["Temporada"] . "</option>";
              }
            }
            ?>
          </select>
        </form>
      </div>
      <div class="ListaEpisodios">
        <?php
        foreach ($episodiosq as $episodio) {
          echo " 
          <div  onclick='reproducirVideo(". $episodio['ID_Anime'].", ". $episodio['Temporada'].", ". $episodio['Num_Episodio'].")' class='Episodio d-flex w-100 justify-content-beetwen'>
          <img src='../img/ids_categoria/2.png' alt=''>
          <div class='d-flex flex-column w-100 justify-content-center ms-4'>
            <h5>Capitulo" . $episodio["Num_Episodio"] . "</h5>
            <p>" . $episodio["Titulo"] . "</p>
          </div>
          <div class='CajaBotonEpisodio'>
            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className=' botonEpisodio w-6 h-6'>
              <path strokeLinecap='round' strokeLinejoin='round' d='M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z' />
            </svg>
          </div>
        </div>";
        }
        ?>
      </div>
    </section>
  </main>
  <footer>
    <div class="container mt-5">
      <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img src="./src/img/LogoSoraStream3.png" style="width: 100px;" alt="">
          </a>
          <span class="mb-3 mb-md-0  text-light ">© 2024 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
              </svg></use></svg></a></li>
          <li class="ms-3"><a class="text-body-light" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
              </svg>
              <use xlink:href="#instagram"></use></svg>
            </a></li>
          <li class="ms-3"><a class="text-body-light" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
              </svg>
              <use xlink:href="#facebook"></use></svg>
            </a></li>
        </ul>
      </div>
    </div>
  </footer>
  <script>
    function reproducirVideo(anime, temporada, capitulo){
      fetch("AñadirHistorial.php", {
        method: "POST",
        body: anime,
      });     
      location.href ="./reproductorEpisodio.php?src=../img/Episodios/"+anime+"-"+temporada+"-"+capitulo+".mp4";
    }
</script>
</body>

</html>
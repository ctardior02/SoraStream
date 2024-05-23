<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoraStream-Admin</title>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/PagAdmin.css">
</head>

<body class="d-flex flex-column justify-content-center body">
    <header class="d-flex  flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
        <div class=" ms-2 mb-2 mb-md-0 d-flex justify-content-center align-items-center">
            <a href="../..//Index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../../src/img/LogoSoraStream3.png" width="200px" alt="">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <!-- <li><a href="#" class="px-2 BotonHeader">Home</a></li> -->
                <li><a href="#" class="px-2 BotonHeader">Tu lista</a></li>
                <li><a href="./categorias.php" class="px-2 BotonHeader">Categorias</a></li>
            </ul>
        </div>
        <div class="d-flex align-items-center">
            <?php


            if (!isset($_SEñSSION["id"])) {
                echo '  <div class="me-2 text-end d-flex">
              <a href ="./src/php/register.php" class="BotonHeader font-sm bold auth-link">Registrarse</a>
              <a href="./src/php/register.php" class="BotonInicioRegistro font-sm bold auth-link">Iniciar sesión</a>
            </div>';
            } else {
                echo '<div class="dropdown">
              <button onclick="myFunction()" class="dropbtn">Logout</button>
              <div id="myDropdown" class="dropdown-content">
                <a href="./src/php/cuenta.php">Configuración de la cuenta</a>
                <a href="#">Cerrar sesión</a>
              </div>
            </div>
            ';
            }

            ?>

        </div>
    </header>
    <div class="contenedorFormularios">
    <div class="pestañas">
            <div class="pestaña activa" id="animePestaña" onclick="mostrarPestaña('anime')">Crear Anime</div>
            <div class="pestaña" onclick="mostrarPestaña('capitulo')">Crear Capítulo</div>
        </div>
        <div id="anime" class="content activa form-container">
            <h2 class="text-light">Crear Anime</h2>
            <form class="formularios">
                <input type="text" class="izquierda" placeholder="Título" required>
                <input type="text" placeholder="Descripción" required>
                <input type="text" class="izquierda" placeholder="Categoría" required>
                <button type="submit">Guardar Anime</button>
            </form>
        </div>
        <div id="capitulo" class="content form-container">
            <h2  class="text-light">Crear Capítulo</h2>
            <form class="formularios">
                <input type="text" class="izquierda" placeholder="Título del Episodio" required>
                <input type="number" placeholder="Temporada" required>
                <input type="number" class="izquierda" placeholder="Número de Episodio" required>
                <input type="url" placeholder="URL" required>
                <input type="number" class="izquierda" placeholder="Duración (minutos)" required>
                <input type="number" placeholder="ID del Anime" required>
                <button type="submit">Guardar Capítulo</button>
            </form>
        </div>
    </div>
    <script src="../js/PagAdmin.js"></script>
</body>

</html>
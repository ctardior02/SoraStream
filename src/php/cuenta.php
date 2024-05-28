<?php
    session_start();
    include "./db.php";
    if(!isset($_SESSION["id"])){
        header("Location: ../../index.php");
    }

    $id = $_SESSION["id"];
    $nick = $_SESSION["nick"];
    $nombre = $_SESSION["nombre"];
    $correo = $_SESSION["email"];
    $password = $_SESSION["password"];
    $rol = $_SESSION["rol"];
    $tc = $_SESSION["tc"];
    $metodo = htmlspecialchars($_SERVER["PHP_SELF"]);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recogida de los datos del formulario
        if(isset($_FILES["foto"])){
            $_FILES["foto"]["name"] = $_SESSION["nick"] .".jpg";
            $res = move_uploaded_file($_FILES["foto"]["tmp_name"], "../img/imgs-usuarios/".$_FILES["foto"]["name"]);
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else if (isset($_POST["nick"]) && isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["password"])) {
            if(!isset($_POST["card-number"]) || $_POST["card-number"] === "" || $_POST["card-number"] === null){
                $mtc = null;
            } else {
                $mtc = $_POST["card-number"];
            }
            $_SESSION["tc"] = $mtc;
            $modificacion = $db->prepare("UPDATE usuarios SET Nombre = :nombre, Nick = :nick, Email= :email, Password = :password, Tarjeta_Credito = :tc WHERE ID = :id");
            $modificacion->bindParam(":id", $_SESSION["id"]);
            $modificacion->bindParam(":nick", $_POST["nick"]);
            $modificacion->bindParam(":nombre", $_POST["nombre"]);
            $modificacion->bindParam(":email", $_POST["correo"]);
            $modificacion->bindParam(":password", $_POST["password"]);
            $modificacion->bindParam(":tc", $mtc);
            $modificacion->execute();
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else if (isset($_POST["id_fav"])) {
            $eliminarFav = $db->prepare("DELETE FROM favoritos WHERE ID = :id");
            $eliminarFav->bindParam(":id", $_POST["id_fav"]);
            $eliminarFav->execute();
            header("Location: {$_SERVER['PHP_SELF']}");
        } else if (isset($_POST["id_hist"])) {
            $eliminarHist = $db->prepare("DELETE FROM historial WHERE ID = :id");
            $eliminarHist->bindParam(":id", $_POST["id_hist"]);
            $eliminarHist->execute();
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else if (isset($_POST["usu_premium"])) {
            if ($_SESSION["tc"] !== null && $_SESSION["tc"] !== "") {
                $_SESSION["rol"] = 1;
                $mesaje3 = "";
                $usu_premium = $db->prepare("UPDATE usuarios SET rol = 1 WHERE ID = :id");
                $usu_premium->bindParam(":id", $_POST["usu_premium"]);
                $usu_premium->execute();
                header("Location: {$_SERVER['PHP_SELF']}");
                exit();
            } else {
                $mesaje3 = "Debes tener una tarjeta de credito para poder hacer la compra de premium";
            }
        }
    } 

    $fav = $db->prepare("SELECT * FROM favoritos WHERE ID_Usuario = :id_usuario");
    $fav->bindParam(":id_usuario", $_SESSION["id"]);
    $fav->execute();

    $hist = $db->prepare("SELECT * FROM historial WHERE usuario = :id_usuario ORDER BY Fecha DESC");
    $hist->bindParam(":id_usuario", $_SESSION["id"]);
    $hist->execute();

    function mostrarFoto(){
        $directorio = "../img/imgs-usuarios"; 
        $carpeta = scandir($directorio);
        $jpgUsuario = $_SESSION["nick"]. ".jpg";
        $dir = (in_array($jpgUsuario,  $carpeta)) ? $directorio."/". $jpgUsuario : $directorio. "/default.webp";
        return $dir;
    }

    $imagen = mostrarFoto();
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cabecera.css">
    <link rel="stylesheet" href="../css/cuenta.css">
    <title>Cuenta</title>
</head>
<body class="">
    <header class="d-flex  flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
        <div class="izq ms-2 mb-2 mb-md-0 d-flex justify-content-center align-items-center">
            <a href="../../Index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../img/LogoSoraStream3.png" width="200px" alt="">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="px-2 BotonHeader">Tu lista</a></li>
                <li><a href="../../categorias.php" class="px-2 BotonHeader">Categorias</a></li>
            </ul>
        </div>
        <div class="drec drop d-flex align-items-center">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">
                    <img src="<?php echo mostrarFoto(); ?>" width="200px" class="dropbtn" alt="">
                </button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="./src/php/cuenta.php">Configuración de la cuenta</a>
                    <a href="./src/php/logout.php">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="info_cuenta">
            <h1><?php echo $nick; ?></h1>
            <div class="imagen">
                <img src="<?php echo $imagen ?>" alt="">
            </div>
            <div class="botones">
                <form action="" method="post">
                    <label for="editar">Editar Cuenta</label>
                    <input type="checkbox" name="editar" id="editar" hidden>
                    <div class="editar_cuenta">
                        <label for="editar" class="icono_quitar">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="cerrar">
                                <path fill="#4b70e2" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                            </svg>
                        </label>
                        <form action="<?php echo $metodo;?>" method="post">
                            <div>
                                <label class="label_campo" for="nick">Nick:</label>
                                <input type="text" name="nick" class="campo" id="nick" value="<?php echo $_SESSION["nick"]; ?>" >
                                <div class="error oculto">Este campo no puede tener los caracteres: ()[]{}/\</div>
                            </div>
                            <div>
                                <label class="label_campo" for="nombre">Nombre Completo:</label>
                                <input type="text" name="nombre" class="campo" id="nombre" value="<?php echo $_SESSION["nombre"]; ?>">
                                <div class="error oculto">Este campo no puede tener los caracteres: ()[]{}/\</div>
                            </div>
                            <div>
                                <label class="label_campo" for="correo">Correo:</label>
                                <input type="text" name="correo" class="campo" id="correo" value="<?php echo $_SESSION["email"]; ?>">
                                <div class="error oculto">Este campo no puede tener los caracteres: ()[]{}/\</div>
                            </div>
                            <div>
                                <label class="label_campo" for="password">Contraseña:</label>
                                <input type="text" name="password" class="campo" id="password" value="<?php echo $_SESSION["password"]; ?>">
                                <div class="error oculto">Este campo no puede tener los caracteres: ()[]{}/\</div>
                            </div>
                            <div>
                                <label class="label_campo" for="card-number">Tarjeta de Credito:</label>
                                <input type="number" name="card-number" class="campo" id="card-number" placeholder="XXXXXXXXXXXXXXXX" value="<?php echo $_SESSION["tc"]; ?>">
                                <div class="error oculto">Este campo no puede tener menos de 14 y más de 19 caracteres</div>
                            </div>
                            <div class="solo">
                                <input type="submit" class="editar" value="Editar">
                            </div>                     
                        </form>
                    </div>
                </form>
                <a href="./logout.php">Cerrar Sesion</a>
                <a href="./deleteSesion.php">Borrar Cuenta</a>
                <form action="<?php echo $metodo; ?>" method="post" enctype="multipart/form-data">
                    <label for="foto">Cambiar foto</label>
                    <input type="file" name="foto" onchange="this.form.submit()" id="foto" hidden>
                </form>
            </div>
            <?php

                if($rol == 0){
                    echo "
                        <form action='$metodo' method='post'>
                            <input type='hidden' name='usu_premium' value='$id'>
                            <input type='submit' class='rol p__premium' value='Hazte Premium'>
                        </form>
                    ";
                } else if ($rol == 1) {
                    echo "
                        <div class='rol p__premium-ten'>Eres premium</div>
                    ";
                } else if ($rol == 2) {
                    echo "
                        <a href='./admin.php' class='rol p__admin'><div>Pagina Administrativa</div></a>
                    ";
                }
            ?>
            <div class="p__descripcion">
                <?php if(isset($mesaje3)) echo $mesaje3; ?>
            </div>
        </section>
        <section class="otros">
            <nav>
                <form name="habilitar" action="<?php echo $metodo; ?>" method="post">
                    <div class="opcion">
                        <label for="favoritos">Mis Favoritos</label>
                        <input type="radio" name="opcion" id="favoritos" value="favoritos" hidden checked>
                    </div>
                    <div class="opcion">
                        <label for="historial">Mi historial</label>
                        <input type="radio" name="opcion" id="historial" value="historial" hidden>
                    </div>
                </form>
            </nav>
            <div class="contenido">
                <div class="cont favoritos">
                    
                        <?php
                            if($fav->rowCount() > 0){
                                foreach ($fav as $valueFav) {
                                    $animesFav = $db->prepare("SELECT * FROM animes WHERE ID = :id");
                                    $animesFav->bindParam(":id", $valueFav["ID_Anime_Fav"]);
                                    $animesFav->execute();
                                    foreach ($animesFav as $value) {
                                        echo "
                                        <div class='fav'>
                                            <div class='imag'>
                                                <img src='../img/ids/".$value["ID"].".png' class='img-fav'>
                                            </div>
                                            <h3>".$value["Titulo"]."</h3>
                                            <div class='eliminar'>
                                                <form action='$metodo' method='post'>
                                                    <input type='hidden' name='id_fav' value='".$valueFav["ID"]."'>
                                                    <button type='submit' class='s__trash'>
                                                        <svg xmlns='http://www.w3.org/2000/svg' class='trash' viewBox='0 0 448 512'>
                                                            <path fill='#a0a5a8' d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        ";
                                    }
                                }
                            }
                        ?>
                        
                </div>
                <div class="cont historial">
                    <?php
                        if($hist->rowCount() > 0){
                            foreach ($hist as $valueHist) {
                                $animesHist = $db->prepare("SELECT * FROM animes WHERE ID = :id");
                                $animesHist->bindParam(":id", $valueHist["anime"]);
                                $animesHist->execute();
                                foreach ($animesHist as $value) {
                                    echo "
                                    <div class='hist'>
                                        <div class='imag'>
                                            <img src='../img/ids/".$value["ID"].".png' class='img-hist'>
                                        </div>
                                        <h3>".$value["Titulo"]."</h3>
                                        <div class='fecha'>".$valueHist["Fecha"]."</div>
                                        <div class='eliminar'>
                                            <form action='$metodo' method='post'>
                                                <input type='hidden' name='id_hist' value='".$valueHist["ID"]."'>
                                                <button type='submit' class='s__trash'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' class='trash' viewBox='0 0 448 512'>
                                                        <path fill='#a0a5a8' d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <?php
        echo "
        <script>
            var id = '$id';
            var nick = '$nick';
            var nombre = '$nombre';
            var correo = '$correo';
            var password = '$password';
            var rol = '$rol';
            var tc = '$tc';
        </script>
    ";
    ?>
    <script src="../js/cuenta.js"></script>
</body>
</html>
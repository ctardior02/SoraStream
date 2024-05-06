<?php
    session_start();
    include "./db.php";
    if(!isset($_SESSION["id"])){
        header("Location: ../../index.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recogida de los datos del formulario
        if(isset($_FILES["foto"])){
            $_FILES["foto"]["name"] = $_SESSION["nick"] .".jpg";
            $res = move_uploaded_file($_FILES["foto"]["tmp_name"], "../img/imgs-usuarios/".$_FILES["foto"]["name"]);
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        }
    } 

    $fav = $db->prepare("SELECT * FROM favoritos WHERE ID_Usuario = :id_usuario");
    $fav->bindParam(":id_usuario", $_SESSION["id"]);
    $fav->execute();

    function mostrarFoto(){
        $directorio = "../img/imgs-usuarios"; 
        $carpeta = scandir($directorio);
        $jpgUsuario = $_SESSION["nick"]. ".jpg";
        $dir = (in_array($jpgUsuario,  $carpeta)) ? $directorio."/". $jpgUsuario : $directorio. "/default.webp";
        return $dir;
    }

    $imagen = mostrarFoto();
    $id = $_SESSION["id"];
    $nick = $_SESSION["nick"];
    $nombre = $_SESSION["nombre"];
    $correo = $_SESSION["email"];
    $password = $_SESSION["password"];
    $tc = $_SESSION["tc"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cuenta.css">
    <title>Cuenta</title>
</head>
<body>
    <header></header>
    <main>
        <section class="info_cuenta">
            <h1>Nombre de usuario</h1>
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
                        <form action="" class="edicion_campos" method="post">
                            <div>
                                <label class="label_campo" for="nick">Nick:</label>
                                <input type="text" name="nick" class="campo" id="nick" value="<?php echo $_SESSION["nick"]; ?>" >
                            </div>
                            <div>
                                <label class="label_campo" for="nombre">Nombre Completo:</label>
                                <input type="text" name="nombre" class="campo" id="nombre" value="<?php echo $_SESSION["nombre"]; ?>">
                            </div>
                            <div>
                                <label class="label_campo" for="correo">Correo:</label>
                                <input type="text" name="correo" class="campo" id="correo" value="<?php echo $_SESSION["email"]; ?>">
                            </div>
                            <div>
                                <label class="label_campo" for="password">Contraseña:</label>
                                <input type="text" name="password" class="campo" id="password" value="<?php echo $_SESSION["password"]; ?>">
                            </div>
                            <div>
                                <label class="label_campo" for="card-number">Tarjeta de Credito:</label>
                                <input type="number" name="card-number" class="campo" id="card-number" minlength="14" maxlength="19" placeholder="XXXX XXXX XXXX XXXX">
                            </div>
                            <div class="solo">
                                <input type="submit" class="editar" value="Editar" disabled>
                            </div>                     
                        </form>
                    </div>
                </form>
                <a href="./logout.php">Cerrar Sesion</a>
                <a href="./deleteSesion.php">Borrar Cuenta</a>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="foto">Cambiar foto</label>
                    <input type="file" name="foto" onchange="this.form.submit()" id="foto" hidden>
                </form>
            </div>
        </section>
        <section class="otros">
            <nav>
                <form name="habilitar" action="" method="post">
                    <div class="opcion">
                        <label for="favoritos">Mis Favoritos</label>
                        <input type="radio" name="opcion" id="favoritos" value="favoritos" hidden checked>
                    </div>
                    <div class="opcion">
                        <label for="listas">Mis Listas</label>
                        <input type="radio" name="opcion" id="listas" value="listas" hidden>
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
                                foreach ($fav as $value) {
                                    $animesFav = $db->prepare("SELECT * FROM animes WHERE ID = :id");
                                    $animesFav->bindParam(":id", $value["ID_Anime_Fav"]);
                                    $animesFav->execute();
                                    foreach ($animesFav as $value) {
                                        echo "
                                        <div class='fav'>
                                            <div class='imag'>
                                                <img src='../img/ids/".$value["ID"].".png' class='img-fav'>
                                            </div>
                                            <h3>".$value["Titulo"]."</h3>
                                        </div>
                                        ";
                                    }
                                }
                            }
                        ?>
                        
                </div>
                <div class="cont listas">

                </div>
                <div class="cont historial">
                </div>
            </div>
        </section>
    </main>
    <script src="../js/cuenta.js"></script>
</body>
</html>
<?php
include "./db.php";

if (isset($_POST["singin"])) {
  if (isset($_POST["lNick"]) && isset($_POST["lPassword"]) && $_POST["lNick"] !== "" && $_POST["lPassword"] !== "" && $_POST["lNick"] !== null && $_POST["lPassword"] !== null) {
    $usuario = $db->prepare("SELECT * FROM usuarios WHERE Nick = :nick AND Password = :password");
    $usuario->bindParam(":nick", $_POST["lNick"]);
    $usuario->bindParam(":password", $_POST["lPassword"]);
    $usuario->execute();

    if ($usuario->rowCount() > 0) {
      $usu = $usuario->fetch();
      session_start();
      $_SESSION["id"] = $usu["ID"];
      $_SESSION["nombre"] = $usu["Nombre"];
      $_SESSION["nick"] = $usu["Nick"];
      $_SESSION["email"] = $usu["Email"];
      $_SESSION["password"] = $usu["Password"];
      $_SESSION["tc"] = $usu["Tarjeta_Credito"];
      $_SESSION["rol"] = $usu["Rol"];
      header("Location: ../../index.php");
    } else {
      $mensaje = "Credenciales Incorrectas";
    }
  } else {
    $mensaje = "Completa todos los campos";
  }
} else if (isset($_POST["singup"])) {
  if ((isset($_POST['sName']) && isset($_POST['sNick']) && isset($_POST['sEmail']) && isset($_POST['sPassword']))) {
    $inseccion = $db->prepare("INSERT INTO usuarios (Nombre, Nick, Email, Password, Tarjeta_Credito, Rol) VALUES (:name, :nick, :email, :password, :tc, :rol)");
    $inseccion->bindParam(":name", $_POST['sName']);
    $inseccion->bindParam(":nick", $_POST['sNick']);
    $inseccion->bindParam(":email", $_POST['sEmail']);
    $inseccion->bindParam(":password", $_POST['sPassword']);
    $inseccion->bindValue(":tc", null);
    $inseccion->bindValue(":rol", 0);
    $inseccion->execute();
    if ($inseccion) {
      $sid = $db->lastInsertId();
      session_start();
      $_SESSION["id"] = $sid;
      $_SESSION["nombre"] = $_POST['sName'];
      $_SESSION["nick"] = $_POST['sNick'];
      $_SESSION["email"] = $_POST['sEmail'];
      $_SESSION["password"] = $_POST['sPassword'];
      $_SESSION["tc"] = null;
      $_SESSION["rol"] = 0;
      header("Location: ../../index.php");
    } else {
      $mensaje2 = "Error al crear la cuenta, vuelva a interntarlo";
    }
  } else {
    $mensaje2 = "Completa todos los campos";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>SoraStream</title>
</head>

<body>
    <div class="login">
        <div class="contenido">
            <div class="imagenContenedor d-flex align-items-center">
                <img id="imagen" src="../img/FotosLogin/logoGrande.jpg" alt="">
            </div>
            <div class="formularios">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login__registro" id="logearse">
                    <h1 class="logeo_titulo">Iniciar Sesion</h1>
                    <div class="ContenedorInput">
                        <i class='bx bx-user'></i>
                        <input type="text" placeholder="Nombre" name="lNick" class="input">
                    </div>
                    <div class="ContenedorInput">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" placeholder="Contraseña" name="lPassword" class="input">
                    </div>
                    <!-- <a href="#" class="RecuperarContraseña">Olvidaste tu contraseña?</a> -->
                    <p class="l__description mensaje"><?php $resultado = (isset($mensaje)) ? $mensaje : "¡Importante!: Recuerda rellenar todos los campos";
                        echo "$resultado" ?></p>
                    <input href="#" type="submit" class="Boton s__singin" name="singin" value="SING IN">Iniciar Sesion</input>
                    <div>
                        <span class="tienesCuenta">No tienes cuenta?</span>
                        <span class="RegistrarteBoton" id="Registro">Registrate</span>
                    </div>
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login__create none" id="registrarseForm">
                    <h1 class="logeo_titulo">Crear Cuenta</h1>
                    <div class="ContenedorInput">
                        <i class='bx bx-user'></i>
                        <input type="text" placeholder="Nombre Completo" name="sName" class="input c__singup">
                    </div>
                    <div class="ContenedorInput">
                        <input type="text" placeholder="Nombre de Usuario" name="sNick" class="input c__singup">
                    </div>
                    <div class="ContenedorInput">
                        <i class='bx bx-user'></i>
                        <input type="text" placeholder="Correo Eletronico" name="sEmail" class="input c__singup">
                    </div>
                    <div class="ContenedorInput">
                        <i class='bx bx-at'></i>
                        <input type="password" placeholder="Cotraseña" name="sPassword" class="input c__singup">

                    </div>
                    <p class="s__description"><?php $resultado2 = (isset($mensaje2)) ? $mensaje2 : "¡Importante!: Recuerda rellenar todos los campos";
                                            echo "$resultado2" ?></p>
                    <input href="#" class="Boton submit s__singup" type="submit" name="singup" value="SING UP">Registrarse</input>
                    <div>
                        <span class="tienesCuenta">Ya tienes cuenta?</span>
                        <span class="logearseBoton" id="logearseId">Iniciar Sesion</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>

</html>
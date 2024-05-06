<?php
  include "./db.php";

  if(isset($_POST["singin"])){
    if(isset($_POST["lNick"]) && isset($_POST["lPassword"])){
      $usuario = $db->prepare("SELECT * FROM usuarios WHERE Nick = :nick AND Password = :password");
      $usuario->bindParam(":nick", $_POST["lNick"]);
      $usuario->bindParam(":password", $_POST["lPassword"]);
      $usuario->execute();

      if($usuario->rowCount() > 0){
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
    if(isset($_POST['sName']) && isset($_POST['sNick']) && isset($_POST['sEmail']) && isset($_POST['sPassword'])){
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
          echo "
              <script>
                
              </script>
              ";
          header("Location: ../../index.php");
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
    <link rel="stylesheet" href="../css/register.css">
    <title>Login/Register</title>
</head>
<body>
  <div class='main main__login position-relative w-100'>
      <div class="container a-container is-txl" id="a-container">
        <form class="form" id="a-form" action="" method="POST">
          <h2 class="form_title title">Crear Cuenta</h2>
          <input class='form__input' type="text" name="sName" placeholder='Full Name'/>
          <input class='form__input' type="text" name="sNick" placeholder='Nick Name'/>
          <input class='form__input' type="text" name="sEmail" placeholder='Email'/>
          <input class='form__input' type="password" name="sPassword" id="" placeholder='Password'/>
          <input class='form__button button submit' type="submit" name="singup" value="SING UP" />
        </form>
      </div>
      <div class="container b-container is-txl is-z200" id="b-container">
        <form class="form" id="b-form" action="" method="POST">
          <h2 class="form_title title">Iniciar Session</h2>
          <input class='form__input' type="text" name="lNick" placeholder='Nick Name' />
          <input class='form__input' type="password" name="lPassword" placeholder='Password' />
          <input class='form__button button submit' type="submit" name="singin" value="SING IN" />
        </form>
      </div>
      <div class="switch is-txr" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container is-hidden" id="switch-c1">
          <h2 class="switch__title title">Vuelve atras !</h2>
          <p class="switch__description description">¿Ya tienes cuenta?</p>
          <button class="switch__button button switch-btn">SIGN IN</button>
        </div>
        <div class="switch__container" id="switch-c2">
          <h2 class="switch__title title">Buenas !</h2>
          <p class="switch__description description">¿Aun no tienes cuenta?</p>
          <button class="switch__button button switch-btn">SIGN UP</button>
        </div>
      </div>
  </div>
    <script src="../js/register.js"></script>
</body>
</html>
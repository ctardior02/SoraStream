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
                <img src="../img/default.webp" alt="">
            </div>
            <div class="botones">
                <a href="">Editar Cuenta</a>
                <a href="">Cerrar Sesion</a>
                <a href="">Borrar Cuenta</a>
                <form action="" method="post">
                    <label for="foto">Cambiar foto</label>
                    <input type="file" name="foto" id="foto" hidden>
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
                    <div class="fav">
                        <img src="" alt="">
                        <h3>One Piece</h3>
                    </div>
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
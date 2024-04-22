<?php
  session_start();
  function FullAnimes(){
    include "./src/php/db.php";
    $animes = "SELECT * from animes";
    $animeq = $db->query($animes);
    return $animeq;
  }

  function FiltroAnime($tipoAnime){
    include "./src/php/db.php";
    $animes = "SELECT * from animes where Categoria = '$tipoAnime'";
    $animeq = $db->query($animes);
    return $animeq;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["id"] ?></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/Index.css">
    <!-- Uso de librerias -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="d-flex flex-column justify-content-center body">
        <header class="d-flex  flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
          <div class=" ms-2 mb-2 mb-md-0 d-flex justify-content-center align-items-center">
            <a href="./Index.html"  class="d-inline-flex link-body-emphasis text-decoration-none">
             <img src="./src/img/LogoSoraStream3.png" width="200px" alt="">
            </a>
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <!-- <li><a href="#" class="px-2 BotonHeader">Home</a></li> -->
            <li><a href="#" class="px-2 BotonHeader">Tu lista</a></li>
          </ul>
          </div>
          <div class="d-flex align-items-center">
            <div class="buscador-container me-3">
              <input type="text" placeholder="Buscar...">
              <button class="buscador" type="submit">Buscar</button>
            </div>
          <?php

          
            if(!isset($_SESSION["id"]))
            {
            echo '  <div class="me-2 text-end d-flex">
              <a href="./src/php/register.php" class="BotonHeader font-sm bold auth-link">Registrarse</a>
              <a href="./src/php/register.php" class="BotonInicioRegistro font-sm bold auth-link">Iniciar sesión</a>
            </div>';
            }else{
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
        <div class="pelicula-principal portada d-flex">
          <div class="contenedorPortada d-flex flex-column justify-content-end pb-5" style="background: url(./src/img/portada5.jpg) ; background-size: cover;">
            <h3 class="titulo ms-3">Kimetsu No Yaiba</h3>
            <p class="descripcion ms-3">
              La obra sigue las aventuras de Tanjirō Kamado, un adolescente cuya familia fue cruelmente asesinada por un Demonio el cual convirtió a su hermana Nezuko en una de estas criaturas, obligando a Tanjirō a emprender un viaje para cazar a estos seres y de paso ayudar a su hermana a recuperar su humanidad.  
            </p>  
            <div class="d-flex ms-3">
            <button role="button" class="boton"><i class="fas fa-play"></i>Reproducir</button>
            <button role="button" class="boton"><i class="fa fa-regular fa-bookmark"> </i>Añadir a favoritos</button>
            </div>
          </div>
                
          <div class="contenedorPortada d-flex flex-column justify-content-end pb-5" style="background: url(./src/img/OnePiece-Portada.jpg) ; background-size: cover;">
            <h3 class="titulo ms-3">One Piece</h3>
            <p class="descripcion ms-3">
              One Piece narra la historia de un joven llamado Monkey D. Luffy, que inspirado por su amigo pirata Shanks, comienza un viaje para alcanzar su sueño, ser el Rey de los piratas, para lo cual deberá encontrar el tesoro One Piece dejado por el anterior rey de los piratas Gol D. Roger.
            </p>  
            <div class="d-flex ms-3">
            <button role="button" class="boton"><i class="fas fa-play"></i>Reproducir</button>
            <button role="button" class="boton"><i class="fas fa-solid fa-bookmark"></i>Añadir a favoritos</button>
            </div>
          </div>

          <div class="contenedorPortada d-flex flex-column justify-content-end pb-5" style="background: url(./src/img/dragonBall-Portada.jpg) ; background-size: cover;">
            <h3 class="titulo ms-3">Dragon Ball</h3>
            <p class="descripcion ms-3">
              Dragon Ball nos cuenta la vida de Son Goku, un niño inspirado en la leyenda china del rey mono que tiene cola de simio, una nube voladora y un bastón mágico y que acompaña a Bulma por el mundo en busca de las Bolas de Dragón: siete esferas capaces de conceder cualquier deseo al juntarlas e invocar al dragón Shenlong.
            </p>  
            <div class="d-flex ms-3">
            <button role="button" class="boton"><i class="fas fa-play"></i>Reproducir</button>
            <button role="button" class="boton"><i class="fas fa-solid fa-bookmark"></i>Añadir a favoritos</button>
            </div>
          </div>
        </div>
        <main class="d-flex align-items-center justify-content-center flex-column">
          <h3 class="text-light">Recomendaciones del dia</h1>
          <?php
          if(isset($_POST['Ct_Anime'])){
            $animeq = FiltroAnime($_POST['Ct_Anime']);
          }else{
            $animeq = FullAnimes();
          }
            echo "<div class='justify-content-center d-flex ListaAnimes contenedor'>";
            foreach($animeq as $anime){
              echo "<div class='flip-card'>
              <div class='card-container'>
                  <div class='cardFlip-block'>
                      <img src='./src/img/ids/" . $anime['ID'] . ".png' alt=''>
                  </div>
                  <div  class='bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column'>
                    <p class='mt-3'>". $anime["Titulo"] ."</p>
                    <div class='w-100 d-flex flex-column mb-5'>
                      <p class='Sinopsis'>". $anime["Descripcion"] ."</p>
                      <div class='iconos mt-4 w-100 d-flex '>
                         <svg class='IconosPlay' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' strokeWidth={1.5} stroke='currentColor' className='w-6 h-6'>
                        <path strokeLinecap='round' strokeLinejoin='round' d='M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z' />
                      </svg> 
                      <svg class='IconoFav' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                        <path stroke-linecap='round' stroke-linejoin='round' d='M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z' />
                      </svg>
                      </div>             
                    </div>
                  </div>
              </div>
          </div>";
            }
            echo "</div>";
          ?>
          <div class="d-flex justify-content-center text-white flex-column">
          <p class="text-white">Escoge un tipo de anime:</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="d-flex flex-column">
            <div>  
              <input type="radio" id="Shonen" name="Ct_Anime" value="Shonen">
              <label for="html">Shonen</label><br>
            </div>
          <div>      
            <input type="radio" id="Seinen" name="Ct_Anime" value="Seinen">
              <label for="html">Seinen</label><br>
          </div> 
          <div>      
            <input type="radio" id="Isekai" name="Ct_Anime" value="Isekai">
              <label for="html">Isekai</label><br>
          </div> 
          <input type="submit">
          </form>
          </div>
          <h3 class="text-light">Lo mejor</h1>
          <div class="justify-content-center d-flex ListaAnimes contenedor">
            <div class="flip-card">
              <div class="card-container">
                  <div class="cardFlip-block">
                      <img src="./src/img/BlackCover.png" alt="">
                  </div>
                  <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
                    <p class="mt-3">Black Clover</p>
                    <div class="w-100 d-flex flex-column mb-5">
                      <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
                      <div class="iconos mt-4 w-100 d-flex ">
                         <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                      </svg> 
                      <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                      </svg>
                      </div>             
                    </div>
                  </div>
              </div>
          </div>
          <div class="flip-card">
            <div class="card-container">
                <div class="cardFlip-block">
                    <img src="./src/img/ChainsawMan.png" alt="">
                </div>
                <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
                  <p class="mt-3">Chainsaw Man</p>
                  <div class="w-100 d-flex flex-column mb-5">
                    <p class="Sinopsis">La historia de Chainsaw Man se desarrolla en un mundo ficticio habitado no sólo por humanos, sino también por demonios llamados Akuma. Los demonios nacen en el infierno y poseen la capacidad de adoptar la forma y las características de los peores temores humanos. Diablos de pistola, diablos de serpiente, diablos de zorro: las posibilidades son realmente infinitas. Pero cuanto más común o extendido es el miedo, más fuerte es el demonio que lo personifica, y viceversa.</p>
                    <div class="iconos mt-4 w-100 d-flex ">
                       <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                      <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                    </svg> 
                    <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                    </svg>
                    </div>              
                  </div>
                </div>
            </div>
        </div>
        <div class="flip-card">
          <div class="card-container">
              <div class="cardFlip-block">
                  <img src="./src/img/DragonBallSuper.png" alt="">
              </div>
              <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
                <p class="mt-3">Dragon Ball</p>
                <div class="w-100 d-flex flex-column mb-5">
                  <p class="Sinopsis">Dragon Ball Super continúa la legendaria saga de Dragon Ball, llevando a los fanáticos a nuevas y emocionantes aventuras en el vasto universo de Dragon Ball. Después de los eventos de la batalla con Majin Buu, Goku y sus amigos se encuentran enfrentando desafíos aún mayores, incluidos dioses de la destrucción, universos paralelos y seres cósmicos de increíble poder. Con nuevas transformaciones, personajes y enemigos formidables.</p>
                  <div class="iconos mt-4 w-100 d-flex ">
                     <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                  </svg> 
                  <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                  </svg>
                  
                  </div>
                                      
                </div>
              </div>
          </div>
      </div>
      <div class="flip-card">
        <div class="card-container">
            <div class="cardFlip-block">
                <img src="./src/img/FairyTail.png" alt="">
            </div>
            <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
              <p class="mt-3">Fairy Tail</p>
              <div class="w-100 d-flex flex-column mb-5">
                <p class="Sinopsis">Fairy Tail sigue las emocionantes aventuras del gremio de magos más famoso de Fiore: Fairy Tail. La historia gira en torno a Lucy Heartfilia, una joven maga celestial que sueña con unirse a Fairy Tail y vivir sus propias aventuras. Pronto, se encuentra con Natsu Dragneel, un mago de fuego que resulta ser miembro de Fairy Tail, y juntos se unen a otros magos poderosos en misiones llenas de acción, amistad y un sinfín de desafíos. A lo largo de un viaje largo y emocionante.</p>
                <div class="iconos mt-4 w-100 d-flex ">
                   <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                  <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                </svg> 
                <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
                
                </div>
                                    
              </div>
            </div>
        </div>
    </div>
    <div class="flip-card">
      <div class="card-container">
          <div class="cardFlip-block">
              <img src="./src/img/DrStone.png" alt="">
          </div>
          <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
            <p class="mt-3">Dr Stone</p>
            <div class="w-100 d-flex flex-column mb-5">
              <p class="Sinopsis">Dr. Stone sigue la historia de Senku Ishigami, un brillante científico que despierta miles de años en el futuro después de que toda la humanidad ha sido petrificada por una misteriosa luz. Decidido a reconstruir la civilización desde cero, Senku utiliza su conocimiento científico para revivir a la humanidad y enfrentarse a los desafíos del mundo post-apocalíptico. Con la ayuda de sus amigos y aliados, Senku busca descubrir los secretos del pasado.</p>
              <div class="iconos mt-4 w-100 d-flex ">
                 <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
              </svg> 
              <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
              </svg>
              
              </div>
                                  
            </div>
          </div>
      </div>
  </div>
  <div class="flip-card">
    <div class="card-container">
        <div class="cardFlip-block">
            <img src="./src/img/Frieren.png" alt="">
        </div>
        <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
          <p class="mt-3">Frieren</p>
          <div class="w-100 d-flex flex-column mb-5">
            <p class="Sinopsis">La historia sigue a la maga elfa Frieren, una exmiembro del grupo de aventureros que derrotó al Rey Demonio y restauró la armonía en el mundo después de una búsqueda de diez años. En el pasado, el grupo heroico incluía a Frieren, el guerrero enano Eisen y el sacerdote humano Heiter. Antes de separarse, observan una lluvia de meteoritos que ocurre una vez cada cincuenta años. Frieren acepta volver a verlos y darles una mejor vista la próxima vez que ocurra el evento celestial.</p>
            <div class="iconos mt-4 w-100 d-flex ">
               <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
              <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg> 
            <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
            </svg>
            
            </div>
                                
          </div>
        </div>
    </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/HellsParadise.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Hells Paradise</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">Hell's Paradise es una serie anime que sigue al ninja Gabimaru, que es condenado a muerte después de llevar una vida empapada de sangre. Sin embargo, todos sus intentos de ejecutarlo fracasan inexplicablemente. Por eso le pide la ayuda a un miembro novato de un famoso clan de vergudos para que tome su vida. En esta isla llena de demonios y peligros mortales, los convictos deben luchar por su supervivencia en este mundo en el que lo unico que importa e sobrevivir</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          
          </div>
                              
        </div>
      </div>
  </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/BlackCover.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Black Clover</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          </div>                
        </div>
      </div>
  </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/BlackCover.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Black Clover</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          </div>                
        </div>
      </div>
  </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/BlackCover.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Black Clover</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          </div>                
        </div>
      </div>
  </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/BlackCover.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Black Clover</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          </div>                
        </div>
      </div>
  </div>
</div>
<div class="flip-card">
  <div class="card-container">
      <div class="cardFlip-block">
          <img src="./src/img/BlackCover.png" alt="">
      </div>
      <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
        <p class="mt-3">Black Clover</p>
        <div class="w-100 d-flex flex-column mb-5">
          <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
          <div class="iconos mt-4 w-100 d-flex ">
             <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
          </svg> 
          <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          </div>                
        </div>
      </div>
  </div>
</div>

            </div>
          <h3 class="mt-5 text-light">Animes mas populares</h1>
            <div class="justify-content-between d-flex ListaAnimes contenedor">
              <div class="flip-card">
                <div class="card-container">
                    <div class="cardFlip-block">
                        <img src="./src/img/BlackCover.png" alt="">
                    </div>
                    <div  class="bg-dark text-light cardFlip-block-back d-flex align-items-center flex-column">
                      <p class="mt-3">Black Clover</p>
                      <div class="w-100 d-flex flex-column mb-5">
                        <p class="Sinopsis">En un mundo donde la magia lo es todo, había un niño nacido que no puede utilizar ningún tipo de magia y que había sido abandonado en una En un mundo en el que la magia lo es todo, un pueblerino huérfano incapaz de usar ningún tipo de poder mágico pretende convertirse nada más y nada menos que en el rey de los magos. Y aunque todo el mundo lo toma por un loco frustrado con ideas de bombero, quizás acabe encontrando su oportunidad.</p>
                        <div class="iconos mt-4 w-100 d-flex ">
                           <svg class="IconosPlay" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                          <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                        </svg> 
                        <svg class="IconoFav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                        
                        </div>
                                            
                      </div>
                    </div>
                </div>
            </div>
              <div><img src="./src/img/ChainsawMan.png" alt=""></div>
              <div><img src="./src/img/Digimon.png" alt=""></div>
              <div><img src="./src/img/DragonBallSuper.png" alt=""></div>
              <div><img src="./src/img/DrStone.png" alt=""></div>
              <div><img src="./src/img/FairyTail.png" alt=""></div>
              <div><img src="./src/img/Frieren.png" alt=""></div>
              <div><img src="./src/img/HellsParadise.png" alt=""></div>
              <div><img src="./src/img/JujutsuKaisen.png" alt=""></div>
              <div><img src="./src/img/Kimetsu.png" alt=""></div>
              <div><img src="./src/img/Kingdom.png" alt=""></div>
              <div><img src="./src/img/NarutoShippuden.png" alt=""></div>
              <div><img src="./src/img/onePiece.png" alt=""></div>
              <div><img src="./src/img/OnePunchMan.png" alt=""></div>
              <div><img src="./src/img/SengokuYouko.png" alt=""></div>
              <div><img src="./src/img/SoloLeveling.png" alt=""></div>
              <div><img src="./src/img/TsukimichiMoonlit.png" alt=""></div>
              </div>
        </main>

        <footer>
          <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
              <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                 <img src="./src/img/LogoSoraStream3.png" style="width: 100px;" alt="">
                </a>
                <span class="mb-3 mb-md-0  text-light ">© 2024 Company, Inc</span>
              </div>
          
              <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                </svg></use></svg></a></li>
                <li class="ms-3"><a class="text-body-light" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                </svg><use xlink:href="#instagram"></use></svg></a></li>
                <li class="ms-3"><a class="text-body-light" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                  <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                </svg><use xlink:href="#facebook"></use></svg></a></li>
              </ul>
            </footer>
          </div>
        </footer>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="./src/js/index.js"></script>
</body>
</html>
$(document).ready(function(){
  $('.ListaAnimes').slick({
    dots: false,
    infinite: false,
    speed: 700,
    slidesToShow: 5,
    slidesToScroll: 5,
    swipe: false,
    responsive: [
      {
        breakpoint: 1600,
        settings: { 
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 1100,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 680,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});

$(document).ready(function() {
  if (!$('.portada').hasClass('slick-initialized')) {
    $('.portada').slick({
      dots: true,
      infinite: true,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 4000,
      swipe: false,
      slidesToShow: 1,
      slidesToScroll: 1
    });
  }
});


/* Estilos dropdown index cuenta */
function myFunction() {
  var dropdown = document.getElementById("myDropdown");
  dropdown.classList.toggle("show");
  
  // Ajustar la posición del dropdown si se sale de la pantalla
  var rect = dropdown.getBoundingClientRect();
  var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
  
  if (rect.right > viewportWidth) {
    dropdown.style.right = "0";
    dropdown.style.left = "auto";
  } else {
    dropdown.style.right = "auto";
    dropdown.style.left = "0";
  }
}

// Cierra el dropdown si se hace clic fuera de él
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function reproducir(id){
  location.href ="./src/php/EleccionCapitulo.php?id=" + id;
}
function CambiarFoto() {
  const Kimetsus = document.querySelectorAll('.portadaKimetsu');
  const OnePieces = document.querySelectorAll('.portadaOnePiece');
  const DragonBalls = document.querySelectorAll('.portadaDragonBall');
  
  if (window.innerWidth < 1000) {
    Kimetsus.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/verticales/13.jpg)';
      element.style.backgroundSize = 'cover';
    });
    
    OnePieces.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/verticales/3.jpg)';
      element.style.backgroundSize = 'cover';
    });
    
    DragonBalls.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/verticales/1.jpg)';
      element.style.backgroundSize = 'cover';
    });
    
  } else {
    Kimetsus.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/horizontales/13.jpg)';
      element.style.backgroundSize = 'cover';
    });
    
    OnePieces.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/horizontales/3.jpg)';
      element.style.backgroundSize = 'cover';
    });
    
    DragonBalls.forEach(element => {
      element.style.background = 'url(./src/img/Portadas/horizontales/1.jpg)';
      element.style.backgroundSize = 'cover';
    });
  }
}
window.addEventListener('load', CambiarFoto);
window.addEventListener('resize', CambiarFoto);

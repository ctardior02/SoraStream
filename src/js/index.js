$(document).ready(function(){
  $('.ListaAnimes').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 5,
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
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});

$('.portada').slick({
  dots: true,
  infinite: true,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 4000
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

/* Fin estilos dropdwon cuenta */
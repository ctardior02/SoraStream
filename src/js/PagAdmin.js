function mostrarPestaña(tabId) {
    // Ocultar todos los contenidos
    const contents = document.querySelectorAll('.content');
    contents.forEach(content => content.classList.remove('activa'));

    // Desactivar todas las pestañas
    const tabs = document.querySelectorAll('.pestaña');
    tabs.forEach(tab => tab.classList.remove('activa'));

    // Mostrar el contenido seleccionado
    document.getElementById(tabId).classList.add('activa');

    // Activar la pestaña seleccionada
    event.target.classList.add('activa');
}

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
  /* Fin estilos dropdwon cuenta */
  window.addEventListener("load", function(){
    let mensajeAnime = document.querySelector(".error-crear-anime");
    if(mensajeAnime.textContent != "Anime creado"){


      const contents = document.querySelectorAll('.content');
      contents.forEach(content => content.classList.remove('activa'));

      const tabs = document.querySelectorAll('.pestaña');
      tabs.forEach(tab => tab.classList.remove('activa'));
      document.getElementById('anime').classList.add('activa');

      let botonAnime = document.getElementById("animePestaña");
      botonAnime.classList.add("activa");
      let botonCapitulo = document.getElementById("capituloPestaña");
      if(botonCapitulo.classList.contains("activa")){
        botonCapitulo.classList.remove("activa");
      }
    }
    
  });
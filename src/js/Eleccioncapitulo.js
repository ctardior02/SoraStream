const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

function CambiarFotoEleccion() {
  const portadas = document.querySelectorAll('.imagenPortada');
  const fondoPortadas = document.querySelectorAll('.imagenFondoPortada');
  
  const nuevaSrc = window.innerWidth < 1000
    ? '../../src/img/ids/' + id + '.png'
    : '../../src/img/ids_categoria/' + id + '.png';
  
  portadas.forEach(portada => {
    portada.src = nuevaSrc;
  });

  fondoPortadas.forEach(fondoPortada => {
    fondoPortada.src = nuevaSrc;
  });
}

window.addEventListener('load', CambiarFotoEleccion);
window.addEventListener('resize', CambiarFotoEleccion);


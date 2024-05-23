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
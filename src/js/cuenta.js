function actualizarOpciones () {
    let elemntos = document.forms.habilitar.querySelectorAll("input");
    elemntos.forEach(opcion => {
        let padre = opcion.parentNode;
        if (opcion.checked) {
            padre.className="opcion2"
        } else {
            padre.className="opcion"
        }

        document.querySelectorAll(".cont").forEach(cont => {
            if (opcion.checked && opcion.value !== cont.classList[1]) {
                document.querySelector(`.${cont.classList[1]}`).style.display = "none";
            } else if (opcion.checked && opcion.value == cont.classList[1]) {
                document.querySelector(`.${cont.classList[1]}`).style.display = "flex";
            }
        });        
    });
}



let fomualario = document.forms.habilitar;
let contenedores = document.querySelector(".opcion");
window.addEventListener("DOMContentLoaded", actualizarOpciones);
fomualario.addEventListener("change", actualizarOpciones);
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

function comprobarTodos() {
   let nick2 =  document.querySelector("label[for='nick']");
   let nombre2 =  document.querySelector("label[for='nombre']");
   let correo2 =  document.querySelector("label[for='correo']");
   let password2 =  document.querySelector("label[for='password']");
   let tc2 =  document.querySelector("label[for='card-number']");
   let editar = document.querySelector(".editar");

   if (nick2.style.color === "rgb(190, 57, 57)" || nombre2.style.color === "rgb(190, 57, 57)" || correo2.style.color === "rgb(190, 57, 57)" || password2.style.color === "rgb(190, 57, 57)" || tc2.style.color === "rgb(190, 57, 57)") {
    editar.disabled = true;
    editar.style.color = "rgb(0, 0, 0)";
    editar.style.cursor = "auto";
   } else {
    editar.disabled = false;
    editar.style.cursor = "pointer";
   }


   if ((nick2.style.color === "rgb(47, 207, 132)" || nombre2.style.color === "rgb(47, 207, 132)" || correo2.style.color === "rgb(47, 207, 132)" || password2.style.color === "rgb(47, 207, 132)" || tc2.style.color === "rgb(47, 207, 132)") && (nick2.style.color !== "rgb(190, 57, 57)" && nombre2.style.color !== "rgb(190, 57, 57)" && correo2.style.color !== "rgb(190, 57, 57)" && password2.style.color !== "rgb(190, 57, 57)" && tc2.style.color !== "rgb(190, 57, 57)")) {
    editar.style.backgroundColor = "rgb(47, 207, 132)";
    editar.disabled = false;
    editar.style.cursor = "pointer";
    editar.style.color = "rgb(0, 0, 0)";
   } else if (nick2.style.color === "rgb(75, 112, 226)" && nombre2.style.color === "rgb(75, 112, 226)" && correo2.style.color === "rgb(75, 112, 226)" && password2.style.color === "rgb(75, 112, 226)" && tc2.style.color === "rgb(75, 112, 226)") {
    editar.style.backgroundColor = "rgb(75, 112, 226)";
    editar.disabled = true;
    editar.style.cursor = "auto";
    editar.style.color = "rgb(0, 0, 0)";
   }

}


document.querySelectorAll(".campo").forEach(input => {
    input.addEventListener("blur", function() {
        const error = document.querySelector(`input[name='${input.name}'] + div`);
        const regex = /[{}\[\]()\/\\]/;
        const regexTC = /^\d{14,19}$/;
        if (regex.test(input.value)) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#be3939";
            document.querySelector(".editar").style.backgroundColor = "#be3939";
            error.classList.remove("oculto");
        } else if (nick !== input.value && input.name === "nick") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (nick === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (nombre !== input.value && input.name === "nombre") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (nombre === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (correo !== input.value && input.name === "correo") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (correo === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (password !== input.value && input.name === "password") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (password === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (regexTC.test(input.value) && tc !== input.value && input.name === "card-number") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (tc === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
            if(error.classList.length === 1) error.classList.add("oculto");
        } else if (input.name === "card-number") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#be3939";
            document.querySelector(".editar").style.backgroundColor = "#be3939";
            error.classList.remove("oculto");
        }

        comprobarTodos();

    });
});





let fomualario = document.forms.habilitar;
let contenedores = document.querySelector(".opcion");
window.addEventListener("load", actualizarOpciones);
fomualario.addEventListener("change", actualizarOpciones);
window.addEventListener("load", ()=>{
    document.querySelectorAll(".campo").forEach(input => {
        const error = document.querySelector(`input[name='${input.name}'] + div`);
        const regex = /[{}\[\]()\/]/;
        const regexTC = /^\d{14,19}$/;
        if (regex.test(input.value)) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#be3939";
            error.display = "block";
        } else if (nick !== input.value && input.name === "nick") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
        } else if (nick === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
        } else if (nombre !== input.value && input.name === "nombre") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
        } else if (nombre === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
        } else if (correo !== input.value && input.name === "correo") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
        } else if (correo === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
        } else if (password !== input.value && input.name === "password") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
        } else if (password === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
        } else if (regexTC.test(input.value) && tc !== input.value && input.name === "card-number") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#2fcf84";
        } else if (tc === input.value) {
            document.querySelector(`label[for='${input.name}']`).style.color = "#4b70e2";
        } else if (input.name === "card-number") {
            document.querySelector(`label[for='${input.name}']`).style.color = "#be3939";
        }

        comprobarTodos();
    
    });
});

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
    location.href ="./EleccionCapitulo.php?id=" + id;
  }
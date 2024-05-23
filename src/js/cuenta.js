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

/* // Función para aplicar formato al número de tarjeta de crédito
function formatCreditCardNumber() {
    // Remover cualquier carácter que no sea un número y agregar espacios cada cuatro caracteres
    this.value = this.value.replace(/[^0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
}

// Función para desencadenar el evento 'change' después de copiar, cortar o pegar
function triggerChangeEvent() {
    setTimeout(function () {
        // Desencadenar el evento 'change'
        document.querySelector("#card-number").dispatchEvent(new Event('change'));
    }, 0); // Esperar 0 milisegundos para ejecutar el código después de que la acción se complete
}

// Agregar el event listener para los eventos 'keypress', 'change' y 'blur'
document.querySelector("#card-number").addEventListener('keypress', formatCreditCardNumber);
document.querySelector("#card-number").addEventListener('change', formatCreditCardNumber);
document.querySelector("#card-number").addEventListener('blur', formatCreditCardNumber);

// Agregar el event listener para los eventos 'copy', 'cut' y 'paste'
document.querySelector("#card-number").addEventListener('copy', triggerChangeEvent);
document.querySelector("#card-number").addEventListener('cut', triggerChangeEvent);
document.querySelector("#card-number").addEventListener('paste', triggerChangeEvent); */

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
let main = document.querySelector(".main");
let switchCtn = document.querySelector("#switch-cnt");
let switchC1 = document.querySelector("#switch-c1");
let switchC2 = document.querySelector("#switch-c2");
let switchCircle = document.querySelectorAll(".switch__circle");
let switchBtn = document.querySelectorAll(".switch-btn");
let aContainer = document.querySelector("#a-container");
let bContainer = document.querySelector("#b-container");
let allButtons = document.querySelectorAll(".submit");

let getButtons = (e) => e.preventDefault()

let changeForm = () => {

    switchCtn.classList.add("is-gx");
    setTimeout(function(){
        switchCtn.classList.remove("is-gx");
    }, 1500)

    if(main.classList.contains("main__login"))
        main.classList.replace("main__login", "main__singin");
    else
        main.classList.replace("main__singin", "main__login");

    switchCtn.classList.toggle("is-txr");
    switchCircle[0].classList.toggle("is-txr");
    switchCircle[1].classList.toggle("is-txr");

    switchC1.classList.toggle("is-hidden");
    switchC2.classList.toggle("is-hidden");
    aContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-txl");
    bContainer.classList.toggle("is-z200");

}

let mainF = () => {
    for (var index = 0; index < switchBtn.length; index++)
        switchBtn[index].addEventListener("click", changeForm)
}

function inputsSingUp(){
    const sSubmit = document.querySelector(".s__singup");
    const sName = document.querySelector("input[name='sName']");
    const sNick = document.querySelector("input[name='sNick']");
    const sEmail = document.querySelector("input[name='sEmail']");
    const sPassword = document.querySelector("input[name='sPassword']");
    
    if(sName.value === "" || sNick.value === "" || sEmail.value === "" || sPassword.value === "" ||
    sName.value === null || sNick.value === null || sEmail.value === null || sPassword.value === null){
        sSubmit.disabled = true;
        sSubmit.style.cursor = "default";
        
    } else {
        sSubmit.disabled = false;
        sSubmit.style.cursor = "pointer";
    }
}

function mensajesBotones(){
    const mensaje2 = document.querySelector(".s__description");
    if(mensaje2.textContent != "¡Importante!: Recuerda rellenar todos los campos"){
        mensaje2.style.color = "#be3939";
    } else {
        mensaje2.style.color = "#a0a5a8";
    }

    const mensaje = document.querySelector(".l__description");
    if(mensaje.textContent != "¡Importante!: Recuerda rellenar todos los campos"){
        mensaje.style.color = "#be3939";
    } else {
        mensaje.style.color = "#a0a5a8";
    }
}

window.addEventListener("load", mainF);
window.addEventListener("load", mensajesBotones);
window.addEventListener("load", inputsSingUp);
document.querySelectorAll(".c__singup").forEach(input => {
    input.addEventListener("blur", inputsSingUp);
})
/*===== LOGIN SHOW and HIDDEN =====*/
const signUp = document.getElementById('Registro'),
    signIn = document.getElementById('logearseId'),
    logearse = document.getElementById('logearse'),
    loginUp = document.getElementById('registrarseForm')


signUp.addEventListener('click', ()=>{
    logearse.classList.remove('block')
    loginUp.classList.remove('none')
    logearse.classList.toggle('none')
    loginUp.classList.toggle('block')
    const imagen = document.querySelector('.imagenContenedor');
    if (window.innerWidth <= 1023) {
        imagen.classList.remove('align-items-center');
        imagen.classList.add('align-items-start');
    }else{
        imagen.classList.remove('align-items-start');
        imagen.classList.add('align-items-center');
    }
})

signIn.addEventListener('click', ()=>{
    logearse.classList.remove('none')
    loginUp.classList.remove('block')
    logearse.classList.toggle('block')
    loginUp.classList.toggle('none')
    const imagen = document.querySelector('.imagenContenedor');
    if (window.innerWidth <= 1023) {
        imagen.classList.remove('align-items-start');
        imagen.classList.add('align-items-center');
    }else{
        imagen.classList.remove('align-items-start');
        imagen.classList.add('align-items-center');
    }
})


function changeImage() {
    const image = document.getElementById('imagen');
    const imagen = document.querySelector('.imagenContenedor');
    if (window.innerWidth <= 1023) {
        image.src = '../img/FotosLogin/LogoSoraStreamfondo.png';
        imagen.classList.remove('align-items-start');
        imagen.classList.add('align-items-center');
    } else {
        image.src = '../img/FotosLogin/logoGrande.jpg';
    }
}

window.addEventListener('resize', changeImage);
window.addEventListener('load', changeImage);




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

window.addEventListener("load", mensajesBotones);
window.addEventListener("load", inputsSingUp);
document.querySelectorAll(".c__singup").forEach(input => {
    input.addEventListener("blur", inputsSingUp);
})
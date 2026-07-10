 login.js
 /*==========================
    LOGIN SIMPLE
==========================*/

function login(){

    const usuario = document.getElementById("usuario").value;
    const password = document.getElementById("password").value;

    if(usuario === "" || password === ""){

        alert("Completa todos los campos");
        return;

    }

    // usuario demo (puedes cambiarlo luego)
    const userOK = "admin";
    const passOK = "1234";

    if(usuario === userOK && password === passOK){

        localStorage.setItem("usuarioLogueado", usuario);

        alert("Bienvenido " + usuario);

        window.location = "administrador/index.html";

    }else{

        alert("Usuario o contraseña incorrectos");

    }

}

/*==========================
    AUTO CHECK LOGIN
==========================*/

window.addEventListener("load",()=>{

    const user = localStorage.getItem("usuarioLogueado");

    if(user){

        console.log("Sesión activa:", user);

    }

});
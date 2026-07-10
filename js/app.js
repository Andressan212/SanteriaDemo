/*==========================================
    VARIABLES GLOBALES
==========================================*/

let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
let favoritos = JSON.parse(localStorage.getItem("favoritos")) || [];

/*==========================================
    CONTADOR DEL CARRITO
==========================================*/

function actualizarContador() {

    const contador = document.getElementById("contadorCarrito");

    if (contador) {
        contador.textContent = carrito.length;
    }

}

actualizarContador();

/*==========================================
    MENÚ AL HACER SCROLL
==========================================*/

window.addEventListener("scroll", () => {

    const header = document.querySelector("header");

    if (!header) return;

    if (window.scrollY > 60) {

        header.style.background = "#000";
        header.style.padding = "10px 8%";
        header.style.transition = ".4s";

    } else {

        header.style.background = "#111";
        header.style.padding = "15px 8%";

    }

});

/*==========================================
    BUSCADOR
==========================================*/

const buscador = document.getElementById("buscar");

if (buscador) {

    buscador.addEventListener("keyup", function () {

        let texto = this.value.toLowerCase();

        let productos = document.querySelectorAll(".producto");

        productos.forEach(producto => {

            let nombre = producto.innerText.toLowerCase();

            if (nombre.indexOf(texto) > -1) {

                producto.style.display = "block";

            } else {

                producto.style.display = "none";

            }

        });

    });

}

/*==========================================
    AGREGAR AL CARRITO
==========================================*/

const botones = document.querySelectorAll(".infoProducto button");

botones.forEach((boton) => {

    boton.addEventListener("click", () => {

        let tarjeta = boton.parentElement;

        let nombre = tarjeta.querySelector("h3").innerText;

        let precio = tarjeta.querySelector("h4").innerText;

        carrito.push({

            nombre: nombre,
            precio: precio

        });

        localStorage.setItem("carrito", JSON.stringify(carrito));

        actualizarContador();

        mostrarToast(nombre + " agregado al carrito");

    });

});

/*==========================================
    TOAST
==========================================*/

function mostrarToast(texto) {

    let toast = document.createElement("div");

    toast.className = "toast";

    toast.innerHTML = texto;

    document.body.appendChild(toast);

    setTimeout(() => {

        toast.classList.add("mostrar");

    }, 100);

    setTimeout(() => {

        toast.classList.remove("mostrar");

        setTimeout(() => {

            toast.remove();

        }, 500);

    }, 2500);

}

/*==========================================
    FAVORITOS
==========================================*/

function agregarFavorito(nombre){

    favoritos.push(nombre);

    localStorage.setItem("favoritos",JSON.stringify(favoritos));

}

/*==========================================
    BOTÓN VOLVER ARRIBA
==========================================*/

const botonArriba = document.createElement("button");

botonArriba.innerHTML = "⬆";

botonArriba.id = "btnArriba";

document.body.appendChild(botonArriba);

window.addEventListener("scroll",()=>{

    if(window.scrollY>300){

        botonArriba.style.display="block";

    }else{

        botonArriba.style.display="none";

    }

});

botonArriba.onclick=()=>{

    window.scrollTo({

        top:0,

        behavior:"smooth"

    });

}

/*==========================================
    ANIMACIÓN DE PRODUCTOS
==========================================*/

const tarjetas=document.querySelectorAll(".producto");

const mostrar=()=>{

    tarjetas.forEach(tarjeta=>{

        let posicion=tarjeta.getBoundingClientRect().top;

        let pantalla=window.innerHeight;

        if(posicion<pantalla-100){

            tarjeta.classList.add("visible");

        }

    });

}

window.addEventListener("scroll",mostrar);

mostrar();

/*==========================================
    MODO OSCURO
==========================================*/

let modo=localStorage.getItem("modo");

if(modo==="oscuro"){

    document.body.classList.add("oscuro");

}

function cambiarModo(){

    document.body.classList.toggle("oscuro");

    if(document.body.classList.contains("oscuro")){

        localStorage.setItem("modo","oscuro");

    }else{

        localStorage.setItem("modo","claro");

    }

}

/*==========================================
    RELOJ
==========================================*/

function reloj(){

    let ahora=new Date();

    let hora=ahora.toLocaleTimeString();

    let caja=document.getElementById("reloj");

    if(caja){

        caja.innerHTML=hora;

    }

}

setInterval(reloj,1000);

/*==========================================
    PRELOADER
==========================================*/

window.addEventListener("load",()=>{

    let loader=document.getElementById("loader");

    if(loader){

        loader.style.opacity="0";

        setTimeout(()=>{

            loader.style.display="none";

        },600);

    }

});

/*==========================================
    EFECTO HOVER
==========================================*/

document.querySelectorAll(".producto").forEach(producto=>{

    producto.addEventListener("mouseenter",()=>{

        producto.style.transform="scale(1.03)";

    });

    producto.addEventListener("mouseleave",()=>{

        producto.style.transform="scale(1)";

    });

});

/*==========================================
    MENSAJE DE BIENVENIDA
==========================================*/

window.onload=()=>{

    console.log("Bienvenido a Santería Luz Divina");

}
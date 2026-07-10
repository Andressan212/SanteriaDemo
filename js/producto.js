/*==============================
    CAMBIAR IMAGEN
==============================*/

const imagenPrincipal = document.getElementById("imagenPrincipal");
const miniaturas = document.querySelectorAll(".miniaturas img");

miniaturas.forEach(img => {

    img.addEventListener("click", () => {

        imagenPrincipal.src = img.src;

    });

});

/*==============================
    CARRITO
==============================*/

let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const botonCarrito = document.getElementById("carritoBtn");

if (botonCarrito) {

    botonCarrito.addEventListener("click", agregarProducto);

}

function agregarProducto() {

    const nombre = document.querySelector(".detalle h1").textContent;

    const precio = parseFloat(
        document.querySelector(".detalle h2")
        .textContent.replace("$","")
    );

    const cantidad = parseInt(
        document.querySelector(".detalle input").value
    );

    const imagen = imagenPrincipal.src;

    const producto = {

        id: Date.now(),

        nombre,

        precio,

        cantidad,

        imagen

    };

    carrito.push(producto);

    localStorage.setItem("carrito", JSON.stringify(carrito));

    actualizarContador();

    alert("Producto agregado al carrito.");

}

/*==============================
    CONTADOR
==============================*/

function actualizarContador(){

    const contador=document.getElementById("contadorCarrito");

    if(contador){

        contador.innerHTML=carrito.length;

    }

}

actualizarContador();

/*==============================
    COMPRAR
==============================*/

const comprar=document.getElementById("comprar");

if(comprar){

comprar.addEventListener("click",()=>{

agregarProducto();

window.location="carrito.html";

});

}

/*==============================
    FAVORITO
==============================*/

let favoritos=JSON.parse(localStorage.getItem("favoritos")) || [];

function favorito(){

const nombre=document.querySelector(".detalle h1").innerText;

if(!favoritos.includes(nombre)){

favoritos.push(nombre);

localStorage.setItem("favoritos",JSON.stringify(favoritos));

alert("Producto agregado a favoritos.");

}

}

/*==============================
    STOCK
==============================*/

const cantidad=document.querySelector(".detalle input");

cantidad.addEventListener("change",()=>{

if(cantidad.value<1){

cantidad.value=1;

}

if(cantidad.value>50){

cantidad.value=50;

}

});

/*==============================
    COMPARTIR
==============================*/

function compartir(){

const url=window.location.href;

window.open(

"https://wa.me/?text="+encodeURIComponent(url),

"_blank"

);

}

/*==============================
    ZOOM
==============================*/

imagenPrincipal.addEventListener("mousemove",(e)=>{

const x=(e.offsetX/e.target.offsetWidth)*100;

const y=(e.offsetY/e.target.offsetHeight)*100;

imagenPrincipal.style.transformOrigin=x+"% "+y+"%";

});

imagenPrincipal.addEventListener("mouseenter",()=>{

imagenPrincipal.style.transform="scale(2)";

});

imagenPrincipal.addEventListener("mouseleave",()=>{

imagenPrincipal.style.transform="scale(1)";

});

/*==============================
    PRODUCTOS RELACIONADOS
==============================*/

const relacionados=document.querySelectorAll(".relacionados button");

relacionados.forEach(btn=>{

btn.addEventListener("click",()=>{

window.location="producto.html";

});

});

/*==============================
    FINAL
==============================*/

console.log("Producto cargado correctamente.");

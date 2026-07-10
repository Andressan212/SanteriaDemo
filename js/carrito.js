/*=====================================
        CARRITO.JS
======================================*/

let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

const lista = document.getElementById("listaCarrito");
const subtotal = document.getElementById("subtotal");
const iva = document.getElementById("iva");
const total = document.getElementById("total");

/*=====================================
        MOSTRAR CARRITO
======================================*/

function mostrarCarrito(){

    if(!lista) return;

    lista.innerHTML="";

    carrito.forEach((producto,index)=>{

        let precio = Number(producto.precio);

        let cantidad = producto.cantidad || 1;

        let sub = precio * cantidad;

        lista.innerHTML += `

        <tr>

            <td>

                <img src="${producto.imagen}" width="80">

            </td>

            <td>

                ${producto.nombre}

            </td>

            <td>

                $${precio}

            </td>

            <td>

                <input
                    type="number"
                    min="1"
                    value="${cantidad}"
                    onchange="cambiarCantidad(${index},this.value)">

            </td>

            <td>

                $${sub}

            </td>

            <td>

                <button
                    class="eliminar"
                    onclick="eliminarProducto(${index})">

                    🗑

                </button>

            </td>

        </tr>

        `;

    });

    calcularTotales();

}

mostrarCarrito();

/*=====================================
        CALCULAR TOTALES
======================================*/

function calcularTotales(){

    let sub = 0;

    carrito.forEach(producto=>{

        let precio = Number(producto.precio);

        let cantidad = producto.cantidad || 1;

        sub += precio * cantidad;

    });

    let impuesto = sub * 0.21;

    let totalFinal = sub + impuesto;

    subtotal.innerHTML = "$" + sub.toFixed(2);

    iva.innerHTML = "$" + impuesto.toFixed(2);

    total.innerHTML = "$" + totalFinal.toFixed(2);

}

/*=====================================
        CAMBIAR CANTIDAD
======================================*/

function cambiarCantidad(indice,cantidad){

    carrito[indice].cantidad = parseInt(cantidad);

    localStorage.setItem(

        "carrito",

        JSON.stringify(carrito)

    );

    mostrarCarrito();

}

/*=====================================
        ELIMINAR
======================================*/

function eliminarProducto(indice){

    carrito.splice(indice,1);

    localStorage.setItem(

        "carrito",

        JSON.stringify(carrito)

    );

    mostrarCarrito();

    actualizarContador();

}

/*=====================================
        VACIAR
======================================*/

const vaciar=document.getElementById("vaciar");

if(vaciar){

vaciar.onclick=()=>{

if(confirm("¿Vaciar carrito?")){

carrito=[];

localStorage.setItem(

"carrito",

JSON.stringify(carrito)

);

mostrarCarrito();

actualizarContador();

}

}

}

/*=====================================
        COMPRAR
======================================*/

const comprar=document.getElementById("comprar");

if(comprar){

comprar.onclick=()=>{

if(carrito.length==0){

alert("El carrito está vacío.");

return;

}

alert("Compra realizada correctamente.");

carrito=[];

localStorage.setItem(

"carrito",

JSON.stringify(carrito)

);

mostrarCarrito();

actualizarContador();

}

}

/*=====================================
        CONTADOR
======================================*/

function actualizarContador(){

const contador=document.getElementById("contadorCarrito");

if(contador){

contador.innerHTML=carrito.length;

}

}

actualizarContador();

/*=====================================
        FINAL
======================================*/

console.log("Carrito cargado correctamente.");
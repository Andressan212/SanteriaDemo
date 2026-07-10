/*=====================================
    BASE DE VENTAS
=====================================*/

let ventas = JSON.parse(localStorage.getItem("ventas")) || [];

/*=====================================
    ELEMENTOS
=====================================*/

const tabla = document.getElementById("tablaVentas");

/*=====================================
    REGISTRAR VENTA
=====================================*/

function registrarVenta(){

    let cliente = document.getElementById("cliente").value;
    let producto = document.getElementById("producto").value;
    let cantidad = parseInt(document.getElementById("cantidad").value);
    let precio = parseFloat(document.getElementById("precio").value);

    if(!cliente || !producto || !cantidad || !precio){

        alert("Completa todos los campos");
        return;

    }

    let total = cantidad * precio;

    let venta = {

        id: Date.now(),
        cliente,
        producto,
        cantidad,
        precio,
        total,
        fecha: new Date().toLocaleString()

    };

    ventas.push(venta);

    localStorage.setItem("ventas", JSON.stringify(ventas));

    limpiar();

    mostrar();

}

/*=====================================
    MOSTRAR VENTAS
=====================================*/

function mostrar(){

    if(!tabla) return;

    tabla.innerHTML = "";

    ventas.forEach(v=>{

        tabla.innerHTML += `

        <tr>

            <td>${v.cliente}</td>
            <td>${v.producto}</td>
            <td>${v.cantidad}</td>
            <td>$${v.total}</td>
            <td>${v.fecha}</td>

        </tr>

        `;

    });

}

mostrar();

/*=====================================
    LIMPIAR FORM
=====================================*/

function limpiar(){

    document.getElementById("cliente").value = "";
    document.getElementById("producto").value = "";
    document.getElementById("cantidad").value = "";
    document.getElementById("precio").value = "";

}

/*=====================================
    INICIO
=====================================*/

console.log("Ventas cargadas correctamente");
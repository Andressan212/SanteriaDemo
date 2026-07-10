/*=====================================
    BASE DE DATOS LOCAL
=====================================*/

let productos = JSON.parse(localStorage.getItem("productos")) || [];

/*=====================================
    ELEMENTOS
=====================================*/

const tabla = document.getElementById("tablaProductos");

/*=====================================
    GUARDAR PRODUCTO
=====================================*/

function guardarProducto(){

    let nombre = document.getElementById("nombre").value;
    let categoria = document.getElementById("categoria").value;
    let precioCompra = parseFloat(document.getElementById("precioCompra").value);
    let precioVenta = parseFloat(document.getElementById("precioVenta").value);
    let stock = parseInt(document.getElementById("stock").value);

    if(!nombre || !categoria){

        alert("Completa los campos");
        return;

    }

    let producto = {

        id: Date.now(),
        nombre,
        categoria,
        precioCompra,
        precioVenta,
        stock

    };

    productos.push(producto);

    localStorage.setItem("productos", JSON.stringify(productos));

    limpiar();

    mostrar();

}

/*=====================================
    MOSTRAR PRODUCTOS
=====================================*/

function mostrar(){

    if(!tabla) return;

    tabla.innerHTML = "";

    productos.forEach((p,index)=>{

        tabla.innerHTML += `

        <tr>

            <td>${p.nombre}</td>
            <td>${p.categoria}</td>
            <td>$${p.precioCompra}</td>
            <td>$${p.precioVenta}</td>
            <td>${p.stock}</td>

            <td>

                <button onclick="editar(${index})">✏️</button>
                <button onclick="eliminar(${index})">🗑</button>

            </td>

        </tr>

        `;

    });

}

mostrar();

/*=====================================
    EDITAR
=====================================*/

function editar(index){

    let p = productos[index];

    document.getElementById("nombre").value = p.nombre;
    document.getElementById("categoria").value = p.categoria;
    document.getElementById("precioCompra").value = p.precioCompra;
    document.getElementById("precioVenta").value = p.precioVenta;
    document.getElementById("stock").value = p.stock;

    eliminar(index);

}

/*=====================================
    ELIMINAR
=====================================*/

function eliminar(index){

    productos.splice(index,1);

    localStorage.setItem("productos", JSON.stringify(productos));

    mostrar();

}

/*=====================================
    LIMPIAR FORM
=====================================*/

function limpiar(){

    document.getElementById("nombre").value = "";
    document.getElementById("categoria").value = "";
    document.getElementById("precioCompra").value = "";
    document.getElementById("precioVenta").value = "";
    document.getElementById("stock").value = "";

}

/*=====================================
    INICIO
=====================================*/

console.log("Productos cargados correctamente");
/*=====================================
    INVENTARIO
=====================================*/

let productos = JSON.parse(localStorage.getItem("productos")) || [];

const tabla = document.getElementById("tablaInventario");

/*=====================================
    MOSTRAR INVENTARIO
=====================================*/

function mostrarInventario(){

    if(!tabla) return;

    tabla.innerHTML = "";

    productos.forEach(p=>{

        let estado = "";

        if(p.stock <= 0){
            estado = "🔴 Sin stock";
        }else if(p.stock <= 5){
            estado = "🟡 Bajo";
        }else{
            estado = "🟢 Disponible";
        }

        tabla.innerHTML += `

        <tr>

            <td>${p.nombre}</td>
            <td>${p.categoria}</td>
            <td>${p.stock}</td>
            <td>${estado}</td>

        </tr>

        `;

    });

}

mostrarInventario();

/*=====================================
    ACTUALIZAR DESDE VENTAS
=====================================*/

function actualizarStockDesdeVentas(){

    let ventas = JSON.parse(localStorage.getItem("ventas")) || [];

    ventas.forEach(v=>{

        let producto = productos.find(p => p.nombre === v.producto);

        if(producto){

            producto.stock -= v.cantidad;

            if(producto.stock < 0){
                producto.stock = 0;
            }

        }

    });

    localStorage.setItem("productos", JSON.stringify(productos));

    mostrarInventario();

}

/*=====================================
    INICIAR
=====================================*/

actualizarStockDesdeVentas();

console.log("Inventario cargado correctamente");
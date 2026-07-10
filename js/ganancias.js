/*=====================================
    GANANCIAS
=====================================*/

let ventas = JSON.parse(localStorage.getItem("ventas")) || [];
let productos = JSON.parse(localStorage.getItem("productos")) || [];

/*=====================================
    ELEMENTOS
=====================================*/

const totalVentasEl = document.getElementById("totalVentas");
const totalCostoEl = document.getElementById("totalCosto");
const gananciaEl = document.getElementById("ganancia");

/*=====================================
    CALCULAR GANANCIAS
=====================================*/

function calcularGanancias(){

    let totalVentas = 0;
    let totalCosto = 0;

    ventas.forEach(v => {

        totalVentas += v.total;

        let producto = productos.find(p => p.nombre === v.producto);

        if(producto){

            totalCosto += producto.precioCompra * v.cantidad;

        }

    });

    let ganancia = totalVentas - totalCosto;

    if(totalVentasEl) totalVentasEl.innerHTML = "$" + totalVentas.toFixed(2);
    if(totalCostoEl) totalCostoEl.innerHTML = "$" + totalCosto.toFixed(2);
    if(gananciaEl) gananciaEl.innerHTML = "$" + ganancia.toFixed(2);

}

/*=====================================
    INICIAR
=====================================*/

calcularGanancias();

console.log("Ganancias calculadas correctamente");
fetch("../api/dashboard.php")

.then(res=>res.json())

.then(datos=>{

let dias=[];

let ventas=[];

datos.forEach(d=>{

dias.push(d.dia);

ventas.push(d.total);

});

new Chart(

document.getElementById("ventasChart"),

{

type:"bar",

data:{

labels:dias,

datasets:[{

label:"Ventas",

data:ventas,

backgroundColor:"#d4af37",

borderColor:"#111",

borderWidth:2

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:true

}

}

}

}

);

});
/*==========================================
        TITULO DEL CATALOGO
==========================================*/

.tituloCatalogo{

padding:60px;

text-align:center;

background:linear-gradient(135deg,#111,#222,#333);

color:white;

}

.tituloCatalogo h1{

font-size:50px;

margin-bottom:15px;

letter-spacing:2px;

}

.tituloCatalogo p{

font-size:18px;

opacity:.9;

}

/*==========================================
            FILTROS
==========================================*/

.filtros{

display:flex;

justify-content:center;

align-items:center;

flex-wrap:wrap;

gap:20px;

padding:40px;

background:white;

box-shadow:0 5px 15px rgba(0,0,0,.10);

}

.filtros input{

width:350px;

padding:15px;

border:2px solid #d4af37;

border-radius:8px;

font-size:16px;

outline:none;

transition:.3s;

}

.filtros input:focus{

box-shadow:0 0 15px rgba(212,175,55,.5);

}

.filtros select{

padding:15px;

border-radius:8px;

border:2px solid #d4af37;

cursor:pointer;

font-size:16px;

}

/*==========================================
        GRID PRODUCTOS
==========================================*/

.gridProductos{

display:grid;

grid-template-columns:repeat(auto-fit,minmax(280px,1fr));

gap:35px;

padding:50px;

}

/*==========================================
        TARJETA
==========================================*/

.producto{

position:relative;

overflow:hidden;

background:white;

border-radius:18px;

box-shadow:0 8px 25px rgba(0,0,0,.15);

transition:.4s;

}

.producto:hover{

transform:translateY(-10px);

box-shadow:0 20px 40px rgba(0,0,0,.25);

}

/*==========================================
        IMAGEN
==========================================*/

.producto img{

width:100%;

height:280px;

object-fit:cover;

transition:.5s;

}

.producto:hover img{

transform:scale(1.12);

}

/*==========================================
        ETIQUETAS
==========================================*/

.etiqueta{

position:absolute;

top:15px;

left:15px;

padding:8px 15px;

border-radius:30px;

font-size:13px;

font-weight:bold;

color:white;

z-index:10;

}

.oferta{

background:#e53935;

}

.nuevo{

background:#2e7d32;

}

.vendido{

background:#1565c0;

}

/*==========================================
        INFORMACION
==========================================*/

.infoProducto{

padding:20px;

}

.infoProducto h3{

font-size:23px;

margin-bottom:10px;

}

.infoProducto p{

color:#666;

margin-bottom:15px;

line-height:25px;

}

/*==========================================
        PRECIOS
==========================================*/

.precios{

display:flex;

align-items:center;

gap:15px;

margin-bottom:15px;

}

.precioAnterior{

text-decoration:line-through;

color:#888;

font-size:18px;

}

.precio{

font-size:30px;

color:#b8860b;

font-weight:bold;

}

/*==========================================
        ESTRELLAS
==========================================*/

.estrellas{

color:#ffc107;

font-size:20px;

margin-bottom:20px;

}

/*==========================================
        BOTONES
==========================================*/

.botonesProducto{

display:flex;

gap:10px;

}

.botonesProducto button{

flex:1;

padding:14px;

border:none;

border-radius:8px;

cursor:pointer;

font-size:15px;

font-weight:bold;

transition:.3s;

}

.botonesProducto button:first-child{

background:#111;

color:white;

}

.botonesProducto button:last-child{

background:#d4af37;

color:#111;

}

.botonesProducto button:hover{

transform:scale(1.05);

}

/*==========================================
        FAVORITO
==========================================*/

.favorito{

position:absolute;

right:20px;

top:20px;

width:45px;

height:45px;

background:white;

border-radius:50%;

display:flex;

justify-content:center;

align-items:center;

font-size:20px;

cursor:pointer;

transition:.4s;

box-shadow:0 5px 15px rgba(0,0,0,.2);

}

.favorito:hover{

background:red;

color:white;

}

/*==========================================
        DESCRIPCION HOVER
==========================================*/

.overlay{

position:absolute;

bottom:-100%;

left:0;

width:100%;

height:100%;

background:rgba(0,0,0,.82);

display:flex;

flex-direction:column;

justify-content:center;

align-items:center;

color:white;

transition:.5s;

padding:30px;

text-align:center;

}

.producto:hover .overlay{

bottom:0;

}

.overlay h3{

margin-bottom:15px;

font-size:28px;

}

.overlay p{

margin-bottom:20px;

line-height:28px;

}

.overlay button{

padding:15px 30px;

border:none;

background:#d4af37;

border-radius:8px;

cursor:pointer;

font-weight:bold;

}

/*==========================================
        PAGINACION
==========================================*/

.paginacion{

display:flex;

justify-content:center;

gap:15px;

padding:40px;

}

.paginacion button{

width:45px;

height:45px;

border:none;

background:#111;

color:white;

border-radius:8px;

cursor:pointer;

transition:.3s;

}

.paginacion button:hover{

background:#d4af37;

color:#111;

}

/*==========================================
        ANIMACION
==========================================*/

@keyframes aparecer{

0%{

opacity:0;

transform:translateY(30px);

}

100%{

opacity:1;

transform:translateY(0);

}

}

.producto{

animation:aparecer .7s;

}
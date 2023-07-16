let paso=1;const pasoInicial=1,pasoFinal=4,productoSeleccionado={idcliente:"",idproducto:"",nombre:"",tipo:"",color:"",talla:"",cantidad:"",costo_unidad:"",descripcion:"",imagen:"",carrito:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaAnterior(),paginaSiguiente(),consultarAPI(),nombreCliente(),idCliente()}function nombreCliente(){}function idCliente(){productoSeleccionado.idcliente=document.querySelector("#id").value}function mostrarSeccion(){const o=document.querySelector("#producto-seleccionado");o.classList.remove("mostrar"),o.classList.add("ocultar");const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const e=document.querySelector(".actual");e&&e.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(o=>{o.addEventListener("click",(function(o){paso=parseInt(o.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const o=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(o.classList.add("ocultar"),t.classList.remove("ocultar")):4===paso?(o.classList.remove("ocultar"),t.classList.add("ocultar")):(o.classList.remove("ocultar"),t.classList.remove("ocultar")),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=4||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const o="https://whispering-temple-36485.herokuapp.com/api/productos",t=await fetch(o);mostrarProductos(await t.json())}catch(o){console.log(o)}}function mostrarProductos(o){const t=o;let e=0;o.forEach(o=>{const{id:c,nombre:n,tipo:a,color:r,talla:d,cantidad:s,costo_unidad:i,descripcion:u,imagen:l}=o,p=document.createElement("P");p.classList.add("nombre-producto"),p.textContent=n;const m=document.createElement("P");m.classList.add("tipo-producto"),m.textContent=a;const S=document.createElement("P");S.classList.add("color-producto"),S.textContent=r;const L=document.createElement("P");L.classList.add("talla-producto"),L.textContent=d;const g=document.createElement("P");g.classList.add("cantidad-producto"),g.textContent=s;const b=document.createElement("P");b.classList.add("costo-producto"),b.textContent="$"+i;const y=document.createElement("P");y.classList.add("descripcion-producto"),y.textContent=u;const f=document.createElement("IMG");f.setAttribute("src","build/img/"+l),f.textContent=l;const h=document.createElement("DIV");h.classList.add("productos"),h.dataset.idproductos=c,h.onclick=function(){seleccionarProducto(o)},h.appendChild(p),h.appendChild(f),h.appendChild(m),h.appendChild(b);productosRepetidos(t,n,e)>=2&&h.classList.add("ocultar-producto"),e++,"Hombre"==a?document.querySelector("#productos-hombre").appendChild(h):"Mujer"==a?document.querySelector("#productos-mujer").appendChild(h):"Niños"==a&&document.querySelector("#productos-niños").appendChild(h)})}function seleccionarProducto(o){const t=document.querySelector("#producto-seleccionado"),e=document.querySelector("#inicial"),c=document.querySelector("#anterior"),n=document.querySelector("#siguiente");c.remove("mostrar"),c.classList.add("ocultar"),n.remove("mostrar"),n.classList.add("ocultar"),e.classList.remove("mostrar"),e.classList.add("ocultar"),t.classList.remove("ocultar"),t.classList.add("mostrar");document.querySelector("#nombre-producto").setAttribute("value",""+o.nombre);document.querySelector("#imagen-producto").setAttribute("src","build/img/"+o.imagen);document.querySelector("#color-producto").setAttribute("value","verde");document.querySelector("#costo-unidad").setAttribute("value",""+o.costo_unidad),document.getElementById("descripcion-producto").innerHTML=""+o.descripcion;document.querySelector("#agregar-carrito").addEventListener("click",(async function(t){o.color=document.querySelector("#color-producto").value,o.talla=document.querySelector("#talla-producto").value,o.cantidad=document.querySelector("#cantidad-producto").value,productoSeleccionado.idproducto=o.id;const{carrito:e}=productoSeleccionado;productoSeleccionado.carrito=[...e,o];const c=new FormData;c.append("idcliente",productoSeleccionado.idcliente),c.append("nombre",o.nombre),c.append("color",o.color),c.append("talla",o.talla),c.append("idproducto",productoSeleccionado.idproducto),c.append("cantidad",o.cantidad??"1"),c.append("fecha_pedido",(new Date).toLocaleDateString("zh-Hans-CN")),console.log([...c]);const n=await fetch("https://whispering-temple-36485.herokuapp.com/api/pedidos",{method:"POST",body:c}),a=await n.json();console.log(a),a?(alert("Pedido Registrado con Exito"),window.location.href="https://whispering-temple-36485.herokuapp.com/nuestrosProductos"):alert("NO contamos con existencias disponibles")}))}function productosRepetidos(o,t,e){let c=0;for(let n=0;n<=e;n++){const e=o[n],{nombre:a}=e;if(t==a&&c++,c>=2)break}return c}document.addEventListener("DOMContentLoaded",(function(){mostrarSeccion(),iniciarApp()}));
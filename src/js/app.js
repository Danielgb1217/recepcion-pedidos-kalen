// let paso = 1;
// const pasoInicial = 1;
// const pasoFinal = 4;
// const productoSeleccionado = {      //objeto creado con los valores en inciar app
//     idcliente: '',
//     idproducto:'',
//     nombre: '',
//     tipo: '',
//     color: '',
//     talla: '',
//     cantidad: '',
//     costo_unidad: '',
//     descripcion: '',
//     imagen: '',
//     carrito: []
// }

// document.addEventListener('DOMContentLoaded', function(){   //Cuando el dom este cargado ejecuto la funcion que llama al metodo inicarApp
    
//     mostrarSeccion();
//     iniciarApp();
    

// });

// function iniciarApp(){
   
//     mostrarSeccion();
//     tabs(); //cambio la seccion cuando se presionen los tabs
//     botonesPaginador(); //Quita o pone los botones
//     paginaAnterior();
//     paginaSiguiente();
//      //consultar el servicio de la aip en el backend
//     consultarAPI();
//     nombreCliente();
//     idCliente();        //anade los valores al objeto producto seleccionado

// }

// function nombreCliente(){
//     // productoSeleccionado.nombre = document.querySelector('#nombre'). value; //valor del nombre del cliente en la vista
// }

// function idCliente(){
//     productoSeleccionado.idcliente = document.querySelector('#id').value;
// }


// function mostrarSeccion(){

//     const seleccion = document.querySelector('#producto-seleccionado');
//     seleccion.classList.remove('mostrar');
//     seleccion.classList.add('ocultar');

//     //seleccion la seccion con el paso...utilizo un template string y agrego una variable dinamicamente en la seleccion

//     //oculto las que tengan la clase de mostrar
//     const seccionAnterior = document.querySelector('.mostrar');

//     if(seccionAnterior){
//         seccionAnterior.classList.remove('mostrar');
//     }

//     const seccion = document.querySelector(`#paso-${paso}`);    //identifica el elmento html con el id(paso-2) y dinamicamente con la variable que se le dio click
//     seccion.classList.add('mostrar');   //Agrega una clase al elemento seleccionado

//     //Quitar la clase de actual al tab Anterior
//     const tabAnterior = document.querySelector('.actual');
//     if(tabAnterior){
//         tabAnterior.classList.remove('actual');
//     }
    
//     //Resalta el tab actual
//     const tab = document.querySelector(`[data-paso="${paso}"]`);
//     tab.classList.add('actual');

// }

// function tabs(){

//     const botones = document.querySelectorAll('.tabs button');      //selecciona los elemnetos (todos)--> clase y boton
//     //debe recorre uno por uno con el asseventlistener para detectar el click por que esta funcion solo funciona para un elemente

//     //No se puede asociar un eventelistener a una coleecion pero se puede iterar sobre ella e ir asociando uno por uno
//     botones.forEach(boton => {
//         boton.addEventListener('click', function(e) {   //evento que se va a registrar
//             paso = parseInt(e.target.dataset.paso); //con el dataset puedo acceder a los atributos que creo en el html
//             mostrarSeccion();
//             botonesPaginador();

//         });
//     })

// }

// function botonesPaginador() {

//     const paginaAnterior = document.querySelector('#anterior');
//     const paginaSiguiente = document.querySelector('#siguiente');

//     if(paso === 1){
//         paginaAnterior.classList.add('ocultar');
//         paginaSiguiente.classList.remove('ocultar');

//     }else if(paso ===4){
//         paginaAnterior.classList.remove('ocultar');
//         paginaSiguiente.classList.add('ocultar');
//     }else{
//         paginaAnterior.classList.remove('ocultar');
//         paginaSiguiente.classList.remove('ocultar');
//     }

//     mostrarSeccion();

// }

// function paginaAnterior(){
//     const paginaAnterior = document.querySelector('#anterior');
//     paginaAnterior.addEventListener('click', function(){

//         if(paso <= pasoInicial) return;
//         paso--;
//         botonesPaginador();
//         mostrarSeccion
//     })
// }

// function paginaSiguiente() {
//     const paginaSiguiente = document.querySelector('#siguiente');
//     paginaSiguiente.addEventListener('click', function(){

//         if(paso >= pasoFinal) return;
//         paso++;
//         botonesPaginador();

//     })

// }

// async function consultarAPI(){  //permite ejecutar esta funcion en paralelo con los demas por si tienes retardos mejorar el performance
//     // const url = 'http://localhost:3000/api/productos'; 
//     try {
//         const url = 'http://localhost:3000/api/productos';  //CONSULTAMOS LA BASE DE DATOS  API//url que voy a consumir la que tinen el api
//         const resultado = await  fetch(url); //OBTENEMOS LOS RESULTADOS COMO JSON funcion que permite consumir el servicio  el await permite esperar a que a funcion
//         const productos = await resultado.json();                                                 // fetch consuma el servisio y obtenga todo lo que hay en url para continuar con la ejecuion de la funcion
        
//         mostrarProductos(productos);

//     } catch (error) {
//         console.log(error);
        
//     }
// }

// function mostrarProductos(productos){

//         const productosA = productos;   //variables para el metodo que valida nombres de productos iguales para no mostrarlos todos
//         let i = 0;

//         productos.forEach( productos =>{

//         const {id, nombre, tipo, color, talla, cantidad, costo_unidad, descripcion, imagen} = productos;             
        
//         const nombreProducto = document.createElement('P');
//         nombreProducto.classList.add('nombre-producto');
//         nombreProducto.textContent = nombre;

//         const tipoProducto = document.createElement('P');
//         tipoProducto.classList.add('tipo-producto');
//         tipoProducto.textContent = tipo;

//         const colorProducto = document.createElement('P');
//         colorProducto.classList.add('color-producto');
//         colorProducto.textContent = color;

//         const tallaProducto = document.createElement('P');
//         tallaProducto.classList.add('talla-producto');
//         tallaProducto.textContent = talla;

//         const cantidadProducto = document.createElement('P');
//         cantidadProducto.classList.add('cantidad-producto');
//         cantidadProducto.textContent = cantidad;

//         const costoProducto = document.createElement('P');
//         costoProducto.classList.add('costo-producto');
//         costoProducto.textContent = `$${costo_unidad}`;

//         const descripcionProducto = document.createElement('P');
//         descripcionProducto.classList.add('descripcion-producto');
//         descripcionProducto.textContent = descripcion;

//         const imagenProducto = document.createElement('IMG');
//         imagenProducto.setAttribute('src', `build/img/${imagen}`);
//         imagenProducto.textContent = imagen;

//         const productosDiv = document.createElement('DIV');
//         productosDiv.classList.add('productos');
//         productosDiv.dataset.idproductos = id;
//         productosDiv.onclick = function(){
//             seleccionarProducto(productos);
            
//         };   //funcion que se ejecutara cuando  DE CLICK EN ESTE DIV

//         // const pedidosDiv = document.querySelector('#pedido');        
//         // pedidosDiv.dataset.idproductos = id;
//         // pedidosDiv.onclick = function(){
//         //     console.log('click')
//         //     seleccionarProducto(productos);            
//         // };   //funcion que se ejecutara cuando  DE CLICK EN ESTE DIV



//         productosDiv.appendChild(nombreProducto);            
//         productosDiv.appendChild(imagenProducto);
//         productosDiv.appendChild(tipoProducto);
//         productosDiv.appendChild(costoProducto);
//         //productosDiv.appendChild(colorProducto);
//         //productosDiv.appendChild(tallaProducto);
//         //productosDiv.appendChild(cantidadProducto);
        
//         //-------------------------validacion de imagen repetida------------------------------------------------------
//         let cont =0;
//         if(productosRepetidos(productosA, nombre, i) >= 2){  //Validar si el nombre del producto ya existe para no volverlo a mostrar (solo debe varias caracteristicas)
//             productosDiv.classList.add('ocultar-producto');   //agrega clase para eliminar el div que contiene el elmento repetido           
//         }           
//         i++;    //me permite emplear el metodo de busqueda hasta el objeto presente y que no recorra todos los objetos del arreglo
//         //console.log(productos);

//         //-----------------------------------------------------------------------------------------------------------
//         //ingresa la informacion en el div con el id productos en la vista nuestros productos

//         if( tipo == 'Hombre'){ document.querySelector('#productos-hombre').appendChild(productosDiv);}
//         else if( tipo == 'Mujer'){document.querySelector('#productos-mujer').appendChild(productosDiv); }
//         else if( tipo == 'Niños'){document.querySelector('#productos-niños').appendChild(productosDiv); }

//         });
// }

// function seleccionarProducto(productos){    
    
//         const seleccion = document.querySelector('#producto-seleccionado');
//         const inicial = document.querySelector('#inicial');

//         const paginaAnterior = document.querySelector('#anterior');
//         const paginaSiguiente = document.querySelector('#siguiente');
//         paginaAnterior.remove('mostrar');
//         paginaAnterior.classList.add('ocultar');
//         paginaSiguiente.remove('mostrar');
//         paginaSiguiente.classList.add('ocultar');
//         inicial.classList.remove('mostrar');
//         inicial.classList.add('ocultar');
//         seleccion.classList.remove('ocultar');
//         seleccion.classList.add('mostrar');

//         const nameProducto = document.querySelector('#nombre-producto');
//         nameProducto.setAttribute('value', `${productos.nombre}`);

//         const imagenProducto = document.querySelector('#imagen-producto');
//         imagenProducto.setAttribute('src', `build/img/${productos.imagen}`);       
        
//         const colorProducto = document.querySelector('#color-producto');
//         colorProducto.setAttribute('value', 'verde');

//         const costoProducto = document.querySelector('#costo-unidad');
//         costoProducto.setAttribute('value', `${productos.costo_unidad}`);
        
//         document.getElementById('descripcion-producto').innerHTML = `${productos.descripcion}`;

//         const agregarCarrito = document.querySelector('#agregar-carrito');//Evento del boton agregar al carrito de la vista de 
//         agregarCarrito.addEventListener("click", async function(evento){  //detalle del producto

//                 //Apartir de este evento la funcion valida los campos que edita el usuario del producto y hace una consulta en la 
//                 //base de datos si existe el producto deseado, Si es positivo, registra el pedido en la bd de lo ontrario lo rechaza
//                 //el pedido se registra con idcliente, idproducto, cantidad y fecha

//                 //--------------------------------------edicion de el producto por partde del cliente---------------------
                
//                 productos.color = document.querySelector('#color-producto').value;
//                 productos.talla = document.querySelector('#talla-producto').value;
//                 productos.cantidad = document.querySelector('#cantidad-producto').value;  

//                 productoSeleccionado.idproducto = productos.id;
                
//                 const {carrito} = productoSeleccionado; 
//                 productoSeleccionado.carrito= [...carrito,productos];
                    
//                 //-----------------------------------------creacion del objeto form data----------------------------------------------------
                    
//                 const pedido =  new FormData(); //con el form data se construye todo lo que se enviara al servidor
//                 pedido.append('idcliente',productoSeleccionado.idcliente);               
//                 pedido.append('nombre',productos.nombre);    //Estas variables me llenan el objeto post que utilizo en el controlador api
//                 pedido.append('color',productos.color);      //para hacer el llamado a la base de datos y validar que si se encuentre disponible
//                 pedido.append('talla',productos.talla);
//                 pedido.append('idproducto',productoSeleccionado.idproducto);
//                 pedido.append('cantidad',productos.cantidad ?? '1');
//                 pedido.append('fecha_pedido',new Date().toLocaleDateString('zh-Hans-CN'));//formato YYYY-MM-DD
//                 console.log([...pedido]); //express operator toma una copia del from data y lo formatea dentro del arreglo

//                 //peticion hacia la api

//                 const url = 'http://localhost:3000/api/pedidos';
//                 // const url = 'http://localhost:3000/api/pedidos';

//                 //se utiliza el async a wait para detener la ejecucion del codigo por si hay un problema con la ejecucion :/

//                 const respuesta = await fetch(url, {

//                     method: 'POST',  //voy a utilizar un metodo post hacia la url especificada
//                     body: pedido        //cuerpo de la peticion que estamos enviando lo trae del controlador
//                                         //todso estos datos los toma desde el api controller con la counicacion de la api
//                 });

//                 const resultado = await respuesta.json();   //El resultado lo traigo del api controler
//                 console.log(resultado);  //muestra la respuesta al grabar

//                 if(resultado){
//                     alert('Pedido Registrado con Exito');
//                     window.location.href = 'http://localhost:3000/nuestrosProductos';
                
//                 }
//                 else{alert('NO contamos con existencias disponibles');}

//         });


//             // Este codigo agrega objetos a un arreglo cuando se les da click, el arreglo se define como un atributo de la
//             // variable al inicio
//             // const {carrito} = productoSeleccionado;
//             // productoSeleccionado.carrito = [...carrito, productos];
//             // console.log('productoSeleccionado');
//                             // Boton agregar al carrito  

// }

// function productosRepetidos(productosA, nombreP,ip){   
   
//     let cont = 0;       //valida si en la BD existen varios productos con el nombre igual(pero diferentes caracteristicas...color, talla)
//     for (let i = 0; i <= ip; i++) {
//         const producto = productosA[i];        
//         const {nombre} = producto;
//         if(nombreP == nombre){   
//             cont++;}
//         if(cont >= 2){
//             break;
//         }
//     }
//     return cont;

// }
  

let paso = 1;
const pasoInicial = 1;
const pasoFinal = 4;
const productoSeleccionado = {      //objeto creado con los valores en inciar app
    idcliente: '',
    idproducto:'',
    nombre: '',
    tipo: '',
    color: '',
    talla: '',
    cantidad: '',
    costo_unidad: '',
    descripcion: '',
    imagen: '',
    carrito: []
}

document.addEventListener('DOMContentLoaded', function(){   //Cuando el dom este cargado ejecuto la funcion que llama al metodo inicarApp
    
    mostrarSeccion();
    iniciarApp();

});

function iniciarApp(){

    mostrarSeccion();
    tabs(); //cambio la seccion cuando se presionen los tabs
    botonesPaginador(); //Quita o pone los botones
    paginaAnterior();
    paginaSiguiente();
    consultarAPI(); //consultar el servicio de la aip en el backend

    nombreCliente();
    idCliente();        //anade los valores al objeto producto seleccionado

}

function nombreCliente(){
    // productoSeleccionado.nombre = document.querySelector('#nombre'). value; //valor del nombre del cliente en la vista
}

function idCliente(){
    productoSeleccionado.idcliente = document.querySelector('#id').value;
}


function mostrarSeccion(){

    const seleccion = document.querySelector('#producto-seleccionado');
    seleccion.classList.remove('mostrar');
    seleccion.classList.add('ocultar');

    //seleccion la seccion con el paso...utilizo un template string y agrego una variable dinamicamente en la seleccion

    //oculto las que tengan la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');

    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    const seccion = document.querySelector(`#paso-${paso}`);    //identifica el elmento html con el id(paso-2) y dinamicamente con la variable que se le dio click
    seccion.classList.add('mostrar');   //Agrega una clase al elemento seleccionado

    //Quitar la clase de actual al tab Anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
    
    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs(){

    const botones = document.querySelectorAll('.tabs button');      //selecciona los elemnetos (todos)--> clase y boton
    //debe recorre uno por uno con el asseventlistener para detectar el click por que esta funcion solo funciona para un elemente

    //No se puede asociar un eventelistener a una coleecion pero se puede iterar sobre ella e ir asociando uno por uno
    botones.forEach(boton => {
        boton.addEventListener('click', function(e) {   //evento que se va a registrar
            paso = parseInt(e.target.dataset.paso); //con el dataset puedo acceder a los atributos que creo en el html
            mostrarSeccion();
            botonesPaginador();

        });
    })

}

function botonesPaginador() {

    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');

    }else if(paso ===4){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();

}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){

        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
        mostrarSeccion
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){

        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();

    })

}

async function consultarAPI(){  //permite ejecutar esta funcion en paralelo con los demas por si tienes retardos mejorar el performance

    try {
        const url = 'https://whispering-temple-36485.herokuapp.com/api/productos';  //CONSULTAMOS LA BASE DE DATOS  API//url que voy a consumir la que tinen el api
        //const url = 'http://localhost:3000/api/productos';  //CONSULTAMOS LA BASE DE DATOS  API//url que voy a consumir la que tinen el api
        const resultado = await  fetch(url); //OBTENEMOS LOS RESULTADOS COMO JSON funcion que permite consumir el servicio  el await permite esperar a que a funcion
        const productos = await resultado.json();                                                 // fetch consuma el servisio y obtenga todo lo que hay en url para continuar con la ejecuion de la funcion
        
        mostrarProductos(productos);

    } catch (error) {
        console.log(error);
        
    }
}

function mostrarProductos(productos){

        const productosA = productos;   //variables para el metodo que valida nombres de productos iguales para no mostrarlos todos
        let i = 0;

        productos.forEach( productos =>{

        const {id, nombre, tipo, color, talla, cantidad, costo_unidad, descripcion, imagen} = productos;             
        
        const nombreProducto = document.createElement('P');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = nombre;

        const tipoProducto = document.createElement('P');
        tipoProducto.classList.add('tipo-producto');
        tipoProducto.textContent = tipo;

        const colorProducto = document.createElement('P');
        colorProducto.classList.add('color-producto');
        colorProducto.textContent = color;

        const tallaProducto = document.createElement('P');
        tallaProducto.classList.add('talla-producto');
        tallaProducto.textContent = talla;

        const cantidadProducto = document.createElement('P');
        cantidadProducto.classList.add('cantidad-producto');
        cantidadProducto.textContent = cantidad;

        const costoProducto = document.createElement('P');
        costoProducto.classList.add('costo-producto');
        costoProducto.textContent = `$${costo_unidad}`;

        const descripcionProducto = document.createElement('P');
        descripcionProducto.classList.add('descripcion-producto');
        descripcionProducto.textContent = descripcion;

        const imagenProducto = document.createElement('IMG');
        imagenProducto.setAttribute('src', `build/img/${imagen}`);
        imagenProducto.textContent = imagen;

        const productosDiv = document.createElement('DIV');
        productosDiv.classList.add('productos');
        productosDiv.dataset.idproductos = id;
        productosDiv.onclick = function(){
            seleccionarProducto(productos);
            
        };   //funcion que se ejecutara cuando  DE CLICK EN ESTE DIV

        // const pedidosDiv = document.querySelector('#pedido');        
        // pedidosDiv.dataset.idproductos = id;
        // pedidosDiv.onclick = function(){
        //     console.log('click')
        //     seleccionarProducto(productos);            
        // };   //funcion que se ejecutara cuando  DE CLICK EN ESTE DIV



        productosDiv.appendChild(nombreProducto);            
        productosDiv.appendChild(imagenProducto);
        productosDiv.appendChild(tipoProducto);
        productosDiv.appendChild(costoProducto);
        //productosDiv.appendChild(colorProducto);
        //productosDiv.appendChild(tallaProducto);
        //productosDiv.appendChild(cantidadProducto);
        
        //-------------------------validacion de imagen repetida------------------------------------------------------
        let cont =0;
        if(productosRepetidos(productosA, nombre, i) >= 2){  //Validar si el nombre del producto ya existe para no volverlo a mostrar (solo debe varias caracteristicas)
            productosDiv.classList.add('ocultar-producto');   //agrega clase para eliminar el div que contiene el elmento repetido           
        }           
        i++;    //me permite emplear el metodo de busqueda hasta el objeto presente y que no recorra todos los objetos del arreglo
        //console.log(productos);

        //-----------------------------------------------------------------------------------------------------------
        //ingresa la informacion en el div con el id productos en la vista nuestros productos

        if( tipo == 'Hombre'){ document.querySelector('#productos-hombre').appendChild(productosDiv);}
        else if( tipo == 'Mujer'){document.querySelector('#productos-mujer').appendChild(productosDiv); }
        else if( tipo == 'Niños'){document.querySelector('#productos-niños').appendChild(productosDiv); }

        });
}

function seleccionarProducto(productos){    
    
        const seleccion = document.querySelector('#producto-seleccionado');
        const inicial = document.querySelector('#inicial');

        const paginaAnterior = document.querySelector('#anterior');
        const paginaSiguiente = document.querySelector('#siguiente');
        paginaAnterior.remove('mostrar');
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.remove('mostrar');
        paginaSiguiente.classList.add('ocultar');
        inicial.classList.remove('mostrar');
        inicial.classList.add('ocultar');
        seleccion.classList.remove('ocultar');
        seleccion.classList.add('mostrar');

        const nameProducto = document.querySelector('#nombre-producto');
        nameProducto.setAttribute('value', `${productos.nombre}`);

        const imagenProducto = document.querySelector('#imagen-producto');
        imagenProducto.setAttribute('src', `build/img/${productos.imagen}`);       
        
        const colorProducto = document.querySelector('#color-producto');
        colorProducto.setAttribute('value', 'verde');

        const costoProducto = document.querySelector('#costo-unidad');
        costoProducto.setAttribute('value', `${productos.costo_unidad}`);
        
        document.getElementById('descripcion-producto').innerHTML = `${productos.descripcion}`;

        const agregarCarrito = document.querySelector('#agregar-carrito');//Evento del boton agregar al carrito de la vista de 
        agregarCarrito.addEventListener("click", async function(evento){  //detalle del producto

                //Apartir de este evento la funcion valida los campos que edita el usuario del producto y hace una consulta en la 
                //base de datos si existe el producto deseado, Si es positivo, registra el pedido en la bd de lo ontrario lo rechaza
                //el pedido se registra con idcliente, idproducto, cantidad y fecha

                //--------------------------------------edicion de el producto por partde del cliente---------------------
                
                productos.color = document.querySelector('#color-producto').value;
                productos.talla = document.querySelector('#talla-producto').value;
                productos.cantidad = document.querySelector('#cantidad-producto').value;  

                productoSeleccionado.idproducto = productos.id;
                
                const {carrito} = productoSeleccionado; 
                productoSeleccionado.carrito= [...carrito,productos];
                    
                //-----------------------------------------creacion del objeto form data----------------------------------------------------
                    
                const pedido =  new FormData(); //con el form data se construye todo lo que se enviara al servidor
                pedido.append('idcliente',productoSeleccionado.idcliente);               
                pedido.append('nombre',productos.nombre);    //Estas variables me llenan el objeto post que utilizo en el controlador api
                pedido.append('color',productos.color);      //para hacer el llamado a la base de datos y validar que si se encuentre disponible
                pedido.append('talla',productos.talla);
                pedido.append('idproducto',productoSeleccionado.idproducto);
                pedido.append('cantidad',productos.cantidad ?? '1');
                pedido.append('fecha_pedido',new Date().toLocaleDateString('zh-Hans-CN'));//formato YYYY-MM-DD
                console.log([...pedido]); //express operator toma una copia del from data y lo formatea dentro del arreglo

                //peticion hacia la api

                //const url = 'http://localhost:3000/api/pedidos';
                const url = 'https://whispering-temple-36485.herokuapp.com/api/pedidos';

                //se utiliza el async a wait para detener la ejecucion del codigo por si hay un problema con la ejecucion :/

                const respuesta = await fetch(url, {

                    method: 'POST',  //voy a utilizar un metodo post hacia la url especificada
                    body: pedido        //cuerpo de la peticion que estamos enviando lo trae del controlador
                                        //todso estos datos los toma desde el api controller con la counicacion de la api
                });

                const resultado = await respuesta.json();   //El resultado lo traigo del api controler
                console.log(resultado);  //muestra la respuesta al grabar

                if(resultado){
                    alert('Pedido Registrado con Exito');
                    window.location.href = 'https://whispering-temple-36485.herokuapp.com/nuestrosProductos';
                
                }
                else{alert('NO contamos con existencias disponibles');}

        });


            // Este codigo agrega objetos a un arreglo cuando se les da click, el arreglo se define como un atributo de la
            // variable al inicio
            // const {carrito} = productoSeleccionado;
            // productoSeleccionado.carrito = [...carrito, productos];
            // console.log('productoSeleccionado');
                            // Boton agregar al carrito  

}

function productosRepetidos(productosA, nombreP,ip){   
   
    let cont = 0;       //valida si en la BD existen varios productos con el nombre igual(pero diferentes caracteristicas...color, talla)
    for (let i = 0; i <= ip; i++) {
        const producto = productosA[i];        
        const {nombre} = producto;
        if(nombreP == nombre){   
            cont++;}
        if(cont >= 2){
            break;
        }
    }
    return cont;

}

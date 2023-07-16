<div>

<?php 
    include_once __DIR__.'/../templates/cabecera.php';
?>

<div class="bienvenida">
    <p><strong>Hola  <?php echo( " ". $nombre)??" "; ?></strong></p>    
</div>
   
<div id="app">
    <div id=inicial>
        <nav class="tabs">
            <button class="actual" type="button" data-paso="1">Hombre</button>
            <button type="button" data-paso="2">Mujeres</button>
            <button type="button" data-paso="3">Niños</button>
            <button type="button" data-paso="4">Nosotros</button>           
        </nav>

        <div id="paso-1" class="seccion">
            <h2>Hombres</h2>
            <p class="text-center"><strong>Elige los mejores productos para hombres disponibles</strong></p>

            <seccion class="contenedor-productos"> 

            </seccion> 

            <div id="productos-hombre" class="listado-productos">


            </div>
        
        </div>

        <div id="paso-2" class="seccion">
            <h2>Mujeres </h2>
            <p class="text-center" >Ultima coleccion de la moda</p>            
            <seccion class="contenedor-productos">
                   
            </seccion>
            <div id="productos-mujer" class="listado-productos">


            </div>        
        </div>

        <div id="paso-3" class="seccion">
            <h2>Niños</h2>
            <p class="text-center" >Prendas para Niños</p>
            <seccion class="contenedor-productos">
 
            </seccion> 
            <div id="productos-niños" class="listado-productos">
                
            </div>
                
        </div>

        <div id="paso-4" class="seccion">
            <h2>Nosostros </h2>
            <p>Quienes somos?</p>
            <seccion class="contenedor-productos">

            </seccion>        
        </div>

    </div>

    <div class="paginacion">
        <div>
            <button
                id="anterior"
                class="boton-login">&laquo; Atras 
            </button>
        </div>
        <div>
            <button
            id="siguiente"
            class="boton-login"> Siguiente &raquo;
            </button>
        </div>

    </div>
<!---------------------------------------DETALLE DEL PRODUCTO --------------------------Elegir prodcuto por parte del cliente-----> 

    <div id="producto-seleccionado" class="detalle-producto" >    <!--   class="detalle-producto" -->
        <div class="centrar" >     <!-- class="crear-producto" -->
                                    
            <form class="formulario" method="POST" enctype="multipart/form-data" >
                <div class="grid-2">
                <fieldset>
                    <legend><strong><p>Selecciona tu Producto</p></strong></legend>
                    <!--  -->
                    <div class="centrar">
                        <div>
                            <div>
                            <label for="nombre"><strong>Nombre del Producto:</strong></label>
                            </div>
                            <div>
                            <input class="campo-detalle_producto"
                            type="text" 
                            id="nombre-producto" 
                            name="nombre" 
                            placeholder="Nombre del Producto" 
                            disabled/>                        
                            </div>
                            <div>
                            <select name="color" id="color-producto" class="campo-selector_producto">
                                <option disabled selected>-- Color --</option>
                                <option>Gris</option>
                                <option>Blanco</option>
                                <option>Azul</option>
                                <option>Negro</option>
                                <option>Rosado</option>
                            </select>                      
                            </div>
                            <div>
                            <select name="talla" id="talla-producto" class="campo-selector_producto">
                                <option disabled selected>-- Seleccionar Talla --</option>
                                <option>Chica</option>
                                <option>Mediana</option>
                                <option>Grande</option>
                            </select>
                            </div>
                        </div>

                        <div>
                            <div>
                            <label for="cantidad"><center><strong>Cantidad:</strong></center></label>
                            </div>
                            <input id="cantidad-producto" 
                            class="campo-selector_producto" 
                            type="number"
                            value="1" 
                            min="1" max="50" name="cantidad"/>
                        </div>
                    </div>
                    <!-- </div> -->
                    <input type="hidden" class="boton-login" id="id" value="<?php echo $id; ?>">  

                    <!-- Puedo vr la variable id por que la mande desde el controlador a la vista con una variable de sesion -->
                    
                    <!-- <div class="campo">
                        <label for="imagen">Imagen:</label>
                        <input class="campo-selector" type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                    </div> -->
                    


                </fieldset>
                </div>

                <div class="frm-submit">
                    <input id="agregar-carrito" class="boton-login type="submit" value="Agregar al carrito">
                </div>
            </form>
       
        </div>

        <div class="imagen-producto">                    
                                     
            <img id="imagen-producto" loading="lazy" alt="Imagen Producto">



            <div>
                <label  for="costo_unidad"><center><strong>Precio:</strong></center></label>
                <input id="costo-unidad"
                class="campo-detalle_producto" 
                type="number" 
                id="costo_unidad" 
                name="costo_unidad"                 
                disabled/>
             </div>

             <div class="campo">
                        
                        <textarea 
                        id="descripcion-producto" 
                        name="descripcion"
                        rows="5" 
                        cols="80"
                        disabled
                        class="campo-detalle"
                        > </textarea>
                    </div>
                                                 
        </div>

    </div>  <!--DIV id seleccion-productos -->

</div>

 

</div>


<?php
    $script = " <script src='build/js/app.js'></script>"; //CARGO UN SCRIPT PARA ESTA PAGINA   
?>                                                           <!-- lo modifico aqui y en el layout  -->
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

























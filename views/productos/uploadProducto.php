<?php 
    include_once __DIR__.'/../templates/alertas.php';
    include_once __DIR__.'/../templates/cabecera.php';
?>

<a class="icono-compras" href="/admin"><i class="fa-solid fa-circle-left fa-2xl"></i></a>
<h1>Actualizar un Producto</h1>
<center><p>Modifica tu Producto</p></center>
<div>  
        <form method="POST" class="formulario"
            method="POST" 
            enctype="multipart/form-data" 
            action="/uploadProducto">

            
            <div class="actualizar-productos">
                
                <div class="centrar">
                    <div class="ancho-producto">

                        <label for="nombre"><strong>Nombre:</strong></label>
                        <br/>
                        <input class="campo-selector"
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        placeholder="Nombre del Producto" 
                        value="<?php echo s($producto->nombre); ?>"/>              
                    </div>
                    <div>
                        <label for="tipo"><strong>Tipo:</strong></label>
                        <br/>
                        <select name="tipo" id="tipo" class="campo-selector"> 
                            <option selected value="<?php echo($producto->tipo); ?>">-- Tipo --</option>        
                                <option value="Hombre" <?php echo $producto->tipo === 'Hombre' ? 'selected' : '' ?>>Hombre</option>
                                <option value="Mujer" <?php echo $producto->tipo === 'Mujer' ? 'selected' : '' ?>>Mujer</option>
                                <option value="Niños" <?php echo $producto->tipo === 'Niños' ? 'selected' : '' ?>>Niños</option>        
                        </select>
                    </div>
                    <div>
                        <label for="color"><strong>Color:</strong></label>
                        <br/>
                        <select name="color" id="color" class="campo-selector">
                            <option>-->Color<--</option>                  
                            <option <?php echo $producto->color === 'Gris' ? 'selected' : '' ?>>Gris</option>
                            <option <?php echo $producto->color === 'Blanco' ? 'selected' : '' ?>>Blanco</option>
                            <option <?php echo $producto->color === 'Azul' ? 'selected' : '' ?>>Azul</option>
                            <option <?php echo $producto->color === 'Negro' ? 'selected' : '' ?>>Negro</option>
                            <option <?php echo $producto->color === 'Rosado' ? 'selected' : '' ?>>Rosado</option>
                        </select>
                    </div>
            

                    <!-- <div class="campo-actualizar_productos"> -->
                
                    
                    <div>
                        <label for="talla"><strong>Talla:</strong></label>
                        <br/>
                        <select name="talla" id="talla" class="campo-selector">
                            <option >-- Seleccionar Talla --</option>
                            <option <?php echo $producto->talla === 'Chica' ? 'selected' : '' ?> >Chica</option>
                            <option <?php echo $producto->talla === 'Mediana' ? 'selected' : '' ?> >Mediana</option>
                            <option <?php echo $producto->talla === 'Grande' ? 'selected' : '' ?> >Grande</option>
                        </select>
                    </div>
                    <div>
                        <label for="cantidad"><strong>Cantidad:</strong></label>
                        <br/>                        
                        <input class="campo-selector" type="number" placeholder="Cantidad" min="1" max="50" name="cantidad"
                        value="<?php echo s($producto->cantidad); ?>"/>
                    </div>
                </div>

                <div class="centrar">
                    <div>
                        <label for="costo_unidad"><strong>Precio:</strong></label>
                        <br/>                        
                        <input class="campo-selector" 
                        type="number" 
                        id="costo_unidad" 
                        name="costo_unidad" 
                        placeholder="Costo del Producto"
                        value="<?php echo s($producto->costo_unidad); ?>"/>   
                    </div>           
                    <div>
                        <label for="imagen"><strong>Imagen:</strong></label>
                        <br/>                        
                        <input class="selector-ancho_upload" 
                        type="file" 
                        id="imagen" 
                        accept="image/jpeg, image/png" 
                        name="imagen"
                        value="<?php echo $producto->imagen ?>">
                    </div>                        

                    <div>
                        <label for="descripcion"><strong>Descripcion:</strong></label>
                        <br/>                       
                        <textarea class="selector-ancho_upload" 
                            id="descripcion" 
                            name="descripcion"
                            rows="10" 
                            cols="50"
                            ><?php echo s($producto->descripcion); ?>                   
                        </textarea>
                    </div>
                </div>

            </div>

            <div class="frm-submit">
                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                <input class="boton-login" type="submit" value="Cargar">
            </div>
       
        </form>

</div>
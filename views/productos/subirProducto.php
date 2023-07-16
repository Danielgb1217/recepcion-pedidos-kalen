
<?php 
    include_once __DIR__.'/../templates/alertas.php';
    include_once __DIR__.'/../templates/cabecera.php';
?>

<a class="icono-compras" href="/admin"><i class="fa-solid fa-circle-left fa-2xl"></i></a>
<h1>Registrar un Producto</h1>
<center><p>Registra y guarda tu producto en nuestra base de datos</p></center>

<div class="contenedor-imagen_fondo">
    <div class="posicion">
        <img src="build/img/registrar.jpg">
    </div>

    <div class="posicion-rel">
        <form class="formulario" 
            method="POST" 
            enctype="multipart/form-data" 
            action="/subirProducto">

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
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Niños">Niños</option>        
                        </select>
                    </div>

                    <div> 
                        <label for="color"><strong>Color:</strong></label>
                        <br/>
                        <select name="color" id="color" class="campo-selector">
                            <option disabled selected>-- Color --</option>
                            <option>Gris</option>
                            <option>Blanco</option>
                            <option>Azul</option>
                            <option>Negro</option>
                            <option>Rosado</option>
                        </select>
                    </div>

                    <div> 
                        <label for="talla"><strong>Talla:</strong></label>
                        <br/>
                        <select name="talla" id="talla" class="campo-selector">
                            <option disabled selected>-- Seleccionar Talla --</option>
                            <option>Chica</option>
                            <option>Mediana</option>
                            <option>Grande</option>
                        </select>
                    </div>
                        
                    <div> 
                        <label for="cantidad"><strong>Cantidad:</strong></label>
                        <br/>
                        <input class="campo-selector" type="number" placeholder="Cantidad" min="1" max="50" name="cantidad"/>
                    </div>

                </div>
                <div class="centrar">

                    <div> 
                    <label for="cpstp_unidad"><strong>Precio:</strong></label>
                    <br/>
                        <input class="campo-selector" type="number" id="costo_unidad" name="costo_unidad" placeholder="Costo del Producto"/>
                    </div>
                        
                    <div> 
                        <label for="imagen"><strong>Imagen:</strong></label>
                        <br/>
                            <input class="selector-ancho_upload" 
                            type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
                        </div>

                    <div> 
                        <label for="descripcion"><strong>Descripcion:</strong></label>
                        <br/>
                        <textarea class="selector-ancho_upload" 
                        id="descripcion" 
                        name="descripcion"
                        rows="10" 
                        cols="50">Descripcion del Producto </textarea>
                    </div>

                </div>  

            </div>

            <div class="frm-submit">
                <input class="boton-login" type="submit" value="Registrar">
            </div>
        </form>
    </div>
</div>
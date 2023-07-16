<?php 
    include_once __DIR__.'/../templates/alertas.php';   
    include_once __DIR__.'/../templates/cabecera.php';

?>
<div>

    <main class="contenedor-productos">
        <a class="icono-compras" href="/nuestrosProductos"><i class="fa-solid fa-circle-left fa-2xl"></i></a>
    <h1>Carrito de Compras</h1>
    <h2>Productos</h2>

    <div class="<?php echo($display); ?>">
        <div class="carrito-compras">           

            <?php $count = 0; ?>

            <?php foreach( $productos as $producto ): ?> 
                <diV class="fila-tabla">
                    <div>
                        <div class="td">
                            _____________________________________________
                            <p>Color: <?php echo $producto->color; ?> </p>
                        </div>
                        <div class="td">                
                            <p><strong>Talla: </strong><?php echo $producto->talla; ?></p>
                        </div>  
                        <div class="td">
                            <p><strong>Cantidad: </strong><?php echo $resumenPedidos[$count]->cantidad;?></p> 
                        </div>
                        <div class="td">
                            <p><strong>Fecha de Compra: </strong><?php echo $resumenPedidos[$count]->fecha_pedido;?></p> 
                        </div>

                    </div>
                    <div>
                        
                        <div>
                            <form method="POST" action="/carritoCompras" >
                                <input type="hidden" name="id" value="<?php echo $resumenPedidos[$count]->id; ?>">
                                <input type="hidden" name="accion" value="eliminar">
                                <button type="submit" class="boton-pedido"><i class="fa-solid fa-trash-can"></i>Eliminar</button>
                                
                            </form>
                            </div>
                            <div>
                            <form method="POST" action="/carritoCompras" >
                                <input type="hidden" name="idproducto" value="<?php echo $resumenPedidos[$count]->idproducto; ?>">
                                <input type="hidden" name="id" value="<?php echo $resumenPedidos[$count]->id; ?>">
                                <input type="hidden" name="accion" value="update">
                                <button type="submit" class="boton-pedido" value="actualizar">
                                <i class="fa-solid fa-pen-to-square fa-xs"></i>Actualizar</button>
                            </form>
                        </div>
                        <!-- <a href="carritoCompras?x=1<?php echo $producto->id; ?>">Actualizar</a>  -->
                        <!-- <a href="carritoCompras?x=1">Actualizar</a>  LO COMENTE   VALIDAR------------------------------------>     
                    </div>


                </diV>
                <div class="pedido">
                        <?php echo $producto->nombre; ?>                                             
                        <img id="pedido" src="build/img/<?php echo $producto->imagen; ?>" alt="Imagen">          
                    </div>
                <br/>
            
        
            <?php $count++; ?>
            <?php endforeach; ?>
                    
        </div>
        <div>
            <form method="POST" action="/carritoCompras" >
                <input type="hidden" name="accion" value="comprar">
                <input type="submit" class="boton-login" value="Comprar">
            </form>
        </div>
    </div>
            <!-- -------------------------------------------------Actualizar el pedido----------------------------------------------- -->
    <div class="<?php echo $actualizar; ?>" id="window-notice">
        <div class="content">
            <div class="content-text, centrar"> 
                <p><strong>Modifica tu Pedido</strong></p>
                <form class="formulario" method="POST" action="/carritoCompras" >
                    <div class="campo, centrar">

                        <input type="hidden" name="idproducto" value="<?php echo $pedido->idproducto; ?>">
                        <input type="hidden" name="id" value="<?php echo $pedido->id; ?>">                      
                        <div>
                            <!-- <label for="color"><strong>Color:</strong></label> -->
                            <select name="color"  class="campo-selector">
                                <option disabled selected>-- Color --</option>
                                <option>Gris</option>
                                <option>Blanco</option>
                                <option>Azul</option>
                                <option>Negro</option>
                                <option>Rosado</option>
                            </select>
                        </div>
                        <div>
                            <!-- <label>Talla:</label> -->
                            <select name="talla" class="campo-selector">
                                <option disabled selected>-- Seleccionar Talla --</option>
                                <option>Chica</option>
                                <option>Mediana</option>
                                <option>Grande</option>
                            </select>
                        </div>
                        <div>
                            <label for="cantidad" ><strong>Cantidad:</strong></label>
                            <br/>
                            <input 
                            class="campo-selector" 
                            type="number"
                            value="1" 
                            min="1" max="50" name="cantidad"/>
                        </div> 
                        <div>
                            <input type="hidden" name="accion" value="actualizar">
                            <input class="boton-login"  type="submit" value="Actualizar">
                        </div>  
                    </div>    
                </form> 
            </div>

        </div>        
    </div>
    
    </main>
</div>
                                                      
   
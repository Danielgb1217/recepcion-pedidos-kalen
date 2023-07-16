<?php 
    include_once __DIR__.'/../templates/alertas.php';
    
    include_once __DIR__.'/../templates/cabecera.php';

?>

<a class="icono-compras" href="/nuestrosProductos"><i class="fa-solid fa-circle-left fa-2xl"></i></a>
<h1> Administración de Productos</h1>

<div class=<?php echo($modoDisplay); ?>>

    <div class=<?php echo($displayImagen); ?>>
        <img  class="imagen-admin" src="build/img/adminProductos.webp">
    </div>


    <div>

        <div class="flex">
            <div>
                <form method="GET" action="/subirProducto" >
                    <!-- <input type="hidden" name="accion" value="registrar"> -->
                    <button type="submit" class="boton-logout"><i class="fa-solid fa-cash-register"></i>Registrar</button>
                    <!-- <input type="submit" class="boton-login" value="Reg"></input> -->
                </form>
            </div>
            <!-- <div>
                <form>
                    <input type="hidden" name="accion" value="buscar">
                    <input type="submit" class="boton-login" value="Buscar">
                </form>
            </div> -->
        </div>



        
        
            <form class="formulario, centrar" method="POST"  action="/admin">
                                 

                    <div class="input-buscar">
                        <!-- <label for="buscar"><strong>Buscar:</strong></label> -->
                        <input 
                        class="centrar"
                        type="text" 
                        id="buscar" 
                        name="buscar" 
                        placeholder="Buscar por Nombre del Producto"/>
                    </div>
                    <input type="hidden" name="opcion" value="buscar">
                    <button type="submit" class="boton-login"><i class="fa-solid fa-magnifying-glass-arrow-right"></i>Buscar</button>
                
            </form>

         <div class=<?php echo($display); ?>>  
            <div class="tabla-admin">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>                
                            <th>Tipo</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Cantidad</th> 
                            <th>Costo Unidad</th> 
                            <th>Descripcion</th> 
                            <th>Acciones</th>
                        </tr>
                    </thead>
          
                    <tbody> <!-- Mostrar los Resultados -->
                        <?php foreach( $productos as $producto ): ?>                   
                            
                        <tr class="fila-tabla_admin">
                            <!-- <div> -->
                                <div>
                            <td class="td"><?php echo $producto->nombre;?></td> 
                            <!-- </div>
                            <div>                   -->
                            <td class="td"><?php echo $producto->tipo; ?></td> 
                            <!-- </div>  
                            <div></div> -->
                            <td class="td"><?php echo $producto->color; ?></td> 
                            <!-- <div></div> -->
                            <td class="td"><?php echo $producto->talla; ?></td> 
                            <td class="td"><?php echo $producto->cantidad; ?></td> 
                            <td class="td"><?php echo $producto->costo_unidad; ?></td> 
                            <td class="td"><?php echo $producto->descripcion; ?></td> 
                            <td class="td">
                                <form method="POST" action="/admin" >
                                    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                     <input type="hidden" name="accion" value="eliminar">   
                                    <button type="submit" class="boton-pedido"><i class="fa-solid fa-trash-can"></i>Eliminar</button>                          
                                </form>
                                 <form method="POST" action="/uploadProducto"> 
                                     <input type="hidden" name="id" value="<?php echo $producto->id; ?>"> 
                                     <input type="hidden" name="accion" value="uploadProducto"> 
                                    <button type="submit" class="boton-pedido" value="actualizar">
                                    <i class="fa-solid fa-pen-to-square fa-xs"></i>Actualizar</button>
                                </form> 

                                 <!-- <a href="/uploadProducto?id=<?php echo $producto->id; ?>">Modificar</a> -->

                            </td> 

                            </div>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div> 
      


    </div>

</div>
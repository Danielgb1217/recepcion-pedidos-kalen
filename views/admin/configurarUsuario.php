<?php 
    include_once __DIR__.'/../templates/alertas.php';
    include_once __DIR__.'/../templates/cabecera.php';
?>

<div >
    <main>
        <div>            
            <form class="formulario, centrar" method="POST" action="/configurarUsuarios">
                <div class="cabecero-usuarios">
                    <div>
                        <label><strong>Buscar por Correo:</strong></label>
                        <input class="selector-ancho_upload" type="text" id="email" name="email" placeholder="email del cliente"/>
                        <input type="hidden" name="buscar" value="buscar"/>
                    </div>  
                    <div class="centrar">
                        <button class="boton-reporte" type="submit""><i class="fa-solid fa-magnifying-glass"></i>Buscar</button>                
                    </div>                                                    
                </div> 
            </form>           
        </div>
        <div class="centrar">
            <form method="POST" action="/crearUsuario"> 
                <button type="submit" class="boton-reporte" value="Crear Usuario">
                <i class="fa-solid fa-plus"></i>Crear Usuario</button>
            </form>        
        </div>     
  
        <!-- <div class="cabecero-ventas">
            <div>
                <p><strong>Datos del Cliente</strong></p>                
                <p><strong>Nombre:</strong> <?php echo($nombreUsuario->nombre??"Clientes"); ?></p>               
            </div>
            <div>
                <strong>Fecha  <?php echo date('Y-m-d')?></strong>
            </div>
        </div>         -->

        <div >       
            
            <!-- <div class="cabecero-ventas_tabla" >
                <form class="formulario" method="POST">                                  
                    <input type="hidden" name="accion" value="reporte">
                    <input class="boton-reporte" type="submit" value="Generar Reporte">
                </form>  
                <h3>Productos</h3>             
            </div> -->
        
            <!-- <table class="tabla-usuarios"> -->
            <table class="tabla-usuarios">
                <thead>
                    <tr>                                        
                        <th><strong>Nombre</strong></th>    
                        <th><strong>Apellido</strong></th>    
                        <th><strong>Email</strong></th>    
                        <th><strong>Cedula</strong></th>    
                        <th><strong>Telefono</strong></th>    
                        <th><strong>Tipo Usuario</strong></th>    
                        <th><strong>Estado</strong></th>    
                        <th><strong>Acciones</strong></th>       
                    </tr>
                </thead>

                <tbody> <!-- Mostrar los Resultados -->

                    <!-- <?php $count = 0; 
                        $subtotal =0;
                        $total = 0;
                    ?> -->
                    <?php foreach( $usuarios as $usuario ): ?>                       
                      
                    <div>
                        <tr >                                              
                            <td ><?php echo $usuario->nombre??" "; ?></td>
                            <td ><?php echo $usuario->apellido??" "; ?></td>
                            <td ><?php echo $usuario->cedula??" "; ?></td>
                            <td ><?php echo $usuario->email??" "; ?></td>
                            <td class="id-update_user"><?php echo $usuario->password??" "; ?></td>
                            <td ><?php echo $usuario->telefono??" "; ?></td>
                            <td >
                                <?php                            
                                
                                    if($usuario->admin == 1){
                                        echo('administrador');
                                    }else if($usuario->admin == 2 ){
                                        echo('vendedor');
                                    }else{
                                        echo('usuario'); 
                                    }
                                
                                ?></td>
                            <td ><?php echo $usuario->confirmado??" "; ?></td>
                            <td class="td">
                                <form method="POST" action="/configurarUsuarios" >
                                    <input type="hidden" name="id" value="<?php echo $usuario->id??0; ?>">
                                    <!-- <input type="submit" name="accion" value="Eliminar">   -->
                                    <button type="submit"  name="accion" class="boton-usuario" value="eliminar">
                                        <i class="fa-solid fa-trash-can">
                                        </i>Eliminar</button>                          
                                </form>
                                <!-- <form method="GET" action="/updateUsuario?id=<?php echo $usuario->id; ?>"> 
                                    <input type="hidden" name="id" value="<?php echo $usuario->id; ?>"> 
                                    <button type="submit" class="boton-pedido" value="actualizar">
                                    <i class="fa-solid fa-pen-to-square fa-xs"></i>Actualizar</button>
                                </form>  -->
                                <form method="POST" action="/updateUsuario"> 
                                    <input type="hidden" name="id" value="<?php echo $usuario->id??0; ?>"> 
                                    <button type="submit" class="boton-usuario" name="action" value="actualizar">
                                    <i class="fa-solid fa-pen-to-square fa-xs"></i>Actualizar</button>
                                </form>                                 

                            </td> 
                                        
                        </tr>
                    </div>   
                    <!-- <?php $count++;
                        $subtotal = $producto->costo_unidad + $subtotal;                                 
                    ?> -->
                    <?php endforeach; ?>
                    </tbody>  
            </table> 
        </div>    
    </main>

</div> 

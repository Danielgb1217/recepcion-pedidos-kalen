<?php 
    include_once __DIR__.'/../templates/alertas.php';
    include_once __DIR__.'/../templates/cabecera.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Administracion de Ventas</title> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        // <td ><?php //echo $usuario[$count]->cedula??" "; ?></td>
        //                 <td ><?php //echo $usuario[$count]->email; ?></td>  
        //                 <td ><?php //echo $producto->nombre; ?></td> 
        //                 <td ><?php //echo number_format( $producto->costo_unidad);?> </td> 
        //                 <td ><?php //echo $pedido[$count]->cantidad;?> </td> 
        //                 <td ><?php //echo $pedido[$count]->fecha_pedido;?> </td>    

        var data = google.visualization.arrayToDataTable([
          ['Producto', 'Unidades Vendidas'],
          ['`<?php echo($producto[0]->nombre)?? ''?>`', <?php echo ($pedido[0]->cantidad)?? 0?>],
          ['`<?php echo($producto[1]->nombre)?? ''?>`', <?php echo ($pedido[1]->cantidad)?? 0?>],
          ['`<?php echo($producto[2]->nombre)?? ''?>`', <?php echo ($pedido[2]->cantidad)?? 0?>],
          ['`<?php echo($producto[3]->nombre)?? ''?>`', <?php echo ($pedido[3]->cantidad)?? 0?>],
          ['`<?php echo($producto[4]->nombre)?? ''?>`', <?php echo ($pedido[4]->cantidad)?? 0?>],
          ['`<?php echo($producto[5]->nombre)?? ''?>`', <?php echo ($pedido[5]->cantidad)?? 0?>]
        ]);

        var options = {
          title: 'Productos Vendidos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);    
  
        document.getElementById('variable').value = chart.getImageURI();
      }
    </script>     
</head>
<body>

<div class="grid-dos">
    <div class="imagen-admin">
        <img src="build/img/ventas.webp">
    </div>

    <div >
        <main>
            <div>            
                <form class="formulario" method="POST">
                    <div class="cabecero-ventas">
                        <div>
                            <label><strong>Buscar por Cedula:</strong></label>
                            <input class="selector-ancho_upload" type="text" id="cedula" name="cedula" placeholder="cedula del cliente"/>
                        </div>
                        <div>
                            <label><strong>Buscar por Fecha:</strong></label>
                            <input class="selector-ancho_upload" type="date" id="cedula" name="fecha" placeholder="fecha de venta"/>                                      
                            <input type="hidden" name="accion" value="buscar">                            
                        </div>                        
                    </div>
                    <div class="centrar">
                        <button class="boton-reporte" type="submit"><i class="fa-solid fa-magnifying-glass-arrow-right"></i>Buscar</button>
                    </div>
                </form>           
                
            </div>


            <div class="cabecero-ventas">
                <div>
                    <p><strong>Datos del Cliente</strong></p>                
                    <p><strong>Nombre:</strong> <?php echo($nombreUsuario->nombre??"Clientes"); ?></p>                
                    <!-- <p><strong>Cedula:</strong> <?php echo($usuario[0]->cedula)??" "; ?></p>                
                    <p>Telefono: <?php echo $usuario[0]->telefono?></p>                
                    <p>Correo: <?php echo $usuario[0]->email?></p>      -->
                </div>
                <div>
                    <strong>Fecha  <?php echo date('Y-m-d')?></strong>
                </div>
            </div>        

            <div class="<?php echo($display);?>">       
                
                <div class="cabecero-ventas_tabla" >
                    <form class="formulario" method="POST" action="/reporteVentas">                                  
                        <input type="hidden" name="accion" value="reporte">
                        <input type="hidden" name="variable" id="variable"> 
                          <div class="flex">
                                <label><center><strong>Seleccione el Mes</strong></center></label>                  
                                <select name="mes" id="mes" class="campo-selector">   
                                    <option selected>Mes</option>                     
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>                   
                            <button class="boton-reporte" type="submit"><i class="fa-solid fa-file-pdf"></i>Reporte</button>
                            </div>  
                    </form>  
                                 
                </div>
            
     
                <h3>Productos</h3>
                    <div class="grid-venta">                 

                        <?php 
                        $count = 0; 
                        $subtotal =0;
                        $total = 0;                    
                        ?>
                        <?php foreach( $producto as $producto ): ?>                       
                            <div class="buscar-ventas">
                                <div >
                                    <p><strong>Cedula:</strong><?php echo " ".$usuario[$count]->cedula??" "; ?></p>
                                </div>
                                <div>
                                    <p><strong>Email:</strong><?php echo " ".$usuario[$count]->email; ?></p>
                                </div>
                                <div>
                                    <p><strong>Producto:</strong><?php echo" ". $producto->nombre; ?></p>
                                </div>
                            </div>
                            <div class="buscar-ventas">
                                <div>
                                    <p><strong>Precio:</strong><?php echo '$ '. (number_format( $producto->costo_unidad));?></p>
                                </div>
                                <div>
                                    <p><strong>Cantidad:</strong><?php echo " ".$pedido[$count]->cantidad;?></p>
                                </div>
                                <div>
                                    <p><strong>Fecha de Venta:</strong><?php echo" ". $pedido[$count]->fecha_pedido;?></p>
                                </div>                            
                                <br/>
                            </div>            
                        
                        <?php $count++;
                            $subtotal = $producto->costo_unidad + $subtotal;                                 
                        ?>
                        <?php endforeach; ?>
            
                    </div>  

                <!-- Div para mostrar el grafico de google -->
                <div class="estadistica">
                    <div class="img-estadistica" id="piechart"></div>
                </div>
            </div> 
            

            
        </main>
                    
    </div> 

</div>
</body>
</html>



















<?php
ob_start();
?>

<?php 
    include_once __DIR__.'/../templates/alertas.php';
    //include_once __DIR__.'/../templates/cabecera.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Factura de Venta</title>
</head>
<body>

<div class="contenedor-productos">
    <main >
        <div class="encabezado-factura">
            <div>
            <a class="icono-compras" href="/carritoCompras"><i class="fa-solid fa-circle-left fa-xl"></i></a>
                <h1>Textile Store</h1>
                <h3>Factura de Venta</h1>
            </div>
            <div>
                <!-- <img src="build/img/kalen.jpg" alt=" "> -->
                <img src="https://www.todopapas.com/img/cuentos/6/4/64.jpg" width="150" alt=" ">
                <!-- <img src="https://<?php $_SERVER['HTTP_HOST'];?>/build/img/kalen.jpg" alt="Logotipo"> -->
            </div>
        </div>

        <div class="encabezado-factura">
            <div>
                <div class="encabezado-cliente">
                <h3>Datos del Cliente</h3>  
                </div>              
                <p>Nombre: <?php echo $nombreCliente->nombre ." " . $nombreCliente->apellido   ?></p>                
                <p>Telefono: <?php echo $nombreCliente->telefono?></p>                
                <p>Correo: <?php echo $nombreCliente->email?></p>                
            </div>
            <div>
                <strong>Fecha  <?php echo date('Y-m-d')?></strong>
                <br>                
                <br> 
                <strong>Factura No.  <?php echo ('12023') ?></strong>
                <br>                 
            </div>
        </div>

        <h3>Productos</h3>

        <table class="tabla-factura">
            <thead>
                <tr>
                    <th>Producto</th>                
                    <th>Cantidad</th>
                    <th>Fecha de Compra</th>
                    <th>Costo Unidad</th>
                    <!-- <th>Costo Total</th> -->
                </tr>
            </thead>

            <tbody> <!-- Mostrar los Resultados -->

                <?php $count = 0; 
                $costoTotal=0;
                $subtotal =0;
                $total = 0;
                ?>

                <?php foreach( $productos as $producto ): ?>
                    
                    
                <tr>
                    <td ><?php echo $producto->nombre; ?></td> 
                    <td ><?php echo $resumenPedidos[$count]->cantidad;?> </td> 
                    <td ><?php echo $resumenPedidos[$count]->fecha_pedido;?> </td> 
                    <td ><?php echo number_format($producto->costo_unidad); ?></td> 
                    <td >
                        <?php   
                        echo number_format($producto->costo_unidad * $resumenPedidos[$count]->cantidad);                       
                        $costoTotal = intval($producto->costo_unidad * $resumenPedidos[$count]->cantidad);
                        
                        ?></td> 
                    <td>                        
                    </td>
                </tr>

                <?php $count++;
                    $subtotal = $costoTotal + $subtotal;                              
                ?>
                <?php endforeach; ?>
                </tbody>         
            </table>
            <div>
            
                <div>
                    <p>IVA:</p> 
                    <p><?php echo number_format($subtotal*0.19); ?></p> 
                </div>
                <div>
                    <p>SubTotal:</p>
                    <p><?php echo number_format($subtotal); ?></p> 
                </div>
                <div>
                    <p><strong>Total a Pagar:</strong></p>
                    <p><strong><?php echo number_format(($subtotal*0.19)+$subtotal); ?></strong></p> 
                </div>
                  
            </div>
    </main>
        <div>
            <form method="POST" action="/resumenVenta" >
                <input type="hidden" name="accion" value="factura"> 
                <button type="submit" class="boton-login"><i class="fa-solid fa-file-pdf fa-2xl"></i> Enviar</button>
            </form>
        </div>
</div>

</body>
</html>

<?php

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;

if($mostrarFactura == 1){
//debuguear($mostrarFactura);
    $html = ob_get_clean();     //todo lo que est n el formato html se almaena en estsa variable

    require_once "../vendor/autoload.php";
    
    $dompdf = new Dompdf();

    $option = $dompdf->getOptions();
    $option->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($option);
    $dompdf->setPaper("letter");
    $dompdf->loadHtml($html);
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=resumenVenta.pdf");
    echo $dompdf->output();

    $mostrarFactura = 0;



    //Crear el objeto de email --------------------------> Enviar la factura al correo del cliente-----------------------------
    $email = new PHPMailer();
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Port = 587;
    $email->Username = 'textilesotore@gmail.com';   //Correo electronico de la empresa
    $email->Password = 'egrfsodvonwirjve';  //contrasenia porporcionala por la gestion de contrasenias de google para apps
    $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $email->setFrom('textilesotore@gmail.com', 'Gestion de Cuentas Textile Store'); //direccion proporcionada en mailtrap para practicas de desarrollo
    $email->addAddress($nombreCliente->email, 'TextileStore.com');      
    $email->Subject = 'Factura de Venta';

    //Se utilizara ktml
    $email->isHTML(TRUE);
    $email->CharSet= 'UTF-8';

    // envio el token por peticion get a la pagina confirmar cuenta
    // $contenido = "<html>";
    // $contenido .= "<p><strong>Hola" . $this->nombre."</strong> para restablecer la contrasenia de la cuenta en Kalen
    // debe presionar el siguiente link</p>";
    // $contenido.= "<p>Presiona aqui <a href='http://localhost:3000/missAcount?token=  
    // ". $this->token ."'>Restablecer Password</a> </p>";
    // $contenido.= "<p>SI no has solicitado la recuperacion de el password, ignora el mensaje</p>";
    // $contenido.= "</html>";

    //Agrego el contenido construido al cuerpo 
    $email->Body= $html;

    //Enviar el email
    $email->send(); 

}


?>
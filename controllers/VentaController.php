<?php

namespace Controllers;

use Dompdf\Dompdf;
use Model\Pedidos;
use Model\Productos;
use Model\Usuario;
use MVC\Router;

class VentaController{

    public static function venta(Router $router){

        

        $pedido = new Pedidos();
        $productos= []; //creacion de arreglo para llenarlo con los productos obtenidos por las idprodcutos de cada pedido realizado
        $nombreProducto = new Productos();
        $nombreCliente = Usuario::where('id', $_SESSION['id']);
        $mostrarFactura = 0;
        
       
        $alertas =[];
        //$resumenPedidos = $pedido->all();
        //debuguear(date('Y-m-d'));     Muestra la fecha en el formato para my sql anio - mes - dia
        $resumenPedidos = $pedido->buscarPedidoVendidos($_SESSION['id'],date('Y-m-d'));   //solo trae los registros de la tabla pedidos con valor de venta null
     
        foreach ($resumenPedidos as $pedido)
            {
              $productos[] = Productos::buscarProductoPedido($pedido->idproducto);  //obtengo los productos del pedido
            
            }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            
            
            if(($_POST['accion'])==='comprar'){        //Registrar la compra de los pedidos

                $resumenPedidos = $pedido->buscarPedidoSinVender($_SESSION['id']);   //solo trae los registros de la tabla pedidos con valor de venta null
     
                foreach ($resumenPedidos as $pedido)
                    {
                        $pedido->venta = '1';
                        $pedido->actualizar();
                        header('Location: /resumenVenta');
                    } 
            }

            if(($_POST['accion'])==='factura'){
                $mostrarFactura = 1;
            }

        } 
        
        
        
        isAuth();



        $router->render('venta/resumenVenta', [
            'resumenPedidos' => $resumenPedidos,
            'productos' => $productos,
            'alertas' => $alertas,
            'nombreCliente' => $nombreCliente,
            'mostrarFactura' => $mostrarFactura    


        ]);   
    }


    public static function buscar(Router $router){

        $pedido = new Pedidos();
        $usuario = new Usuario();
        $producto = new Productos();
        $alertas = [];
        $nombreUsuario = '';
        $display = "ocultar";
        
        $mostrarReporte=0;

  //llamo todods estos valores para mostrar el ccs en la pantalla y que no quede en blanco .../
        $pedido = Pedidos::buscarVenta('cedula', $_POST['cedula']??"");
        $usuario = Usuario::buscarVenta('cedula', $_POST['cedula']??"");
        $nombreUsuario = Usuario::select('nombre', $usuario[0]->id??1);   ///indico [0] posicion 0 por que $usuario es un arreglo de objetos
        $producto = Productos::buscarVenta('cedula', $_POST['cedula']??"");   ///indico [0] posicion 0 por que $usuario es un arreglo de objetos
       
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //debuguear($_POST['cedula']);
            if($_POST['accion'] === 'buscar'){

                

                if($_POST['cedula']){

                    //mostrar div con la tabla debusqueda
                    $display = 'mostrar';

                    $pedido = Pedidos::buscarVenta('cedula', $_POST['cedula']);
                    $usuario = Usuario::buscarVenta('cedula', $_POST['cedula']);
                    $nombreUsuario = Usuario::select('nombre', $usuario[0]->id??1);   ///indico [0] posicion 0 por que $usuario es un arreglo de objetos
                    $producto = Productos::buscarVenta('cedula', $_POST['cedula']);
                    //debuguear($producto);
                    // $divCedula = 'mostrar-busquedad';
                    // $divFecha = 'ocultar-busquedad';
                    }
                 if($_POST['fecha']){

                    //mostrar div con la tabla debusqueda
                    $display = 'mostrar';

                    $pedido = Pedidos::buscarVenta('fecha_pedido', $_POST['fecha']);
                    $usuario = Usuario::buscarVenta('fecha_pedido', $_POST['fecha']);
                    $producto = Productos::buscarVenta('fecha_pedido', $_POST['fecha']);

                    // $divCedula = 'ocultar-busquedad';
                    // $divFecha = 'mostrar-busquedad';
                    }

                if($_POST['fecha'] && $_POST['cedula'] ){

                    //mostrar div con la tabla debusqueda
                    $display = 'mostrar';

                    $pedido = Pedidos::buscarVentaFecha($_POST['cedula'], $_POST['fecha']);
                    $usuario = Usuario::buscarVentaFecha($_POST['cedula'], $_POST['fecha']);
               
                    $producto = Productos::buscarVentaFecha($_POST['cedula'], $_POST['fecha']);

                    
                    // $divCedula = 'ocultar-busquedad';
                    // $divFecha = 'mostrar-busquedad';
                    }
            }

            if($_POST['accion'] === 'reporte'){
                $mostrarReporte=1;
            }
        }

        isAuth();
        
        if(($_SESSION['admin'] === '0')){  //en login contorler se creo la variable de sesion login cuando se autentica queda en true
            header('Location:/nuestrosProductos');
        }
        $router->render('venta/buscarVenta',[
            'alertas' =>$alertas,
            'pedido' => $pedido,
            'usuario' => $usuario,
            'producto' => $producto,
            'nombreUsuario' => $nombreUsuario,
            'mostrarReporte' =>$mostrarReporte,
            'display' => $display     




        ]);

    }

public static function reporte(Router $router){
$reporte = [];
$alertas = [];
$reporte = Pedidos::buscarVentaReporte($_POST['mes']);   //trae los valores con un join de la BD y genera arreglo de arreglos asociativos

// if(!$reporte){
//     echo'debe ingrersar el mes';
    
// $alertas['error'] = 'Debe Ingresar un Valor de mes';
// }else{
//     header('Location:/reporteVentas');
// }
isAuth();
        
if(($_SESSION['admin'] === '0')){  //en login contorler se creo la variable de sesion login cuando se autentica queda en true
    header('Location:/nuestrosProductos');
}

    $router->render('venta/reporteVentas',[
        'reporte' => $reporte,
        'alertas' => $alertas
    ]);
}


}
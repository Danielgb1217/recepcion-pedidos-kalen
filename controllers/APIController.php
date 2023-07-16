<?php
namespace Controllers;

use Model\Pedidos;
use Model\Productos;

class APIController {

    public static function index(){
        // isAuth();
        $productos = Productos::all(); 

       // debuguear(isAuthJS());
            
        // if(isAuthJS()){
         
        //     header('Location:/');
        // }else{
        //     echo('salgooooooooooooo');
            echo json_encode($productos);
           
        // }

       
    }

    public static function guardar(){

        // $respuesta =[                //Areglo asociativo equivalente a un objeto es js
        //     'pedido' => $_POST       //areglo aociativo, cueando utilice la funcion de json se convierte a json y podre
        // ];                           //leer este areglo en java script

        $pedido = new Pedidos($_POST);  //todo lo que mande como pedido me va a crear el objeto
        //el _POST se llena con los valores cargados en el formdata
        
        $resultado = $pedido->buscarProducto($_POST['nombre'], $_POST['color'], $_POST['talla']);//devuelve la consulta con el id
        //valida que el producto seleccionado en color y talla si se encuentre disponible en la base de datos
       
        $respuesta = '';

        if($resultado){ //si el producto existe devuleve el id y se guarda el pedido, de lo contrario no devuleve nada
           $respuesta= $pedido->guardar();
           
        }
        
        echo json_encode($respuesta);

    }
}
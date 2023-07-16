<?php

namespace Controllers;

use Model\Productos;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Pedidos;

class ProductosController{ 

    public static function index(Router $router){
        $displayAdmin = 'mostrar';
        $displayVentas = 'mostrar';
        $displayUsuarios = 'mostrar';
        $tipoUsuario = '';
        //session_start();        //iniciamos la sesion para pasar las variables de sesion hacia la vista  ID DEL PEDIDO.....

        isAuth();

        $router->render('productos/nuestrosProductos', [ 
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id'],     //enviamos el id a la vista para que este deisponible esta variable en ;a vista         
            'displayAdmin' => $displayAdmin,
            'displayVentas' => $displayVentas,
            'displayUsuarios' => $displayUsuarios,
            'tipoUsuario' => $tipoUsuario
        ]);        
    }

    public static function upload(Router $router){

        $producto = new Productos();   //creo el producto en blanco y lo envio a la vista para sostenerlo en memoria en el html
        //y que no se borren los datos del formulario en el html cuando actualice
        $alertas =[];

        // if($_SERVER['REQUEST_METHOD'] === 'GET'){
        //     header('Location/:subirProducto');
        // }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
          //  if ($_POST['accion'] === 'registrar'){         
            
                 //Aqui puedo pasar las validaciones necesarias
                $producto->sincronizar($_POST);          

                //Asignar Files a una Variable -----------------------------------SUBIDA DE ARCHIVOS-----------------------------
                $imagen = $_FILES['imagen'];
                //Carpeta donde se guararan las imagenes
                // $img = '../src/img/';
                $img = 'build/img/';
                if(!is_dir($img)){ mkdir($img);}
                //Generar un nombre unico        
                $nombreImg = md5( uniqid(rand(), true)) . ".jpg"; 
                
                //subir la imagen
                //move_uploaded_file($imagen['tmp_name'], $img . $nombreImg);

                if($_FILES['imagen']['tmp_name']){      //si existe la imagen se setea para pasar la validacion
                    //Realiza un resize a la imagen intervention image
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);  //recorta y reduce una imagen en una forma estandar
                    $producto->setImagen($nombreImg);
                }

                $alertas = $producto->validarProducto();
                if(empty($alertas)){                    
                    $resultado = $producto->guardar();
                    //Guarda la imagene en el servidor
                    $image->save($img . $nombreImg);

                    if($resultado){
                    header('Location: /admin');  //Redireccionar                     
                    $alertas['exito'] = ['Producto Creado con exito'];
                    }

             //   }

            }

        }

            isAuth();
            isAdmin();  //si el usuario no es administrados bloquea el enrutamiento a la pagina
                
            //La vista tiene que estar por fuera del condicional request method para que se muestre
            $router->render('productos/subirProducto',['producto' => $producto, 'alertas' => $alertas]);   //paso datos o variables a la vista en un arreglo asociativo
            //cone sto tengo un obejto disponible en las vista
    }

    
    public static function comprar(Router $router){     //Pagina resumen del pedido y vistas de eliminar y actualizar

        $pedido = new Pedidos();
        $productos= []; //creacion de arreglo para llenarlo con los productos obtenidos por las idprodcutos de cada pedido realizado
        $nombreProducto = new Productos();
        $display = 'mostrar';
        
        $actualizar = 'actualizar-pedido__ocultar';
        $alertas =[];
        //$resumenPedidos = $pedido->all();   
        
        $resumenPedidos = $pedido->buscarPedidoSinVender($_SESSION['id']);   //solo trae los registros de la tabla pedidos con valor de venta null
        if(!$resumenPedidos){
            $display = 'ocultar';
          }
                                                                //y del cliente logueado en la aplicacion     
        foreach ($resumenPedidos as $pedido)
            {
              $productos[] = Productos::buscarProductoPedido($pedido->idproducto);  //obtengo los productos del pedido            

            }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(($_POST['accion'])==='eliminar'){        //Elimino los pedidos

                $pedido->id =$_POST['id'];
                $pedido->eliminar();
                header('Location: /carritoCompras');
            }

            if(($_POST['accion'])==='update'){          //condicion que actualiza una clase del html para que me muestre la 
                                                        //ventana emergente para poder editar el pedido
                $actualizar ='actualizar-pedido'; 
                $pedido->idproducto =$_POST['idproducto']; 
                $pedido->id = $_POST['id'];                   
               
            }

            if(($_POST['accion'])==='actualizar'){      //Actualizacion del pedido, debo tomar los id y enviarlos al formulario
                
                $pedido->idproducto = $_POST['idproducto']; 
                $pedido->id = $_POST['id'];
                $nombreProducto = Productos::buscarProductoPedido($pedido->idproducto);  //Busco el producto con el id a editar  
                $resultado = $pedido->buscarProducto($nombreProducto->nombre, $_POST['color']??' ', $_POST['talla']?? ' ');               
               
                if($resultado){ //Si el producto a editar con las nuevas carcteristicas existe en la bd, lo actualiza
                    $pedido->idproducto = $resultado->id;
                    $pedido->cantidad = $_POST['cantidad']; 
                    $pedido->color = $_POST['color']; 
                    $pedido->talla = $_POST['talla']; 
  
                    $pedido->guardar();   //Guardar--->edita o crea el registro en la BD                 
                    header('Location: /carritoCompras');
                    $alertas['exito'][] = 'Actualizado Correctamente';                   
                }else{          //Si el producto no existe, no hace nada
                    $alertas['error'][] = 'NO hay productos disponibles con estas caracteristicas';
                }
               
            } 
            
            
            if(($_POST['accion'])==='comprar'){        //Registrar la compra de los pedidos

                $resumenPedidos = $pedido->buscarPedidoSinVender($_SESSION['id']);   //solo trae los registros de la tabla pedidos con valor de venta null
                if($resumenPedidos){
                    foreach ($resumenPedidos as $pedido)
                        {
                            $pedido->venta = '1';
                            $pedido->fecha_pedido =  date('Y-m-d');    //Cuando se legaliza la venta del pedido se actualiza la fecha de venta
                            $pedido->actualizar();
                            header('Location: /resumenVenta');
                        } 

                }else{
                    $alertas['error'][] = 'NO ha realizdo ningun pedido';
                }
            }

        }  

        isAuth();

        $router->render('productos/carritoCompras',     //Envio variables a la vista para procesarlas con el html
        [ 'productos' => $productos,
          'resumenPedidos' => $resumenPedidos,
          'actualizar' =>$actualizar,
          'nombreProducto' => $nombreProducto,
          'pedido' => $pedido,
          'alertas' => $alertas,
          'display' => $display        

        ]);        
    }


    public static function admin(Router $router){

        $productos = [];    //Declaro el arreglo
        $producto = new Productos();
        $alertas = [];
        $display ='ocultar';
        $displayImagen ='mostrar';
        $modoDisplay = 'grid-dos';
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){           
             

             if(($_POST['opcion'])?? "" === 'buscar'){ 

                $productos =Productos::whereNombre('nombre', $_POST['buscar']??"");  //lleno el arreglo declarado
                //no puedo poner esto--->$productos[] <---- Seria anidar el arreglo 
                if(!$productos){
                    $alertas['error'] = ['NO hay existencia del producto'];
                    header('Location:/admin');
                   
                }else{
                    $display = 'mostrar';
                    $modoDisplay = 'block';
                    $displayImagen = 'ocultar';
                }

             }

             if(($_POST['accion'])?? "" === 'eliminar'){        //Elimino los pedidos

                    $producto->id =$_POST['id']; 
                                  
                    $resultado = $producto->eliminar();                
                
                    if($resultado){
                        Productos::setAlerta('exito', 'Producto eliminado con exito');
                        //echo('Producto eliminado con exito');    
                    //$alertas['exito'][] = 'Producto eliminado con exito';
                    }else{
                        Productos::setAlerta('error', 'El producto hace parte de un pedido, debe eliminar el pedido primero'); 
                        //echo('El producto hace parte del pedido, debe eliminar el pedido primero');   
                    //$alertas['error'][] = 'El producto hace parte del pedido, debe eliminar el pedido primero';
                    }
                }



        }

        //-----------------------------------------------------
        $alertas = Productos::getAlertas();

        isAuth();
        isAdmin();

        $router->render('productos/admin', [ 
            'productos' => $productos,
            'alertas' => $alertas,
            'producto' => $producto,
            'display' => $display,
            'modoDisplay' => $modoDisplay,
            'displayImagen' => $displayImagen
                  

        ]);        
    }


    public static function uploadProducto(Router $router){//solo actualiza una imagen en particular por que el progrma
                                                          //muestra solo una imagen por que los productos estan repetidos  
        $producto = new Productos();
        $alertas =[];
       
    //    if($_SERVER['REQUEST_METHOD'] === 'GET'){
    //     $producto = $producto->find($_GET['id']); //tomo el producto encontrado con el id enviado por ger desde la pagina admin

    //     }

        // if($_SERVER['REQUEST_METHOD'] === 'GET'){
        //     $producto = $producto->find($_GET['id']);
        // }


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
             
            if($_POST['accion'] === 'uploadProducto'){
                $producto = $producto->find($_POST['id']); //tomo el producto encontrado con el id enviado por ger desde la pagina admin
            }else{
                    //Aqui puedo pasar las validaciones necesarias
                    $producto->sincronizar($_POST);  
                    //debuguear($producto)        ;
                   
                    //Asignar Files a una Variable -----------------------------------SUBIDA DE ARCHIVOS-----------------------------
                    $imagen = $_FILES['imagen'];
                    //Carpeta donde se guararan las imagenes
                    $img = 'build/img/';
                    if(!is_dir($img)){ mkdir($img);}
                    //Generar un nombre unico        
                    $nombreImg = md5( uniqid(rand(), true)) . ".jpg"; 
                    
                    //subir la imagen
                    //move_uploaded_file($imagen['tmp_name'], $img . $nombreImg);

                    if($_FILES['imagen']['tmp_name']){      //si existe la imagen se setea para pasar la validacion
                        //Realiza un resize a la imagen intervention image
                        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);  //recorta y reduce una imagen en una forma estandar
                        $producto->setImagen($nombreImg);
                    }

                    $alertas = $producto->validarProducto();
                    if(empty($alertas)){                    
                        $resultado = $producto->guardar();
                        //Guarda la imagene en el servidor
                        if($image){
                            $image->save($img . $nombreImg);
                        }
                        

                        if($resultado){                            
                            header('Location: /nuestrosProductos');  //Redireccionar                     
                            $alertas['exito']=['Producto actualizado con exito'];
                        }

                    }

                }

        }

        isAuth();
        isAdmin();

            //La vista tiene que estar por fuera del condicional request method para que se muestre
            $router->render('productos/uploadProducto',['producto' => $producto, 'alertas' => $alertas]);   //paso datos o variables a la vista en un arreglo asociativo
            //cone sto tengo un obejto disponible en las vista
    }

    




    public static function pdf(Router $router){

        $pedido = new Pedidos();
        $productos= []; //creacion de arreglo para llenarlo con los productos obtenidos por las idprodcutos de cada pedido realizado
       
        $alertas =[];
        //$resumenPedidos = $pedido->all();   
        
        $resumenPedidos = $pedido->buscarPedidoSinVender($_SESSION['id']);   //solo trae los registros de la tabla pedidos con valor de venta null
                                                              //y del cliente logueado en la aplicacion     
        foreach ($resumenPedidos as $pedido)
            {
              $productos[] = Productos::buscarProductoPedido($pedido->idproducto);  //obtengo los productos del pedido
            
            }

            $router->render('pdf',     //Envio variables a la vista para procesarlas con el html
            [ 'productos' => $productos,
              'resumenPedidos' => $resumenPedidos,               
              'pedido' => $pedido,
              'alertas' => $alertas        
    
            ]);       
    }


}     
    




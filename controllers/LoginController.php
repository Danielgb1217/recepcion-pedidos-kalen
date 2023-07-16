<?php

namespace Controllers;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

class LoginController{

        public static function login(Router $router){
            $alertas = [];
            $auth = new Usuario();  //se crea un nuevo usuario para limpiar el fromulario con los datos
            $tipoUsuario = '';

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new Usuario($_POST);
                $alertas = $auth->validarLogin();

                if(empty($alertas)){
                    //Comprobar que el usuario existe
                    $usuario = Usuario::where('email', $auth->email);  //Esta instancia retorna de la base de datos el espejo del usujario
                    
                    if($usuario){
                        //verificar el password
                        if($usuario->verificarPassworAndConfirmado($auth->password)){
                            //Autenticar el usuario

                            session_start();    //inicio una zesion para tener uso de las variables de sesion (Superglobales)

                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;
                            $_SESSION['admin'] = $usuario->admin;
                            
                        
                            //Redireccionamiento
                            if($usuario->admin === "1"){
                                $_SESSION['admin'] = $usuario->admin ?? null;
                                // $tipoUsuario = 'admin';
                                // $router->render('productos/nuestrosProductos',[ 'tipoUsuario' => $tipoUsuario]);
                                 header('Location: /nuestrosProductos');    //Panel de administrador
                            }else if($usuario->admin === "2"){
                                $_SESSION['admin'] = $usuario->admin ?? null;
                                // $tipoUsuario = 'admin';
                                // $router->render('productos/nuestrosProductos',[ 'tipoUsuario' => $tipoUsuario]);
                                 header('Location: /nuestrosProductos');    //Panel de administrador
                            }else{  //panel de usuarios
                                $_SESSION['admin'] = $usuario->admin ?? null;

                                // $tipoUsuario = 'usuario';
                                // $router->render('productos/nuestrosProductos',[ 'tipoUsuario' => $tipoUsuario]);
                                 header('Location: /nuestrosProductos');
                            }
                        }
                    }else{
                        Usuario::setAlerta('error', 'Usuario Invalido');
                    }
                }

            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/login',['alertas' => $alertas, 'auth' => $auth]); //envio el usuario (auth) creado hacia la vista
        }

        public static function miss(Router $router){

            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();

                if(empty($alertas)){    //si las alertas estan vacias continuo
                    $usuario = Usuario::where('email', $auth->email);
                    
                    if($usuario && $usuario->confirmado === "1"){
                        //Usaurio confirmado y existente en la base de datos
                        //Generar un token
                        $usuario->generarToken();
                        $usuario->guardar();

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);                       
                        $email->enviarInstrucciones();

                        Usuario::setAlerta('exito', 'Revisa tu bandeja de entrada, Te hemos enviado un email con los pasos para recuperar tu cuenta');
                       
                    }else{
                        Usuario::setAlerta('error', "el usuario no existe");
                       

                    }
                }
            }

            $alertas = Usuario::getAlertas();
            $router->render('auth/missPassword', ['alertas' => $alertas]);
        }

        public static function missAcount(Router $router){
            $alertas = [];
            $error = false;

            if($_SERVER['REQUEST_METHOD'] === 'POST'){ //leer el nuevo password y guradarlo
                //debuguear($_POST['id']);
                if($_POST['accion'] === 'miss'){  
                   
                    $usuario = Usuario::find($_POST['id']);
                    
                    $password = new Usuario($_POST);
                    
                    $alertas =  $password->validarPassword();
                   
                    //UNA COSA ES MI USUARIO ESPEJ DE LA BASE DE DATOS-->$usuario<-- Y OTRA ES EL USUARIO CREADO DEL FORMULARIO POST -->$password<--
                    if(empty($alertas)){    //Si pasamos la validadcion el arreglo de alertas estara vacio y podemos hashear el password
                        $usuario->password = ' ';  //borro el password viejo
                        
                        $usuario->password = $password->password;     //sobreescribo el passwor que e traigo por el metodo post del frm
                       
                        $usuario->hashPassword();
                        $usuario->token = null;
    

                        $resultado = $usuario->guardar();
                        if($resultado){
                            header('Location: /');
                        }
                    }

                }  

            }


            $token = s($_POST['token']); //limpia los espacios en blanco por porblemas del %20 en la url get  
            //Buscar usuario por su token
           
            $usuario = Usuario::where('token',$token);           
            
            if(empty($usuario)){
                Usuario::setAlerta('error', 'Token no valido');
                $error = true;
            }  
//estaba enviando el objeto usuario y no funcionada tuve que enviar solo el atributo id del objeto???estaba enviadno unarreglo??
            $alertas = Usuario::getAlertas();
            $router->render('auth/missAcount', 
            ['alertas' => $alertas, 
            'error' => $error,
            'usuarioId' => $usuario->id
        
        ]);
        }


        public static function create(Router $router){


            $usuario = new Usuario();   //creo el usuario en blanco y lo envio a la vista para sostenerlo en memoria en el html
            //y que no se borren los datos del formulario en el html cuando actualice
            $alertas =[];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    //Aqui puedo pasar las validaciones necesarias
                    $usuario->sincronizar($_POST);
                    $alertas = $usuario->validarCuenta();

                    if(empty($alertas)){

                        //
                        $resultado = $usuario->validarUsuarioRegistrado();

                        if($resultado->num_rows){
                            Usuario::setAlerta('error','EL usuario ya se encuentra registrado');
                            Usuario::getAlertas();
                            echo "Usuario ya esta registrado";
                        }else{       //EL Usuario no esta registrado
                        //Hashear el password
                        $usuario->hashPassword();

                         //Generar un token unico para validar que el email registrado ralmente existe
                        $usuario->generarToken(); //comentar para registrar usuarios sin token

                        //Enviar un email
                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                        //debuguear($email);

                        //Enviar confirmacion de email
                        $email->enviarConfirmacion();

                        //Crear el usuario
                        //debuguear($usuario);

                        $resultado = $usuario->guardar();
                        if($resultado){
                        header('Location: /mensaje');  //Redireccionar al ususario a mensaje
                        }


                        //debuguear($usuario);
                        }
                    }
            }

            $router->render('auth/createAccount',['usuario' => $usuario, 'alertas' => $alertas]);   //paso datos o variables a la vista en un arreglo asociativo
                                    //cone sto tengo un obejto disponible en las vista
        } 

        public static function mensaje(Router $router){
            $router->render('auth/mensaje');
        }

        public static function confirmar(Router $router){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $alertas = [];
                $token = s(trim(($_POST['token'])));
                $usuario = Usuario::where('token',$token);

            
                
                if(empty($usuario)){
                    //Token no valido
                    Usuario::setAlerta('error', 'Token NO Valido');
                    
                }else{  //token valido
                                //Modificar usuarios confirmados
                    $usuario->confirmado = '1';
                    $usuario->token = null;
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Cuenta Confirmada');
                }

                $alertas = Usuario::getAlertas(); //Alertas que se guardanen memoria puedan ser leidas antes de mostrar la vista
                //Rencerizar la vista
                //header("Location:/confirmar-cuenta");

            }
            $router->render('auth/confirmarCuenta', [
                'alertas' => $alertas
            ]);

        }

        public static function productos(Router $router){
            isAuth();
            $router->render('productos/nuestrosProductos');
        }

        public static function detalleProducto(Router $router){
            $router->render('productos/detalleProducto');
        }


        public static function logout(Router $router){
    //   echo('desde logaour');
            session_start();
            // debuguear($_SESSION);
            $_SESSION = [];

            header('Location: /');

        }


        public static function configurarUser(Router $router){

            $usuarios = []; 
            $usuario = new Usuario()          ;
            $alertas = [];
    
      //llamo todods estos valores para mostrar el ccs en la pantalla y que no quede en blanco .../            
            $usuarios = Usuario::all();
           
             if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
                if(($_POST['accion'])?? "" === 'eliminar'){        //Elimino los pedidos

                    $usuario->id =$_POST['id'];    
                    //debuguear($usuario->id);            
                    $resultado = $usuario->eliminar();                
                
                    if($resultado){
                        Usuario::setAlerta('exito', 'Usuario eliminado con exito');
                        header('Location:/configurarUsuarios') ;
                       //$alertas['exito'][] = 'Producto eliminado con exito';
                    }else{
                        Usuario::setAlerta('error', 'El producto hace parte de un pedido, debe eliminar el pedido primero'); 
                        //echo('El producto hace parte del pedido, debe eliminar el pedido primero');   
                    //$alertas['error'][] = 'El producto hace parte del pedido, debe eliminar el pedido primero';
                    }
                }

                if(($_POST['buscar'])??" " === 'buscar'){        //Elimino los pedidos                     
                  
                    if(Usuario::validarCorreo($_POST['email'])){    //valido si el correo ingresado si es un correo
                        
                        if(Usuario::validarURegistrado($_POST['email'])){   //valido si el correo esta registrado
                        $usuarios[0] = Usuario::where('email', $_POST['email']);
                        }else{
                            $alertas['error'] = ['El usuario no se encuentra registrado'];
                        }
                    //debuguear($usuarios) ;
                    }else{
                        $alertas['error'] = ['Debe ingresar un email valido'];
                    }
                   
                }

                
   

   
             }
    
            isAuth();

            isAdmin();

            Usuario::getAlertas();
            $router->render('admin/configurarUsuario',[
                'usuarios'=> $usuarios,
                'alertas' => $alertas

            ]);
        }


        public static function updateUsuario(Router $router){
            
            $usuario = new Usuario();
            $alertas = [];
            $display = 'mostrar';
           
         //   if($_SESSION['admin'] === 0 || $_SESSION['admin'] === 2){   //si el usuario no es administrador cargue el valor de su
                $usuario = $usuario->find($_SESSION['id'] );            // id definido. Si es el administrador este cargara los id
          //  debuguear($usuario);
         //   }   
    
    
            //  if($_SERVER['REQUEST_METHOD'] === 'GET'){            
            //      $usuario = $usuario->find($_POST['id']);

            // }

            // if($_POST['action'] === 'actualizar'){
            //     $usuario = $usuario->find($_POST['id']);
            //     header('Location:/updateUsuario');
            // }

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Aqui puedo pasar las validaciones necesarias

                if($_POST['action']??" " === 'actualizar'){
                    $usuario = $usuario->find($_POST['id']);
                
                }

                if($_POST['opcion']??" " === 'actualizar'){
                    $usuario->sincronizar($_POST);
                    $alertas = $usuario->validarCuenta();

                    if(empty($alertas)){
                        $usuario->hashPassword();
                        //$usuario->confirmado = 1;
                        $resultado = $usuario->guardar();
                        if($resultado){
                            Usuario::setAlerta('exito','Actualizacion exitosa');
                            Usuario::getAlertas();
                            header('Location:configurarUsuarios');
                        }
                        
                        
                    }
                }


            }


            if($_SESSION['admin'] === '1'){   //si el usuario no es administrador muestra la vista de los campos
                $display = 'mostrar';       //para editar el admin y el confirmado           
                
            }else{
                $display = 'ocultar';
                
            } 

           
            isAuth();
            
            $router->render('admin/updateUsuario',[
                'usuario' => $usuario,
                'alertas' => $alertas,
                'display' => $display
            ]);
        }


        public static function crearUsuario(Router $router){
            
            $usuario = new Usuario();
            $alertas = [];
            $display = 'mostrar';


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Aqui puedo pasar las validaciones necesarias

                if($_POST['opcion']??" " === 'crear'){
                    //Aqui puedo pasar las validaciones necesarias

                    
                    $usuario->sincronizar($_POST);
                    $alertas = $usuario->validarCuenta();

                    if(empty($alertas)){ 

                        $resultado = $usuario->validarUsuarioRegistrado();
                        
                        if($resultado->num_rows){
                            Usuario::setAlerta('error','EL usuario ya se encuentra registrado');
                            Usuario::getAlertas();
                        }else{       //EL Usuario no esta registrado
                            //Hashear el password
                            if(!( Usuario::validarCorreo($_POST['email']))){
                                $alertas['error'] = ['El correo no es valido'];
                            }else{
                                $usuario->hashPassword();                      
                                $resultado = $usuario->guardar();
                                
                                if($resultado){
                                    $alertas['exito'] = ['Usuario Registrado con Exito'];
                                    Usuario::getAlertas();
                                    header('Location:/configurarUsuarios');
                                }
                            } 
                        }
                    }

                }
                

            }
           
            isAuth();
            isAdmin();


            $router->render('admin/crearUsuario',[
                'usuario' => $usuario,
                'alertas' => $alertas,
                'display' => $display
            ]);
        }

}



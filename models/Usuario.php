<?php

namespace Model;

class Usuario extends ActiveRecord{

    //BASE DE DATOS...........................SOBREESCRIBO LOS ATRIBUTOS DE LA CLASE PADRE
    protected static $tabla = 'usuarios';       //tabla en donde va a encontrar los datos
    protected static $columnasDB = ['id', 'nombre', 'apellido','cedula', 'email',     //Debe ser un espejo a la tabla de la db
    'password', 'telefono', 'admin', 'confirmado', 'token'];


    //Creo un atributo por cada campo de la db

    public $id;     //Al ser publicos puedo acceder a ellos desde la clase o desde el objeto una vez intanciado
    public $nombre;
    public $apellido;
    public $cedula;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;


//defino constructor

    public function __construct($args = [])  //args va a ser un arreglo asociativo y cuando instancie el objeto ...
    {
        $this->id = $args['id'] ?? null;       //si cuando instacnei el id no esta presente en el atributo sera nulo
        $this->nombre = $args['nombre']  ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';

        //Con esto definimos la forma que tendra el objeto de usuarios  en el modelo...
    }


    //Mensajes de validacion al crear una cuenta

    public function validarCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][] = 'El password es obligatorio';
        }

        if(!$this->cedula){
            self::$alertas['error'][] = 'la cedula es obligatoria';
        }

        if((!ctype_digit($this->cedula)) || (strlen($this->cedula) > 10 )){
            self::$alertas['error'][] = 'la cedula debe contener solo valores numericos y no debe ser mayor a 10 digitos';
        }
        

        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if(strlen($this->password) < 6 ){
            self::$alertas['error'][] = 'El password debe contener minimo 6 caracteres';
        }

        if((!ctype_digit($this->telefono)) || (strlen($this->cedula) > 10 )){
            self::$alertas['error'][] = 'El telefono debe contener solo valores numericos y no debe ser mayor a 10 digitos';
        }
        
        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }


public function validarUsuarioRegistrado(){

    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1"; //se debe escapar con ' en el correo para la sentencia sql

    $resultado = self::$db->query($query);
    
    if($resultado->num_rows){
        self::$alertas['error'][] = 'El usuario ya se encuentra registrado';  //Se agrega a las alertas
    }

    return $resultado;

}

public function hashPassword(){

    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
   


}

public function generarToken(){

    $this->token = uniqid();       //Generar una cadena de 13 digitos como token, funcion para generar un id unico
    

}

public function validarLogin(){
    if(!$this->email){
        self::$alertas['error'][] = 'El email es obligatorio';    
    }
    if(!$this->email){
        self::$alertas['error'][] = 'El password es obligatorio';    
    }
    return self::$alertas;
}

public function verificarPassworAndConfirmado($password){
    $resultado = password_verify($password, $this->password);
    
    if(!$resultado || !$this->confirmado){
        self::$alertas['error'][]= "Password Incorrecto o cuenta no confirmada";
    }else{
        return true;
    }
}

public function validarPassword(){

    if(!$this->password){
        self::$alertas['error'][]= 'El password es obligatorio';
    }
    if(strlen($this->password) < 6){
        self::$alertas['error'][]= 'El password debe tener al menos 6 caracteres'; 
    }
    return self::$alertas;
}

public static function validarCorreo($email) {
   
    $matches = null;
    return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email, $matches));
}

public static function validarURegistrado($email){

    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $email . "' LIMIT 1"; //se debe escapar con ' en el correo para la sentencia sql

    $resultado = self::$db->query($query);
    
    if($resultado->num_rows){
        //self::$alertas['error'][] = 'El usuario ya se encuentra registrado';  //Se agrega a las alertas
        return true;
    }

    return false;

}

}
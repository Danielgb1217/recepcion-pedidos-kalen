<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos       
        
        $resultado = self::$db->query($query);
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
            
        }
        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    protected static function crearObjeto($registro) {
        $objeto = new static;

        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
        
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
       
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;  //A este objeto asignele el valor de la llave especificada del objeto
          }
        }
    }

    // Registros - CRUD--------------------------->
    public function guardar() {
        $resultado = '';
        if(!is_null($this->id)) {            
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro  
            $resultado = $this->crear();
        }
        //debuguear($resultado);
        return $resultado;
    }



    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";
        //debuguear($query);
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    //Buscar un token---sirve para buscar en la BD con un where especifico diferente al id
        // Busca un registro por su id
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ${columna} = '${valor}'";                
        $resultado = self::consultarSQL($query);        
        return array_shift( $resultado ) ;      //array_shift solo muestra el primer valor del arreglo, por eso no me sirve si
                                                 //necesito el arreglo completo
    }

    //Buscar productos existentes en la tabla de pedidos-------------->PERSONALIZADA PARA LA APLICACION--------------------------------
    //Devuelve el id del producto que cumpla con las caracteristicas de seleccion del cliente del nombre del prodcuto
    // el color y la talla ...si el producto esta en existencias(se encuentra en la base de datos) devulve el id
    //de lo contrario siginifica que no hay existencias
    public static function buscarProducto($nombre, $color, $talla) {
        $query = "SELECT id FROM productos " . "WHERE nombre = '${nombre}' AND color = '${color}' AND talla = '${talla}'";  
        $resultado = self::consultarSQL($query);        
        return array_shift( $resultado ) ;
    }

    public static function buscarProductoPedido($idproducto) {
        $query = "SELECT * FROM productos WHERE id = '${idproducto}'";                
        $resultado = self::consultarSQL($query); 
        //debuguear($query)        ;
        return array_shift( $resultado ) ;
    }

    public static function buscarPedidoSinVender($idcliente) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE venta = ' ' AND idcliente = '${idcliente}'";
       // debuguear($query);
        $resultado = self::consultarSQL($query);
       return $resultado;
     }

     public static function buscarPedidoVendidos($idcliente, $fecha_consulta) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE venta = '1' AND idcliente = '${idcliente}'AND fecha_pedido = '${fecha_consulta}' ";
       // debuguear($query);
        $resultado = self::consultarSQL($query);
       return $resultado;
     }


     public static function whereNombre($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE ${columna} = '${valor}'";       
        $resultado = self::consultarSQL($query);        
        return $resultado;      
    }


    public static function buscarVenta($columna, $valor) {
        $query = "SELECT usuarios.id, usuarios.nombre,usuarios.apellido, usuarios.cedula, 
        usuarios.telefono,usuarios.email, productos.nombre, productos.costo_unidad, 
        pedidos.cantidad, pedidos.fecha_pedido FROM usuarios
        JOIN pedidos ON usuarios.id = pedidos.idcliente
        JOIN productos ON pedidos.idproducto = productos.id  WHERE ${columna} = '${valor}'";  
           //debuguear($query)  ;
        $resultado = self::consultarSQL($query);        
        return $resultado  ;      //array_shift solo muestra el primer valor del arreglo, por eso no me sirve si
                                                 //necesito el arreglo completo
    }


    public static function buscarVentaReporte($valor) {
        $query = "SELECT usuarios.id, usuarios.nombre as nombreUser,usuarios.apellido, usuarios.cedula, 
        usuarios.telefono,usuarios.email, productos.nombre, productos.costo_unidad, 
        pedidos.cantidad, pedidos.fecha_pedido FROM usuarios
        JOIN pedidos ON usuarios.id = pedidos.idcliente
        JOIN productos ON pedidos.idproducto = productos.id  WHERE fecha_pedido  BETWEEN '2022-${valor}-01' AND '2022-${valor}-31'
        ORDER BY pedidos.cantidad DESC";  
        // debuguear($query)  ;
          
        $resultado = self::$db->query($query);
    
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = $registro;
            
           }              
        return $array  ;      //array_shift solo muestra el primer valor del arreglo, por eso no me sirve si
                                                 //necesito el arreglo completo
    }







    //Busca todas las ventas realizadas al cliente especificado y en la fecha especificada
    public static function buscarVentaFecha($cedula, $fecha) {
        $query = "SELECT usuarios.id, usuarios.nombre,usuarios.apellido, usuarios.cedula, 
        usuarios.telefono,usuarios.email, productos.nombre, productos.costo_unidad, 
        pedidos.cantidad, pedidos.fecha_pedido FROM usuarios
        JOIN pedidos ON usuarios.id = pedidos.idcliente
        JOIN productos ON pedidos.idproducto = productos.id  WHERE cedula = '${cedula}' AND fecha_pedido = '${fecha}' ";  
           //debuguear($query)  ;
        $resultado = self::consultarSQL($query);        
        return $resultado  ;      //array_shift solo muestra el primer valor del arreglo, por eso no me sirve si
                                                 //necesito el arreglo completo
    }
    


        // Busca un registro por un valor especifico y devuleve un campo especifico
        public static function select($campo, $id) {
            $query = "SELECT ${campo} FROM " . static::$tabla  ." WHERE id = ${id}";            
            $resultado = self::consultarSQL($query);
            return array_shift( $resultado ) ;
        }
  



    //-------------------------------------------------------------------------------------------------------------------------------------

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();       

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // Resultado de la consulta
        //echo json_encode($query);
        $resultado = self::$db->query($query);
        //debuguear($query);
       // echo json_encode($query);    --->muestra variables json
        return [
           'resultado' =>  $resultado,
           'id' => self::$db->insert_id      //--------------------------id ?-----insert_id
        ];
    }

    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";   //----------id ?
        $query .= " LIMIT 1 "; 
        
        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";              
        $resultado = self::$db->query($query);
        return $resultado;
    }

}
<?php

namespace Model;

class Productos extends ActiveRecord{

//Debemos tener las mismas variables de active record para crear el objeto igual al que tenemos en la base de datos

protected static $tabla = 'productos';
protected static $columnasDB = ['id', 'nombre', 'tipo', 'color', 'talla', 'cantidad', 'costo_unidad', 'descripcion','imagen'];

public $id;
public $nombre;
public $tipo;
public $color;
public $talla;
public $cantidad;
public $costo_unidad;
public $descripcion;
public $imagen;

public function __construct($args = []){

    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->tipo = $args['tipo'] ?? '';
    $this->color = $args['color'] ?? '';
    $this->talla = $args['talla'] ?? '';
    $this->cantidad = $args['cantidad'] ?? '';
    $this->costo_unidad = $args['costo_unidad'] ?? 0;
    $this->descripcion = $args['descripcion'] ?? '';
    $this->imagen = $args['imagen'] ?? '';

}


public function validarProducto(){
    if(!$this->nombre){
        self::$alertas['error'][] = 'El nombre es obligatorio';
    }

    if(!$this->tipo){
        self::$alertas['error'][] = 'El tipo es obligatorio';
    }

    if(!$this->color){
        self::$alertas['error'][] = 'El color es obligatorio';
    }

    if(!$this->talla){
        self::$alertas['error'][] = 'la talla es obligatorio';
    }

    if(!$this->cantidad){
        self::$alertas['error'][] = 'la cantidad es obligatorio';
    }

    // if($this->costo_unidad){
    //     self::$alertas['error'][] = 'El costo es obligatorio';
    // }

    if(!$this->imagen){
        self::$alertas['error'][] = 'La Imagen es Obligatoria';
    }
    
    return self::$alertas;
}



//Subir imagenes
public function setImagen($imagen){

    if($imagen){
        $this->imagen = $imagen; //asigno al atributo el nombre de la imagen para guardar en la BD
    }

}



}
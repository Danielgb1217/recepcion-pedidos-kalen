<?php

namespace Model;

class Pedidos extends ActiveRecord{

    //Base de datos
    protected static $tabla = 'pedidos';
    protected static $columnasDB = ['id', 'idcliente', 'idproducto', 'cantidad', 'fecha_pedido', 'venta'];
    
    public $id;
    public $idcliente;
    public $idproducto;
    public $cantidad;
    public $fecha_pedido;
    public $venta;

    public function __construct($args = []){

        $this->id = $args['id'] ?? null;
        $this->idcliente = $args['idcliente'] ?? '';
        $this->idproducto = $args['idproducto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->fecha_pedido = $args['fecha_pedido'] ?? '';
        $this->venta = $args['venta'] ?? '';


    }



}
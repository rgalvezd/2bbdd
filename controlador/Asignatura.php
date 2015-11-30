
<?php
require_once '/modelo/AsignaturaModelo.php';

class Asignatura {
    private $_id;
    private $_codigo;
    private $_nombreCorto;
    private $_nombreCompleto;
    
    public static function getAll()
    {
        $asignaturaModelo = new AsignaturaModelo;        
        $asignaturas=$asignaturaModelo->getAll();
        return $asignaturas;
    }
    
    public function __construct($id=NULL, $codigo="", $nombreCorto="", $nombreCompleto="")
    {
        $this->_id=$id;
        $this->_codigo=$codigo;
        $this->_nombreCorto=$nombreCorto;
        $this->_nombreCompleto=$nombreCompleto;
    }
    
    public function getAsignatura($numero)
    {
        $asignaturaModelo = new AsignaturaModelo;        
        $fila = $asignaturaModelo->getAsignatura($numero);
        $this->_id=$fila['id'];
        $this->_codigo=$fila['codigo'];
        $this->_nombreCorto=$fila['nombreCorto'];
        $this->_nombreCompleto=$fila['nombreCompleto'];
    }
    
    
    function get_id() {
        return $this->_id;
    }

    function get_codigo() {
        return $this->_codigo;
    }

    function get_nombreCorto() {
        return $this->_nombreCorto;
    }

    function get_nombreCompleto() {
        return $this->_nombreCompleto;
    }
        
    public function modificar()
    {
        $asignaturaModelo = new AsignaturaModelo;        
        return $asignaturaModelo->grabar(get_object_vars($this));        
    }
    
    function set_id($_id) {
        $this->_id = $_id;
    }

    function set_codigo($_codigo) {
        $this->_codigo = $_codigo;
    }

    function set_nombreCorto($_nombreCorto) {
        $this->_nombreCorto = $_nombreCorto;
    }

    function set_nombreCompleto($_nombreCompleto) {
        $this->_nombreCompleto = $_nombreCompleto;
    }

    public function  insertar()           
    {
        $asignaturaModelo = new AsignaturaModelo;
        return $asignaturaModelo->insertar($this->_codigo, $this->_nombreCorto, $this->_nombreCompleto);
    }
    
    public function borrar()
    {
        $asignaturaModelo = new AsignaturaModelo;
        return $asignaturaModelo->borrar($this->_id);
    }


}

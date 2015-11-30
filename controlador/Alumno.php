<?php
require_once '/modelo/AlumnoModelo.php';

class Alumno {
    private $_numero;
    private $_nombre;
    private $_apellidos;
    private $_edad;
    
    public static function getAll()
    {
        $alumnoModelo = new AlumnoModelo;        
        $alumnos=$alumnoModelo->getAll();
        return $alumnos;
    }
    
    public function __construct($numero=NULL, $nombre="", $apellidos="", $edad=0)
    {
        $this->_numero=$numero;
        $this->_nombre=$nombre;
        $this->_apellidos=$apellidos;
        $this->_edad=$edad;
    }
    
    public function getAlumno($numero)
    {
        $alumnoModelo = new AlumnoModelo;        
        $fila = $alumnoModelo->getAlumno($numero);
        $this->_numero=$fila['ID'];
        $this->_nombre=$fila['nombre'];
        $this->_apellidos=$fila['apellido'];
        $this->_edad=$fila['edad'];
    }
    
    function getNumero() {
        return $this->_numero;
    }

    function getNombre() {
        return $this->_nombre;
    }

    function getApellidos() {
        return $this->_apellidos;
    }

    function getEdad() {
        return $this->_edad;
    }

        
    public function modificar()
    {
        $alumnoModelo = new AlumnoModelo;        
        return $alumnoModelo->grabar(get_object_vars($this));        
    }
    function setNumero($numero) {
        $this->_numero = $numero;
    }

    function setNombre($nombre) {
        $this->_nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->_apellidos = $apellidos;
    }

    function setEdad($edad) {
        $this->_edad = $edad;
    }

    public function  insertar()           
    {
        $alumnoModelo = new AlumnoModelo;
        return $alumnoModelo->insertar($this->_nombre, $this->_apellidos, $this->_edad);
    }
    
    public function borrar()
    {
        $alumnoModelo = new AlumnoModelo;
        return $alumnoModelo->borrar($this->_numero);
    }


}

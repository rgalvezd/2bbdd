<?php

class AlumnoModelo {

    const USER = 'alumno';
    const BBDD = 'dweb';
    const PSS = 'alumno';
    const HOST = 'localhost';

    private $_db;

    public function __construct() {
        $this->_db = new mysqli(self::HOST, self::USER, self::PSS, self::BBDD);
        if ($this->_db->connect_errno > 0) {
            die("Imposible conectarse con la base de datos [" . $this->_db->connect_error . "]");
        }
    }

    public function getAll() {
        $sql = 'SELECT * FROM alumno';
        $resultado = $this->_db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function getAlumno($numero) {
        $sql = 'SELECT * FROM alumno'
                . ' WHERE ID=' . $numero;
        $resultado = $this->_db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function grabar($fila) {
        $numero = $fila['_numero'];
        $nombre = $fila['_nombre'];
        $apellidos = $fila['_apellidos'];
        $edad = $fila['_edad'];

        $sql = "UPDATE alumno"
                . " SET nombre = '$nombre',"
                . " apellido = '$apellidos',"
                . " edad = $edad "
                . " WHERE ID = $numero";

        $resultado = $this->_db->query($sql);
        return $resultado;
    }

    public function insertar($nombre, $apellidos, $edad) {
        $sql = "INSERT INTO alumno(nombre, apellido, edad) "
                . " VALUES ('$nombre',"
                . " '$apellidos',"
                . " $edad)";
        echo $sql;
        $resultado = $this->_db->query($sql);
        return $resultado;
    }
    public function borrar($numero)
    {
        $sql="DELETE FROM alumno "                
                . " WHERE ID = $numero";
        $resultado = $this->_db->query($sql);
        return $resultado;
    }

}

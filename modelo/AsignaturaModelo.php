<?php

class AsignaturaModelo {

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
        $sql = 'SELECT * FROM asignatura';
        $resultado = $this->_db->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function getAsignatura($id) {
        $sql = 'SELECT * FROM asignatura'
                . ' WHERE id=' . $id;
        $resultado = $this->_db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function grabar($fila) {
        var_dump($fila);
        $id = $fila['_id'];
        $codigo = $fila['_codigo'];
        $nombreCorto = $fila['_nombreCorto'];
        $nombreCompleto = $fila['_nombreCompleto'];

        $sql = "UPDATE asignatura"
                . " SET codigo = '$codigo',"
                . " nombreCorto = '$nombreCorto',"
                . " nombreCompleto = '$nombreCompleto' "
                . " WHERE id = $id";

        $resultado = $this->_db->query($sql);
        
        return $resultado;
    }

    public function insertar($codigo, $nombreCorto, $nombreCompleto) {
        $sql = "INSERT INTO asignatura(codigo, nombreCorto, nombreCompleto) "
                . " VALUES ('$codigo',"
                . " '$nombreCorto',"
                . " '$nombreCompleto')";
        echo $sql;
        $resultado = $this->_db->query($sql);
        return $resultado;
    }
    public function borrar($id)
    {
        $sql="DELETE FROM asignatura "                
                . " WHERE id= $id";
        $resultado = $this->_db->query($sql);
        return $resultado;
    }

}

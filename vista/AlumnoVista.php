<?php

abstract class AlumnoVista {
    public static function mostrarListado($alumnos, $mensaje="")
    {
//        var_dump($alumnos);
        $retorno = '<h1>Listado de Alumnos</h1>';
        if($mensaje!=""){
            $retorno .= '<h3>El alumno ha sido ' . $mensaje . ' correctamente </h3>';
        }
        $retorno .= '<ul>';
        foreach ($alumnos as $alumno) {
            $retorno  .= '<li>' .$alumno['nombre'] . ' ' . 
            $alumno['apellido'] ;
            $retorno .= " <a href='?modulo=detalle&numero=" . $alumno['ID'] . "'>Mostrar</a> | ";
            $retorno .= " <a href='?modulo=modificaralumno&numero=" . $alumno['ID'] . "'>Modificar</a> | ";
            $retorno .= " <a href='?modulo=borrar&numero=" . $alumno['ID'] . "'>Eliminar</a> | ";
            $retorno .='</li>';
            }        
        $retorno .= '</ul>';
        $retorno .= "<p><a href='?modulo=nuevoalumno'>Nuevo Alumno</a></p>";
        echo $retorno;
        
    }
    
    public static function mostrarDetalle(Alumno $alumno)
    {
        $html = '<h1>Datos del alumno</h1>';
        $html .= 'Número: ' . $alumno->getNumero() . '<br>';
        $html .= 'Nombre: ' . $alumno->getNombre() . '<br>';
        $html .= 'Apellidos: ' . $alumno->getApellidos() . '<br>';
        $html .= 'Edad: ' . $alumno->getEdad() . '<br>';
        
        $html .= '<p><a href="?modulo=listado">Listado de alumnos</p>';

        echo $html;
    }
    
    public static function mostrarFormInsertar()
    {
        $html = self::_htmlFormulario();        
        $html .= '<p><a href="?modulo=listado">Listado de alumnos</p>';
        echo $html;
    }
    
    public static function mostrarFormModificar(Alumno $alumno) {   
        $html = self::_htmlFormulario(
        $alumno->getNumero(),
        $alumno->getNombre(),
        $alumno->getApellidos(),
        $alumno->getEdad(),
        'modificar');

        $html .= '<p><a href="?modulo=listado">Listado de alumnos</p>';

        echo $html;        
    }

    static private function _htmlFormulario($numero = "", $nombre = "", 
            $apellidos = "", $edad="" , $accion = "insertar")
    {
        $readonly = $accion=='modificar' ? "readonly" : "";
        $accionMsg = ucwords($accion);
        $html = "<h1> $accionMsg alumno</h1>";
        $html .= '<form action="?modulo=' . $accion . '&numero=' . $numero . '" method="post">';
        $html .= "<input type='hidden' name='numero' value=$numero $readonly>";
        $html .= "Nombre: <input type='text' name='nombre' value='$nombre'><br>";
        $html .= "Apellidos: <input name='apellidos' value='$apellidos'><br>";
        $html .= 'Edad: <input name="edad" value="' .$edad . '"><br>';
        $html .= "<input type='submit' name='sumbit' value='" . ucwords($accion) . "'>";
        $html .= '</form>';
        return $html;
    }
}

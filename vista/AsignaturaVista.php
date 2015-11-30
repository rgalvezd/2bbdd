<?php

abstract class AsignaturaVista {
    public static function mostrarListado($asignaturas, $mensaje="")
    {
//        var_dump($alumnos);
        $retorno = '<h1>Listado de Asignaturas</h1>';
        if($mensaje!=""){
            $retorno .= '<h3>La asignatura ha sido ' . $mensaje . ' correctamente </h3>';
        }
        $retorno .= '<ul>';
        foreach ($asignaturas as $asignatura) {
            $retorno  .= '<li>' .$asignatura['codigo'] . ' ' . 
            $asignatura['nombreCorto'] ;
            $retorno .= " <a href='?modulo=detalleAsignatura&numero=" . $asignatura['id'] . "'>Mostrar</a> | ";
            $retorno .= " <a href='?modulo=modificarAsignatura&numero=" . $asignatura['id'] . "'>Modificar</a> | ";
            $retorno .= " <a href='?modulo=borrarAsignatura&numero=" . $asignatura['id'] . "'>Eliminar</a> | ";
            $retorno .='</li>';
            }        
        $retorno .= '</ul>';
        $retorno .= "<p><a href='?modulo=nuevaAsignatura'>Nueva Asignatura</a></p>";
        echo $retorno;
        
    }
    
    public static function mostrarDetalle(Asignatura $asignatura)
    {
        $html = '<h1>Datos de la asignatura</h1>';
        $html .= 'Id: ' . $asignatura->get_id() . '<br>';
        $html .= 'Código: ' . $asignatura->get_codigo() . '<br>';
        $html .= 'Nombre Corto: ' . $asignatura->get_nombreCorto() . '<br>';
        $html .= 'Nombre Completo: ' . $asignatura->get_nombreCompleto() . '<br>';
        
        $html .= '<p><a href="?modulo=listadoAsignaturas">Listado de asignaturas</p>';

        echo $html;
    }
    
    public static function mostrarFormInsertar()
    {
        $html = self::_htmlFormulario();        
        $html .= '<p><a href="?modulo=listadoAsignaturas">Listado de asignaturas</p>';
        echo $html;
    }
    
    public static function mostrarFormModificar(Asignatura $asignatura) {   
        $html = self::_htmlFormulario(
        $asignatura->get_id(),
        $asignatura->get_codigo(),
        $asignatura->get_nombreCorto(),
        $asignatura->get_nombreCompleto(),
        'modificarAsig');

        $html .= '<p><a href="?modulo=listadoAsignaturas">Listado de asignaturas</p>';

        echo $html;        
    }

    static private function _htmlFormulario($id = "", $codigo = "", 
            $nombreCorto = "", $nombreCompleto="" , $accion = "insertarAsignatura")
    {
        $readonly = $accion=='modificarAsig' ? "readonly" : "";
        $accionMsg = ucwords($accion);
        $html = "<h1> $accionMsg</h1>";
        $html .= '<form action="?modulo=' . $accion . '&numero=' . $id . '" method="post">';
        $html .= "<input type='hidden' name='numero' value=$id $readonly>";
        $html .= "Código: <input type='text' name='codigo' value='$codigo'><br>";
        $html .= "Nombre Corto: <input name='nombreCorto' value='$nombreCorto'><br>";
        $html .= 'Nombre Completo: <input name="nombreCompleto" value="' .$nombreCompleto . '"><br>';
        $html .= "<input type='submit' name='sumbit' value='" . ucwords($accion) . "'>";
        $html .= '</form>';
        return $html;
    }
}

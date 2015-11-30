<!DOCTYPE html>
<?php
require_once 'controlador/Alumno.php';
require_once 'vista/AlumnoVista.php';
require_once 'controlador/Asignatura.php';
require_once 'vista/AsignaturaVista.php';

abstract class Index
{
    public static function ejecutar()
    {
        //si hay argumentos GET
        if(count($_GET)>0){
        // procesarModulo
            self::_procesarModulo();
        }
        //si no los hay llamar al moduloDefecto
        else{
            self::_moduloDefecto();
        }
    }
    private static function _moduloDefecto()
    {
        echo 'Pagina por Defecto'; 
        echo '<ul>'; 
        echo '<li><a href="?modulo=listado">Listado de alumnos</li>';
        echo '<li><a href="?modulo=nuevoalumno">Crear nuevo alumno</li>';
        echo '<li><a href="?modulo=listadoAsignaturas">Listado de asignaturas</li>';
        echo '<li><a href="?modulo=nuevaAsignatura">Crear nueva asignatura</li>';
        echo '</ul>';        
    }
    private static function _noExisteModulo()
    {
        echo 'El módulo solicitado no Existe';
    }
    private static function _procesarModulo()
    {
        switch($_GET['modulo']){
        case 'listado':                        
            $alumnos= Alumno::getAll();
            AlumnoVista::mostrarListado($alumnos);
            
            break;
        case 'nuevoalumno':
            AlumnoVista::mostrarFormInsertar();
            break;
        case 'insertar':
            var_dump($_POST);
            $alumno = new Alumno(null, $_POST['nombre'], $_POST['apellidos'], $_POST['edad']);
            var_dump($alumno);
            if ($alumno->insertar()) {
                header("Location:index.php?modulo=listado&mensaje=insertado");
            }
            break;
        case 'borrar':
            $alumno = new Alumno;
            $alumno->getAlumno($_GET['numero']);            
            if ($alumno->borrar()){
                header("Location:index.php?modulo=listado&mensaje=borrado");
            }
            break;
        case 'modificaralumno':
            $alumno= new Alumno;
            $alumno->getAlumno($_GET['numero']);
            AlumnoVista::mostrarFormModificar($alumno);
            break;
        case 'modificar': //alumnomodificado...
            $alumno = new Alumno;            
            $alumno->setNumero($_GET['numero']);
            $alumno->setNombre($_POST['nombre']);
            $alumno->setApellidos($_POST['apellidos']);
            $alumno->setEdad($_POST['edad']);            
            if ($alumno->modificar()){
                header("Location:index.php?modulo=listado&mensaje=guardado");
            }
            break;
        case 'detalle':
            //recoger el ID
            $numero=$_GET['numero'];
            //crear un objeto y cargarlo de la bbdd
            $alumno=new Alumno;
            $alumno->getAlumno($numero);
            //mostrarlo
            AlumnoVista::mostrarDetalle($alumno);
            
            break;
        
        
        // Asignaturas
        case 'listadoAsignaturas':                        
            $asignaturas= Asignatura::getAll();
            AsignaturaVista::mostrarListado($asignaturas);
            
            break;
        case 'nuevaAsignatura':
            AsignaturaVista::mostrarFormInsertar();
            break;
        
        case 'insertarAsignatura':
            var_dump($_POST);
            $asignatura = new Asignatura(null, $_POST['codigo'], $_POST['nombreCorto'], $_POST['nombreCompleto']);
            var_dump($asignatura);
            if ($asignatura->insertar()) {
                header("Location:index.php?modulo=listadoAsignaturas&mensaje=insertado");
            }
            break;
        case 'borrarAsignatura':
            $asignatura = new Asignatura();
            $asignatura->getAsignatura($_GET['numero']);            
            if ($asignatura->borrar()){
                header("Location:index.php?modulo=listadoAsignaturas&mensaje=borrado");
            }
            break;
        case 'modificarAsignatura':
            $asignatura= new Asignatura();
            $asignatura->getAsignatura($_GET['numero']);
            AsignaturaVista::mostrarFormModificar($asignatura);
            break;
        
        case 'modificarAsig': //asignaturamodificado...
            
            $asignatura = new Asignatura;            
            $asignatura->set_id($_GET['numero']);
            $asignatura->set_codigo($_POST['codigo']);
            $asignatura->set_nombreCorto($_POST['nombreCorto']);
            $asignatura->set_nombreCompleto($_POST['nombreCompleto']);            
            if ($asignatura->modificar()){
                header("Location:index.php?modulo=listadoAsignaturas&mensaje=guardado");
            }
            else{
                echo 'falla';
            }
            break;
        case 'detalleAsignatura':
            //recoger el ID
            $id=$_GET['numero'];
            //crear un objeto y cargarlo de la bbdd
            $asignatura=new Asignatura;
            $asignatura->getAsignatura($id);
            //mostrarlo
            AsignaturaVista::mostrarDetalle($asignatura);
            
            break;
        
        
        default :
            self::_noExisteModulo();
        }
    }
}


Index::ejecutar();
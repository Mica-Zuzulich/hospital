<?php
require_once './app/modelos/modeloCitas.php';
require_once './app/vistas/vistaCitas.php';

class CitasControlador {

    private $vista;
    private $modelo;
    
    public function __construct() {
        $this->vista = new VistaCitas();
        $this->modelo = new ModeloCitas();
    }

    public function citaPorPaciente($idPaciente) {
        $citas = $this->modelo->obtenerCitasPorPaciente($idPaciente); 
        $this->vista->mostrarCitas($citas); 
    }
    public function obtenerCitas(){
        $citas = $this->modelo->obtenerCitas();
        $this->vista->mostrarCitas($citas);
    }

    public function agregarCita(){
        $paciente_id = $_POST['paciente_id'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $this->modelo->agregarCita($paciente_id, $fecha, $hora);
        header('Location: ' . BASE_URL . 'citas');
        exit();
    }
    public function eliminarCita($id){
        $this->modelo->eliminarCita($id);
        header('Location: ' . BASE_URL . 'citas'); 
        
        exit();
    }
    public function editarCita($id) {
        $cita = $this->modelo->obtenerCitaPorId($id);
        if (!$cita) {
            header("Location: " . BASE_URL . "citas");
            exit();
        }
        $this->vista->mostrarFormularioEdicion($cita); // Muestra el formulario de edición
    }
    public function actualizarCita($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paciente_id = $_POST['paciente_id'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $this->modelo->actualizarCita($id, $paciente_id, $fecha, $hora);
            
            // Para depuración: mostrar mensaje o comprobar
            echo "Cita actualizada con éxito";
            header('Location: ' . BASE_URL . 'citas');
            exit();
        } else {
            $this->editarCita($id);
        }
        }
        
    
    
    
}
<?php
require 'conexion.php';

session_start();
$documento = $_SESSION['documento_session'];

if(isset($_POST['agendar'])) {
    $stmt = $pdo->prepare("INSERT INTO tab_agendar_cita (id_usuario, id_tipo_cita, id_profesional, fecha_cita, estado_cita) VALUES (:where_documento, :tipo_cita, :id_profesional, :fecha_cita, 'PENDIENTE')");
    $stmt->execute([
        'where_documento' => $documento,
        'tipo_cita' => $_POST['tipo_cita'],
        'id_profesional' => $_POST['tipo_cita'], 
        'fecha_cita' => $_POST['fecha_cita']

        
    ]);header('Location: index.php');
}






?>

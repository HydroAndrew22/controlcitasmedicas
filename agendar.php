<?php
require 'conexion.php';

if(isset($_POST['agendar'])) {
    $stmt = $pdo->prepare("INSERT INTO tab_agendar_cita (id_usuario, id_tipo_cita, id_profesional, fecha_cita) VALUES ('123', :tipo_cita, :tipo_cita, :fecha_cita)");
    $stmt->execute([
        
        'tipo_cita' => $_POST['tipo_cita'],
        'id_profesional' => $_POST['tipo_cita'], 
        'fecha_cita' => $_POST['fecha_cita']

        
    ]);
    header('Location: index.php');
}












/* 
if(isset($_POST['agendar'])) {
    $stmt = $pdo->prepare("INSERT INTO citas (fecha_cita, motivo) VALUES (:fecha_cita, :motivo)");
    $stmt->execute(['fecha_cita' => $_POST['fecha_cita'], 'motivo' => $_POST['motivo']]);
    header('Location: index.php');
}
*/



?>

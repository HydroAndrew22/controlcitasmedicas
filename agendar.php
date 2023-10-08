<?php
require 'conexion.php';
$conn = new mysqli("localhost", "root", "","bdclinica"); 

session_start();
$documento = $_SESSION['documento_session'];


/*Control de agendas doble */

$queryvalidacion    = mysqli_query($conn, "SELECT * FROM vw_agendar_cita");
$nfilval = mysqli_num_rows($queryvalidacion);


if(($nfilval >= 1))
{
    echo "<script>alert('El documento: $documento cuenta con una solicitud en tramite, por favor confirmela para proceder a agendar una cita nueva');window.location='index.php#saltotabla'</script>";
}
else
{

if(isset($_POST['agendar'])) {
    $stmt = $pdo->prepare("INSERT INTO tab_agendar_cita (id_usuario, id_tipo_cita, id_profesional, fecha_cita, estado_cita) VALUES (:where_documento, :tipo_cita, :id_profesional, :fecha_cita, 'PENDIENTE')");
    $stmt->execute([
        'where_documento' => $documento,
        'tipo_cita' => $_POST['tipo_cita'],
        'id_profesional' => $_POST['tipo_cita'], 
        'fecha_cita' => $_POST['fecha_cita']

        
    ]);header('Location: index.php#saltotabla');
}

}



?>

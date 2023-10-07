<?php
require 'conexion.php';


session_start();
$documento = $_SESSION['documento_session'];

$stmt = $pdo->prepare("SELECT * FROM tab_agendar_cita WHERE id_usuario=:id_usuario");
$stmt->execute(['id_usuario' => $_GET['id_usuario']]);
$cita = $stmt->fetch();




?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Cita</title>
</head>
<body>
    <h2>Editar Cita</h2>
    <form action="index.php" method="POST">
        <input type="hidden" name="id_cita" value="<?php echo $cita['id_usuario']; ?>">
        <label for="fecha_cita">Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_cita" value="<?php echo $cita['fecha_cita']; ?>" required>
        
        <label for="lang">Tipo de Cita: </label>
            <select name="tipo_cita" id="lang">
            <option value="1">Cardiología</option>
            <option value="2">Dermatología</option>
            <option value="3">Ginecobstetricia</option>
            <option value="4">Ginecología</option>
            <option value="5">Internista</option>
            <option value="6">Medicina General</option>
            <option value="7">Nutricionista</option>
            <option value="8">Oftalmología</option>
            <option value="9">Ortopédia</option>
            <option value="10">Otorrinolaringología</option>
            <option value="11">Pediatría</option>
            <option value="12">Urología</option>
        </select>


        <button type="submit" name="editar">Guardar Cambios</button>
    </form>
</body>
</html>

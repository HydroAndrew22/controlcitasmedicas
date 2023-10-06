<?php
require 'conexion.php';

$stmt = $pdo->prepare("SELECT * FROM citas WHERE id=:id");
$stmt->execute(['id' => $_GET['id']]);
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
        <input type="hidden" name="id_cita" value="<?php echo $cita['id']; ?>">
        <label for="fecha_cita">Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_cita" value="<?php echo $cita['fecha_cita']; ?>" required>
        <label for="motivo">Motivo:</label>
        <textarea name="motivo" required><?php echo $cita['motivo']; ?></textarea>
        <button type="submit" name="editar">Guardar Cambios</button>
    </form>
</body>
</html>

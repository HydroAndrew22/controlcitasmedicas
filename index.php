<?php
require 'conexion.php';


if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado='CANCELADA' WHERE id_usuario=:id_usuario");
    $stmt->execute(['id_usuario' => $_GET['id_usuario']]);
}

if(isset($_POST['editar'])) {
    /*$stmt = $pdo->prepare("UPDATE tab_agendar_cita SET fecha_cita=:fecha_cita, motivo=:motivo WHERE id=:id");
    $stmt->execute(['fecha_cita' => $_POST['fecha_cita'], 'motivo' => $_POST['motivo'], 'id' => $_POST['id_cita']]); */

    $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET id_usuario=$documento, id_tipo_cita=:tipo_cita, id_profesional=:tipo_cita WHERE id_usuario=:documento");
    $stmt->execute(['fecha_cita' => $_POST['fecha_cita'], 'motivo' => $_POST['motivo'], 'id' => $_POST['id_cita']]);

    

}

if(isset($_GET['accion'])) {
    if ($_GET['accion'] == 'eliminar') {
        $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado='CANCELADA' WHERE id_usuario=:iid_usuariod");
        $stmt->execute(['id_usuario' => $_GET['id_usuario']]);
    } elseif ($_GET['accion'] == 'confirmar') {
        $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado='CONFIRMADA' WHERE id_usuario=:id_usuario");
        $stmt->execute(['id_usuario' => $_GET['id_usuario']]);
    }
}



$stmt = $pdo->prepare("SELECT * FROM vw_agendar_cita"); /* contiene WHERE estado_cita='PENDIENTE'*/
$stmt->execute();
$citas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>..:: Agendamiento ::..</title>
</head>
<body>
    <h2>Agendar Cita</h2>
    <form action="agendar.php" method="POST">
        
        <label for="fecha_cita">Fecha y Hora:</label>
        <input type="datetime-local" name="fecha_cita" required><br>
        <!-- <label for="motivo" >Motivo:</label>
        <textarea name="motivo" placeholder="Ingresar motivo"required></textarea><br> -->

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
        <button type="submit" name="agendar">Agendar Cita</button>

    </form>







    <h2>Agenda de Citas</h2>
    <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Estado Cita</th>
            <th>Tipo cita Seleccionada</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($citas as $cita): ?>
            <tr>
                <td><?php echo $cita['fecha_cita']; ?></td>
                <td><?php echo $cita['estado_cita']; ?></td>
                <td><?php echo $cita['id_tipo_cita']; ?></td>
                <td>
                    <a href="editar.php?id_usuario=<?php echo $cita['id_usuario']; ?>">Editar</a>
                    <a href="index.php?accion=eliminar&id_usuario=<?php echo $cita['id_usuario']; ?>">Cancelar</a>
                    <a href="index.php?accion=confirmar&id_usuario=<?php echo $cita['id_usuario']; ?>">Confirmar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


<?php
require 'conexion.php';

session_start();
$documento = $_SESSION['documento_session'];



if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado_cita='CANCELADA' WHERE id_usuario=:where_documento");
    $stmt->execute(['where_documento' => $documento]);
}


if(isset($_POST['editar'])) {
    /* OK */

    $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET fecha_cita=:fecha_cita, id_tipo_cita=:tipo_cita, id_profesional=:profesional WHERE id_usuario=:where_documento");
    $stmt->execute([
        'where_documento' => $documento,
        'fecha_cita' => $_POST['fecha_cita'], 
        'profesional' => $_POST['tipo_cita'], 
        'tipo_cita' => $_POST['tipo_cita']

    ]); /*header('Location: index.php'); */
}

if(isset($_GET['accion'])) {
    if ($_GET['accion'] == 'eliminar') {
        $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado_cita='CANCELADA' WHERE id_usuario=:where_documento");
        $stmt->execute(['where_documento' => $documento]);header('Location: index.php');
    } elseif ($_GET['accion'] == 'confirmar') {
        $stmt = $pdo->prepare("UPDATE tab_agendar_cita SET estado_cita='CONFIRMADA' WHERE id_usuario=:where_documento");
        /* $stmt->execute(['where_documento' => $documento]);header('Location: index.php'); */
        $stmt->execute(['where_documento' => $documento]);
        echo "<script>alert('Cita Confirmada');window.location='index.php'</script>";
    }
}




$stmt = $pdo->prepare("SELECT * FROM vw_agendar_cita"); /* contiene WHERE estado_cita='PENDIENTE' y se usa para el cuadro de abajo */
$stmt->execute();
$citas = $stmt->fetchAll();

$stmt2 = $pdo->prepare("SELECT * FROM vw_agendar_cita"); /* contiene WHERE estado_cita='CONFIRMADA Y MAXIMA' y se usa para el cuadro de abajo */
$stmt2->execute();
$confirs = $stmt2->fetchAll();

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
                <td><?php echo $cita['tipo']; ?></td>
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







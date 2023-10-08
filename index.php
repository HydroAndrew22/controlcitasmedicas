<?php
require 'conexion.php';
$conn = new mysqli("localhost", "root", "","bdclinica"); 

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

    ]);header('Location: index.php#saltotabla');
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


$stmt3 = mysqli_query($conn, "SELECT id_usuario, CONCAT(nombre,' ', apellido) as nombre_usuario FROM tab_usuarios WHERE id_usuario=$documento");
$buscarusuario     = mysqli_fetch_array($stmt3);

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>..:: Agendamiento ::..</title>
      <!-- BOOTSTRAP 4  -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">        <!-- CSS PERSONALIZADO-->
       
    <!-- Estilos locales -->
    <link rel="stylesheet" type="text/css" href="static/css/main.css"> 
    
</head>


<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">Bienvenido: <i><?php echo $buscarusuario['nombre_usuario']; ?></a></i>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="consultarcitas.php">Consultar Citas</a>
                    </li>
   
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="cerrarsesion.php"> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h2>Agendar Cita</h2>
                <form class="login" action="agendar.php" method="POST">
                
                    <label for="fecha_cita">Fecha y Hora:</label>
                    <input type="datetime-local" name="fecha_cita" required><br><br>
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
                    <button type="submit" class="button login__submit" name="agendar">
                        <span class="button__text">Agendar Cita &nbsp;&nbsp; </span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                            <style>svg{fill:#4c489d}</style>
                            <path d="M232 224h56v56a8 8 0 0 0 8 8h48a8 8 0 0 0 8-8v-56h56a8 8 0 0 0 8-8v-48a8 8 0 0 0-8-8h-56v-56a8 8 0 0 0-8-8h-48a8 8 0 0 0-8 8v56h-56a8 8 0 0 0-8 8v48a8 8 0 0 0 8 8zM576 48a48.14 48.14 0 0 0-48-48H112a48.14 48.14 0 0 0-48 48v336h512zm-64 272H128V64h384zm112 96H381.54c-.74 19.81-14.71 32-32.74 32H288c-18.69 0-33-17.47-32.77-32H16a16 16 0 0 0-16 16v16a64.19 64.19 0 0 0 64 64h512a64.19 64.19 0 0 0 64-64v-16a16 16 0 0 0-16-16z"/>
                        </svg>
                    </button>
                </form>

            </div>	
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>		
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>

    <div id="saltotabla">
        <h3>Próximas Citas</h3>
    </div>
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


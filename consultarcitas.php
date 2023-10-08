<?php
require 'conexion.php';
$conn = new mysqli("localhost", "root", "","bdclinica"); 

session_start();
$documento = $_SESSION['documento_session'];


$stmt = $pdo->prepare("SELECT ac.id_usuario, ac.id_tipo_cita, ac.fecha_cita, ac. estado_cita, em.id_profesional, 
    CONCAT(em.nombre,' ', em.apellido) as nombre_profesional, em.id_especialidad, em.sede, tp.tipo 
    FROM tab_agendar_cita ac 
    LEFT join tab_empleados em on em.id_profesional = ac.id_profesional 
    LEFT join tab_tipo_cita tp on tp.id_tipo_cita = ac.id_tipo_cita
    WHERE ac.id_usuario = $documento
    order by ac.fecha_cita DESC"); 
$stmt->execute();
$citas = $stmt->fetchAll();



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
                        <a class="nav-link" aria-current="page" href="index.php">Agendar Citas</a>
                    </li>
   
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="cerrarsesion.php"> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


<table border="1">
        <tr>
            <th>Fecha</th>
            <th>Estado Cita</th>
            <th>Profesional</th>
            <th>Especialidad</th>
            <th>sede</th>
        </tr>
        <?php foreach($citas as $cita): ?>
            <tr>
                <td><?php echo $cita['fecha_cita']; ?></td>
                <td><?php echo $cita['estado_cita']; ?></td>
                <td><?php echo $cita['nombre_profesional']; ?></td>
                <td><?php echo $cita['tipo']; ?></td>
                <td><?php echo $cita['sede']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>



    </body>
</html>
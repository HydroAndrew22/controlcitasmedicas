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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>..:: Editar Cita ::..</title>
      <!-- BOOTSTRAP 4  -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       
    <!-- Estilos locales -->
    <link rel="stylesheet" type="text/css" href="static/css/main.css"> 
</head>

<body>


    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <h2>Editar Cita</h2>
                <form class="login" action="agendar_cita.php" method="POST">
                    <input type="hidden" name="id_cita" value="<?php echo $cita['id_usuario']; ?>">
                    <label for="fecha_cita">Fecha y Hora:</label>
                    <input type="datetime-local" name="fecha_cita" value="<?php echo $cita['fecha_cita']; ?>" required>
                    
                    <br><br><label for="lang">Tipo de Cita: </label>
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
                    <!--<button type="submit" name="editar" >Guardar Cambios</button> -->
                    <button type="submit" class="button login__submit" name="editar">
                        <span class="button__text">Guardar Cambios &nbsp;&nbsp; </span>
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
</body>
</html>

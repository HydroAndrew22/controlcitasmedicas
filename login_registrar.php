<?php

require 'conexion.php';
 $conn = new mysqli("localhost", "root", "","bdclinica"); 

if($conn->connect_errno)
{
    echo "No hay conexión: (".$conn->connect_errno.")".$conn->connect_error; 
}


$documento = $_POST['txtdocumento'];
$pass = $_POST['txtpassword'];


if (isset($_POST['btnregistrar']))
{
    $pass_fuerte = password_hash($pass, PASSWORD_DEFAULT);

    $nombre = $_POST['txtusuario'];
    $apellido = $_POST['txtapellido'];
    $email = $_POST['txtemail'];

    $direccion = $_POST['txtdireccion'];
    $departamento = $_POST['txtdepartamento'];
    $ciudad = $_POST['txtciudad'];


/*Control de registro doble */
    $queryvalidacion    = mysqli_query($conn, "SELECT * FROM tab_usuarios WHERE id_usuario = '$documento'");
    $nfilval            = mysqli_num_rows($queryvalidacion);
    
    if(($nfilval >= 1))
    {
        echo "<script>alert('El documento: $documento ya está registrado, intente otra vez por favor ');window.location='index.html'</script>";
    }
    else
    {

        $queryregistrar = "INSERT INTO tab_usuarios(id_usuario, nombre, apellido, email, password, direccion, departamento, ciudad) VALUES ('$documento', '$nombre', '$apellido', '$email', '$pass_fuerte', '$direccion', '$departamento', '$ciudad' )" ;
     /* $queryregistrar = "INSERT INTO login(id_login, nombre) VALUES ('$nombre', '$pass_fuerte' )" ; */
        if(mysqli_query($conn, $queryregistrar))
        {
            echo "<script>alert('Usuario registrado: $nombre ');window.location='index.php'</script>";
        }
        else
        {
            echo "Error: ".$queryregistrar."<br>".mysql_error($conn);
        }
    }
}





/* LOGIN OK*/


if(isset($_POST['btnlogin']))
{
    $queryusuario   = mysqli_query($conn, "SELECT id_usuario, password, nombre, apellido FROM tab_usuarios WHERE id_usuario = '$documento'");
    $nfil           = mysqli_num_rows($queryusuario);
    $buscarpass     = mysqli_fetch_array($queryusuario);
    
    if(($nfil == 1) && (password_verify($pass,$buscarpass['password'])))
    {
       echo "<script>alert('Bienvenido: $documento');window.location='index.php'</script>";
    }
    else
    {
        echo "<script>alert('Usuario o contraseña incorrecto');window.location='index.html'</script>";
    }
}






















?>



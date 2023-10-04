<?php

$conn = new mysqli("localhost", "root", "","bdclinica");

if($conn->connect_errno)
{
    echo "No hay conexión: (".$conn->connect_errno.")".$conn->connect_error; 
}

$nombre = $_POST['txtusuario'];
$pass = $_POST['txtpassword'];

if (isset($_POST['btnregistrar']))
{
    $pass_fuerte = password_hash($pass, PASSWORD_DEFAULT);
    $queryregistrar = "INSERT INTO login(id_login, nombre) VALUES ('$nombre', '$pass_fuerte' )" ;

    if(mysqli_query($conn, $queryregistrar))
    {
        echo "<script>alert('Usuario registrado: $nombre');window.location='index.html'</script>";
    }
    else
    {
        echo "Error: ".$queryregistrar."<br>".mysql_error($conn);
    }
}


if(isset($_POST['btnlogin']))
{
    $queryusuario   = mysqli_query($conn, "SELECT * FROM login WHERE id = '$nombre'");
    $nfil           = mysqli_num_rows($queryusuario);
    $buscarpass     = mysqli_fetch_array($queryusuario);
    
    if(($nfil == 1) && (password_verify($pass,$buscarpass['nombre'])))
    {
        echo "Bienvenido: $nombre";
    }
    else
    {
        echo "<script>alert('Usuario o contraseña incorrecto');window.location='index.html'</script>";
    }
}

/* controlar el registro, deja duplicados */

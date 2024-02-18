<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';
    $email = $_GET['cosa'];

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nombre = isset($_POST['InputName1']) ? $_POST['InputName1'] : '';
    $telefono = isset($_POST['InputNumbre1']) ? $_POST['InputNumbre1'] : '';
    $correo = isset($_POST['InputEmail1']) ? $_POST['InputEmail1'] : '';
    $clave = isset($_POST['InputPassword1']) ? $_POST['InputPassword1'] : '';

    if (!empty($nombre)) {
        $ssql1 = "UPDATE treballadors SET NomTreballador ='$nombre' WHERE Email ='$email'";
        $conn->query($ssql1);
    }

    //-------------------------------------------------------------------

    if (!empty($telefono)) {
        $ssql3 = "UPDATE treballadors SET Telefon = '$telefono' WHERE Email = '$email'";
        $conn->query($ssql3);
    }

    //-------------------------------------------------------------------

    if (!empty($correo)) {
        $ssql5 = "UPDATE treballadors SET Email = '$correo' WHERE Email = '$email'";
        $conn->query($ssql5);
    }

    //-------------------------------------------------------------------

    if (!empty($clave)) {
        $ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
        $ssql6 = "UPDATE treballadors SET Clave = '$ClaveEncryp' where Email = '$email'";
        $conn->query($ssql6);
    }

    $conn->close();

    header("Location: InfoPersonalTr.php?cosa=$email");
?>
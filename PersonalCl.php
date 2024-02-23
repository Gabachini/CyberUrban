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

    $nombre = $conn->escape_string($_POST['InputName1']);
    $direccion = $conn->escape_string($_POST['InputPath1']);
    $telefono = $conn->escape_string($_POST['InputNumbre1']);
    $correo = $conn->escape_string($_POST['InputEmail1']);
    $clave = $conn->escape_string($_POST['InputPassword1']);

    if (!empty($nombre)) {
        $ssql1 = "UPDATE clients SET Nom='$nombre' WHERE Email='$email'";
        $conn->query($ssql1);
    }

    //-------------------------------------------------------------------
    
    if (!empty($direccion)) {
        $sql1 = $conn->prepare('UPDATE clients SET Direccio = ? WHERE Email = ?');
        $sql1->bind_param('ss', $direccion, $email);
        $sql1->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($telefono)) {
        $sql1 = $conn->prepare('UPDATE clients SET NumTelefon = ? WHERE Email = ?');
        $sql1->bind_param('ss', $telefono, $email);
        $sql1->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($correo)) {
        $sql1 = $conn->prepare('UPDATE clients SET Email = ? WHERE Email = ?');
        $sql1->bind_param('ss', $correo, $email);
        $sql1->execute();

        header("Location: InfoPersonalCl.php?cosa=$correo");
    }

    //-------------------------------------------------------------------

    if (!empty($clave)) {
        $ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
        $sql1 = $conn->prepare('UPDATE clients SET Clave = ? where Email = ?');
        $sql1->bind_param('ss', $ClaveEncryp, $email);
        $sql1->execute();
    }

    $conn->close();

    if (empty($correo)) {
        header("Location: InfoPersonalCl.php?cosa=$email");
    }
?>
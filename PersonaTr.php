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

    $Verificacion = "";

    $nombre = $conn->escape_string($_POST['InputName1']);
    $telefono = $conn->escape_string($_POST['InputNumbre1']);
    $clave = $conn->escape_string($_POST['InputPassword1']);

    if (!empty($nombre)) {
        $sql1 = $conn->prepare('UPDATE treballadors SET NomTreballador = ? WHERE Email = ?');
        $sql1->bind_param('ss', $nombre, $email);
        $sql1->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($telefono)) {
        $sql2 = $conn->prepare('UPDATE treballadors SET Telefon = ? WHERE Email = ?');
        $sql2->bind_param('ss', $telefono, $email);
        $sql2->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($clave)) {
        $ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
        $sql3 = $conn->prepare('UPDATE treballadors SET Clave = ? where Email = ?');
        $sql3->bind_param('ss', $ClaveEncryp, $email);
        $sql3->execute();
    }

    if ($sql1->affected_rows === 0 || $sql2->affected_rows === 0 || $sql3->affected_rows === 0) {
        $Verificacion = "No se han realizado los cambios correctamente.";
    } else {
        $Verificacion = "Se han realizado los cambios correctamente.";
    }

    $conn->close();

    header("Location: InfoPersonalTr.php?cosa=$email&pepe=$Verificacion");
?>
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
    $telefono = $conn->escape_string($_POST['InputNumbre1']);
    $clave = $conn->escape_string($_POST['InputPassword1']);

    if (!empty($nombre)) {
        $sql1 = $conn->prepare('UPDATE treballadors SET NomTreballador = ? WHERE Email = ?');
        $sql1->bind_param('ss', $nombre, $email);
        $sql1->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($telefono)) {
        $sql1 = $conn->prepare('UPDATE treballadors SET Telefon = ? WHERE Email = ?');
        $sql1->bind_param('ss', $telefono, $email);
        $sql1->execute();
    }

    //-------------------------------------------------------------------

    if (!empty($clave)) {
        $ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
        $sql1 = $conn->prepare('UPDATE treballadors SET Clave = ? where Email = ?');
        $sql1->bind_param('ss', $ClaveEncryp, $email);
        $sql1->execute();
    }

    $conn->close();

    header("Location: InfoPersonalTr.php?cosa=$email");
?>
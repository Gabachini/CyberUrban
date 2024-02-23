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

    $descrp1 = $conn->escape_string($_POST['InputIdentIncid']);

    if (isset($_POST['ButtonIdent1'])) {
        $sql1 = $conn->prepare('DELETE FROM incidencies WHERE IDIncidencia = ?');
        $sql1->bind_param('i', $descrp1);
        $sql1->execute();
    }
    $conn->close();

    header("Location: InfoIncidenAdm.php?cosa=$email");
?>
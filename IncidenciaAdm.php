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

    $descrp1 = isset($_POST['InputIdentIncid']) ? $_POST['InputIdentIncid'] : '';

    if (isset($_POST['ButtonIdent1'])) {
        $sql1 = "DELETE FROM incidencies WHERE IDIncidencia = $descrp1";
        $conn->query($sql1);
    }
    $conn->close();

    header("Location: InfoIncidenAdm.php?cosa=$email");
?>
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

    $IdentReserv = $descrp1 = $conn->escape_string($_POST['IdentReservAdm']);

    if (isset($_POST['ElimReservaAdm'])) {
        $sql1 = $conn->prepare('DELETE FROM reserves WHERE IDReserva = ?');
        $sql1->bind_param('i', $IdentReserv);
        $sql1->execute();
    }
    $conn->close();

    header("Location: InfoReservesAdm.php?cosa=$email");
?>
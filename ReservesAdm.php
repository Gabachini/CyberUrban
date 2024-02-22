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

    $IdentReserv = isset($_POST['IdentReservAdm']) ? $_POST['IdentReservAdm'] : '';

    if (isset($_POST['ElimReservaAdm'])) {
        $sql1 = "DELETE FROM reserves WHERE IDReserva = $IdentReserv";
        $conn->query($sql1);
    }
    $conn->close();

    header("Location: InfoReservesAdm.php?cosa=$email");
?>
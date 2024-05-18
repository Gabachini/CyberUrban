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

    $DateReserva1 = $conn->escape_string($_POST['InputDate1']);
    $IdentReserva1 = $conn->escape_string($_POST['IdentReservAdm1']);
    $DateReserva2 = $conn->escape_string($_POST['InputDate2']);
    $IdentReserva2 = $conn->escape_string($_POST['IdentReservAdm2']);

    if (isset($_POST['CreaReservaAdm'])) {
        $sql1 = $conn->prepare('INSERT INTO reserves (DataReserva, IDClient) VALUES (?, 1)');
        $sql1->bind_param('s', $DateReserva1);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha creado la resersa correctamente.";
        } else {
            $Verificacion = "Se ha creado la resersa correctamente.";
        }
    } else if (isset($_POST['ModiReservaAdm'])) {
        $sql1 = $conn->prepare('UPDATE reserves SET DataReserva = ? WHERE IDReserva = ?');
        $sql1->bind_param('ss', $DateReserva2, $IdentReserva1);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido modicar la reserva correctamente.";
        } else {
            $Verificacion = "Se ha modifcado la reserva correctamente.";
        }
    } else if (isset($_POST['ElimReservaAdm'])) {
        $sql1 = $conn->prepare('DELETE FROM reserves WHERE IDReserva = ?');
        $sql1->bind_param('i', $IdentReserva2);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido eliminar la reserva correctamente.";
        } else {
            $Verificacion = "Se ha eliminado la reserva correctamente.";
        }
    }

    $conn->close();

    header("Location: InfoReservesAdm.php?cosa=$email&pepe=$Verificacion");
?>
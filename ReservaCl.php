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

    $ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
    $result = mysqli_query($conn,$ObtenerID);
    $IDClient = mysqli_fetch_array($result);

    $Date1 = $conn->escape_string($_POST['InputDate1']);
    $Date2 = $conn->escape_string($_POST['InputDate2']);

    if (isset($_POST['AnyaHacRes'])) {
        $sql1 = $conn->prepare('INSERT INTO reserves (DataReserva, IDClient) VALUES (?, ?)');
        $sql1->bind_param('ss', $Date1, $IDClient[0]);
        $sql1->execute();
    } elseif (isset($_POST['AnyaCanRes'])) {
        $sql2 = "DELETE FROM reserves WHERE IDReserva = $Date2";
        $sql1 = $conn->prepare('DELETE FROM reserves WHERE IDReserva = ?');
        $sql1->bind_param('i', $Date2);
        $sql1->execute();
    }
    $conn->close();

    header("Location: InfoReservesCl.php?cosa=$email");
?>
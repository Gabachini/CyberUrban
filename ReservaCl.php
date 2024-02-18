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

    $Date1 = isset($_POST['InputDate1']) ? $_POST['InputDate1'] : '';
    $Date2 = isset($_POST['InputDate2']) ? $_POST['InputDate2'] : '';

    if (isset($_POST['AnyaHacRes'])) {
        $sql1 = "INSERT INTO reserves (DataReserva, IDClient) VALUES ('$Date1', $IDClient[0])";
        $conn->query($sql1);
    } elseif (isset($_POST['AnyaCanRes'])) {
        $sql2 = "DELETE FROM reserves WHERE IDReserva = $Date2";
        $conn->query($sql2);
    }
    $conn->close();

    header("Location: InfoReservesCl.php?cosa=$email");
?>
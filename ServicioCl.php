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

    $IdentServ1 = isset($_POST['InputIdenti1']) ? $_POST['InputIdenti1'] : '';
    $IdentServ2 = isset($_POST['InputIdenti2']) ? $_POST['InputIdenti2'] : '';

    if (isset($_POST['ButtonServi1'])) {
        $sql1 = "INSERT INTO adquireixserv (IDServei, IDClient) VALUES ($IdentServ1 ,$IDClient[0])";
        $conn->query($sql1);
    } elseif (isset($_POST['ButtonServi2'])) {
        $sql2 = "DELETE FROM adquireixserv WHERE IDServei = $IdentServ2 AND IDClient = $IDClient[0]";
        $conn->query($sql2);
    }
    $conn->close();

    header("Location: InfoServiCl.php?cosa=$email");
?>
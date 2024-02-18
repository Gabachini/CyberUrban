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

    $IdentProg1 = isset($_POST['InputIdenti1']) ? $_POST['InputIdenti1'] : '';

    if (isset($_POST['ButtonServi1'])) {
        $sql1 = "INSERT INTO adquireixprog (IDPrograma, IDClient) VALUES ($IdentProg1 ,$IDClient[0])";
        $conn->query($sql1);
    }
    $conn->close();

    header("Location: InfoProgrCl.php?cosa=$email");
?>
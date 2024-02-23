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

    $IdentProg1 = $conn->escape_string($_POST['InputIdenti1']);

    if (isset($_POST['ButtonServi1'])) {
        $sql1 = $conn->prepare('INSERT INTO adquireixprog (IDPrograma, IDClient) VALUES (?, ?)');
        $sql1->bind_param('ii', $IdentProg1, $IDClient[0]);
        $sql1->execute();
    }
    $conn->close();

    header("Location: InfoProgrCl.php?cosa=$email");
?>
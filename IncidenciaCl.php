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

    $IDInci1 = isset($_POST['InputIdent1']) ? $_POST['InputIdent1'] : '';
    $descrp1 = isset($_POST['InputDescr1']) ? $_POST['InputDescr1'] : '';
    $descrp2 = isset($_POST['InputDescr2']) ? $_POST['InputDescr2'] : '';

    if (isset($_POST['CambiIncid'])) {
        $sql1 = "UPDATE incidencies SET Descripcio = '$descrp1' WHERE IDIncidencia = $IDInci1 AND IDClient = $IDClient[0]";
        $conn->query($sql1);
    } elseif (isset($_POST['AnyaIncid'])) {
        $sql2 = "INSERT INTO incidencies (Descripcio, IDClient) VALUES ('$descrp2', $IDClient[0])";
        $conn->query($sql2);
    }
    $conn->close();

    header("Location: InfoIncidenCl.php?cosa=$email");
?>
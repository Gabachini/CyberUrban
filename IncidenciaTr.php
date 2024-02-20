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

    $ObtenerID = "SELECT IDTreballador FROM treballadors WHERE Email = '$email'";
    $result = mysqli_query($conn,$ObtenerID);
    $IDTreballador = mysqli_fetch_array($result);

    $descrp1 = isset($_POST['InputIdent1']) ? $_POST['InputIdent1'] : '';
    $descrp2 = isset($_POST['InputIdent2']) ? $_POST['InputIdent2'] : '';

    if (isset($_POST['ElimiIncid'])) {
        $sql1 = "DELETE FROM incidencies WHERE IDIncidencia = $descrp1 AND IDTreballador = $IDTreballador[0]";
        $conn->query($sql1);
    } elseif (isset($_POST['AceptarInci'])) {
        $sql2 = "UPDATE incidencies SET IDTreballador = $IDTreballador[0], Estat = 'Aceptada' WHERE IDIncidencia = $descrp2";
        echo $sql2;
        $conn->query($sql2);
    }
    $conn->close();

    header("Location: InfoIncidenTr.php?cosa=$email");
?>
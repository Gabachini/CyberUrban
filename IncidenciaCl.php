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

    $Verificacion = "";

    $IDInci1 = $conn->escape_string($_POST['InputIdent1']);
    $descrp1 = $conn->escape_string($_POST['InputDescr1']);
    $descrp2 = $conn->escape_string($_POST['InputDescr2']);

    $ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
    $result = mysqli_query($conn,$ObtenerID);
    $IDClient = mysqli_fetch_array($result);

    if (isset($_POST['CambiIncid'])) {
        $sql1 = $conn->prepare('UPDATE incidencies SET Descripcio = ? WHERE IDIncidencia = ? AND IDClient = ?');
        $sql1->bind_param('sii', $descrp1, $IDInci1, $IDClient[0]);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido cambiar la información de la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha cambiado correctamente la incidencia.";
        }
    } elseif (isset($_POST['AnyaIncid'])) {
        $sql2 = "INSERT INTO incidencies (Descripcio, IDClient) VALUES ('$descrp2', $IDClient[0])";
        $sql2 = $conn->prepare('INSERT INTO incidencies (Descripcio, IDClient) VALUES (?, ?)');
        $sql2->bind_param('si', $descrp2, $IDClient[0]);
        $sql2->execute();

        if ($sql2->affected_rows === 0) {
            $Verificacion = "No se ha podido crear la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha creado la incidencia correctamente.";
        }
    }
    $conn->close();

    header("Location: InfoIncidenCl.php?cosa=$email&pepe=$Verificacion");
?>
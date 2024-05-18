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

    $descrp1 = $conn->escape_string($_POST['InputComeIncid']);
    $identi1 = $conn->escape_string($_POST['InputIdentIncid1']);
    $descrp2 = $conn->escape_string($_POST['InputModiIncid']);
    $identi2 = $conn->escape_string($_POST['InputIdentIncid2']);

    if (isset($_POST['ButtonIdent1'])) {
        $sql1 = $conn->prepare('INSERT INTO incidencies (Descripcio, IDClient) VALUES (?, 1)');
        $sql1->bind_param('s', $descrp1);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido crear la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha creado la incidencia correctamente.";
        }
    } elseif (isset($_POST['ButtonIdent2'])) {
        $sql1 = $conn->prepare('UPDATE incidencies SET Descripcio = ? WHERE IDIncidencia = ?');
        $sql1->bind_param('si', $descrp2, $identi1);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido cambiar la información de la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha cambiado correctamente la incidencia.";
        }
    } elseif (isset($_POST['ButtonIdent3'])) {
        $sql1 = $conn->prepare('DELETE FROM incidencies WHERE IDIncidencia = ?');
        $sql1->bind_param('i', $identi2);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido eliminar la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha eliminado la incidencia correctamente.";
        }
    }
    $conn->close();

    header("Location: InfoIncidenAdm.php?cosa=$email&pepe=$Verificacion");
?>
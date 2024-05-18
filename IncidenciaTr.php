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

    $descrp1 = $conn->escape_string($_POST['InputIdent1']);
    $descrp2 = $conn->escape_string($_POST['InputIdent2']);

    $Verificacion = "";
    $Verificacion2 = "";

    if (isset($_POST['ElimiIncid'])) {
        $sql1 = "DELETE FROM incidencies WHERE IDIncidencia = $descrp1 AND IDTreballador = $IDTreballador[0]";
        $sql1 = $conn->prepare('DELETE FROM incidencies WHERE IDIncidencia = ? AND IDTreballador = ?');
        $sql1->bind_param('ii', $descrp1, $IDTreballador[0]);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido finalizar la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha finalizado la incidencia correctamente.";
        }
    } elseif (isset($_POST['AceptarInci'])) {
        $sql1 = $conn->prepare('UPDATE incidencies SET IDTreballador = ?, Estat = "Aceptada" WHERE IDIncidencia = ?');
        $sql1->bind_param('ii', $IDTreballador[0], $descrp2);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
        $Verificacion = "No se ha podido aceptar la incidencia correctamente.";
        } else {
            $Verificacion = "Se ha aceptado la incidencia correctamente.";
        }
    }
    $conn->close();

    header("Location: InfoIncidenTr.php?cosa=$email&pepe=$Verificacion&pepe2=$Verificacion2");
?>
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

    $UserElimIDClient = $conn->escape_string($_POST['InputIdentCli']);
    $UserElimIDTrabaj = $conn->escape_string($_POST['InputElimTrabaj']);
    $TreballNombr = $conn->escape_string($_POST['InputNombrTrabaj']);
    $TreballEmail = $conn->escape_string($_POST['InputEmailTrabaj']);
    $TreballTelef = $conn->escape_string($_POST['InputTelefTrabaj']);
    $TreballIDDep = $conn->escape_string($_POST['InputIDDepTrabaj']);
    $TreballClave = $conn->escape_string($_POST['InputClaveTrabaj']);

    $ClaveEncryp = password_hash($TreballClave, PASSWORD_DEFAULT);

    $Verif = $_GET['pepe2'];

    if (isset($_POST['ElimClient'])) {
        $sql2 = $conn->prepare('DELETE FROM adquireixprog WHERE IDClient = ?');
        $sql2->bind_param('i', $UserElimIDClient);
        $sql2->execute();
        $sql3 = $conn->prepare('DELETE FROM adquireixserv WHERE IDClient = ?');
        $sql3->bind_param('i', $UserElimIDClient);
        $sql3->execute();
        $sql4 = $conn->prepare('DELETE FROM incidencies WHERE IDClient = ?');
        $sql4->bind_param('i', $UserElimIDClient);
        $sql4->execute();
        $sql5 = $conn->prepare('DELETE FROM reserves WHERE IDClient = ?');
        $sql5->bind_param('i', $UserElimIDClient);
        $sql5->execute();
        $sql6 = $conn->prepare('DELETE FROM ressenyes WHERE IDClient = ?');
        $sql6->bind_param('i', $UserElimIDClient);
        $sql6->execute();

        $sql1 = $conn->prepare('DELETE FROM clients WHERE IDClient = ?');
        $sql1->bind_param('i', $UserElimIDClient);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido eliminar el usuario correctamente.";
        } else {
            $Verificacion = "Se ha eliminado el usuario correctamente.";
        }
    } elseif (isset($_POST['CrearTrabaj'])) {
        $sql1 = $conn->prepare('INSERT INTO treballadors (NomTreballador, Email, Telefon, IDDepartament, Clave) VALUES (?, ?, ?, ?, ?)');
        $sql1->bind_param('sssis', $TreballNombr, $TreballEmail, $TreballTelef, $TreballIDDep, $ClaveEncryp);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido crear el trabajador correctamente.";
        } else {
            $Verificacion = "Se ha creado el trabajador correctamente.";
        }
    } elseif (isset($_POST['ElimTrabaj'])) {
        $sql1 = $conn->prepare('DELETE FROM treballadors WHERE IDTreballador = ?');
        $sql1->bind_param('i', $UserElimIDTrabaj);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido eliminar el trabajador correctamente.";
        } else {
            $Verificacion = "Se ha eliminado el trabajador correctamente.";
        }
    }

    $conn->close();

    header("Location: InfoPersonalAdm.php?cosa=$email&pepe=$Verificacion");
?>
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

    $UserElimIDClient = $mysqli->escape_string($_POST['InputIdentCli']);
    $UserElimIDTrabaj = $mysqli->escape_string($_POST['InputElimTrabaj']);
    $TreballNombr = $mysqli->escape_string($_POST['InputNombrTrabaj']);
    $TreballEmail = $mysqli->escape_string($_POST['InputEmailTrabaj']);
    $TreballTelef = $mysqli->escape_string($_POST['InputTelefTrabaj']);
    $TreballIDDep = $mysqli->escape_string($_POST['InputIDDepTrabaj']);
    $TreballClave = $mysqli->escape_string($_POST['InputClaveTrabaj']);

    $ClaveEncryp = password_hash($TreballClave, PASSWORD_DEFAULT);

    if (isset($_POST['ElimClient'])) {
        $sql1 = $conn->prepare('DELETE FROM clients WHERE IDClient = ?');
        $sql1 = ->bind_param('i', $UserElimIDClient);
        $sql1->execute();
    } elseif (isset($_POST['CrearTrabaj'])) {
        $sql2 = $conn->prepare('INSERT INTO treballadors (NomTreballador, Email, Telefon, IDDepartament, Clave) VALUES (?, ?, ?, ?, ?)');
        $sql2 = ->bind_param('sssis', $TreballNombr, $TreballEmail, $TreballTelef, $TreballIDDep, $ClaveEncryp);
        $sql2->execute();
    } elseif (isset($_POST['ElimTrabaj'])) {
        $sql3 = $conn->prepare('DELETE FROM treballadors WHERE IDTreballador = ?');
        $sql3 = ->bind_param('i', $UserElimIDTrabaj);
        $sql3->execute();
    }

    $conn->close();

    header("Location: InfoPersonalAdm.php?cosa=$email");
?>
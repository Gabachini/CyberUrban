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

    $UserElimIDClient = isset($_POST['InputIdentCli']) ? $_POST['InputIdentCli'] : '';
    $UserElimIDTrabaj = isset($_POST['InputElimTrabaj']) ? $_POST['InputElimTrabaj'] : '';
    $TreballNombr = isset($_POST['InputNombrTrabaj']) ? $_POST['InputNombrTrabaj'] : '';
    $TreballEmail = isset($_POST['InputEmailTrabaj']) ? $_POST['InputEmailTrabaj'] : '';
    $TreballTelef = isset($_POST['InputTelefTrabaj']) ? $_POST['InputTelefTrabaj'] : '';
    $TreballIDDep = isset($_POST['InputIDDepTrabaj']) ? $_POST['InputIDDepTrabaj'] : '';
    $TreballClave = isset($_POST['InputClaveTrabaj']) ? $_POST['InputClaveTrabaj'] : '';

    $ClaveEncryp = password_hash($TreballClave, PASSWORD_DEFAULT);

    if (isset($_POST['ElimClient'])) {
        $sql1 = "DELETE FROM clients WHERE IDClient = $UserElimIDClient";
        $conn->query($sql1);
    } elseif (isset($_POST['CrearTrabaj'])) {
        $sql2 = "INSERT INTO treballadors (NomTreballador, Email, Telefon, IDDepartament, Clave) VALUES ('$TreballNombr', '$TreballEmail', '$TreballTelef', $TreballIDDep, '$ClaveEncryp')";
        echo "$sql2";
        $conn->query($sql2);
    } elseif (isset($_POST['ElimTrabaj'])) {
        $sql3 = "DELETE FROM treballadors WHERE IDTreballador = $UserElimIDTrabaj";
        $conn->query($sql3);
    }

    $conn->close();

    header("Location: InfoPersonalAdm.php?cosa=$email");
?>
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

    $ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
    $result = mysqli_query($conn,$ObtenerID);
    $IDClient = mysqli_fetch_array($result);

    $IdentProg1 = $conn->escape_string($_POST['InputIdenti1']);

    $stmt1 = $conn->prepare('SELECT COUNT(*) FROM programes WHERE IDPrograma = ?');
    $stmt1->bind_param('i', $IdentProg1);
    $stmt1->execute();
    $stmt1->bind_result($count1);
    $stmt1->fetch();
    $stmt1->close();

    if (isset($_POST['ButtonServi1'])) {
        if ($count1 == 0) {
            $Verificacion = "El programa especificado no existe.";
        } else {
            $sql1 = $conn->prepare('INSERT INTO adquireixprog (IDPrograma, IDClient) VALUES (?, ?)');
            $sql1->bind_param('ii', $IdentProg1, $IDClient[0]);
            $sql1->execute();
            if ($sql1->affected_rows === 0) {
                $Verificacion = "No se ha podido contratar el programa correctamente.";
            } else {
                $Verificacion = "Se ha hecho contratado el programa correctamente.";
            }
        }
    }
    $conn->close();

    header("Location: InfoProgrCl.php?cosa=$email&pepe=$Verificacion");
?>
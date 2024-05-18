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

    $IdentServ1 = $conn->escape_string($_POST['InputIdenti1']);
    $IdentServ2 = $conn->escape_string($_POST['InputIdenti2']);

    $stmt1 = $conn->prepare('SELECT COUNT(*) FROM serveis WHERE IDServei = ?');
    $stmt1->bind_param('i', $IdentServ1);
    $stmt1->execute();
    $stmt1->bind_result($count1);
    $stmt1->fetch();
    $stmt1->close();

    if (isset($_POST['ButtonServi1'])) {
        if ($count1 == 0) {
            $Verificacion = "El servicio especificado no existe.";
        } else {
            $sql1 = $conn->prepare('INSERT INTO adquireixserv (IDServei, IDClient) VALUES (?, ?)');
            $sql1->bind_param('ii', $IdentServ1, $IDClient[0]);
            $sql1->execute();
            if ($sql1->affected_rows === 0) {
                $Verificacion = "No se ha podido contratar el servicio.";
            } else {
                $Verificacion = "Se ha contratado el servico correctamente.";
            }
        }
    } elseif (isset($_POST['ButtonServi2'])) {
        $sql1 = $conn->prepare('DELETE FROM adquireixserv WHERE IDServei = ? AND IDClient = ?');
        $sql1->bind_param('ii', $IdentServ2, $IDClient[0]);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido descontratar el servicio.";
        } else {
            $Verificacion = "Se ha descontratado correctamente el servicio.";
        }
    }
    $conn->close();

    header("Location: InfoServiCl.php?cosa=$email&pepe=$Verificacion");
?>
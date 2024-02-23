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
 
    $NomServ = $conn->escape_string($_POST['InputNomServ']); isset($_POST['InputNomServ']) ? $_POST['InputNomServ'] : '';
    $DesServ = $conn->escape_string($_POST['InputDescServ']); isset($_POST['InputDescServ']) ? $_POST['InputDescServ'] : '';
    $PreServ = $conn->escape_string($_POST['InputPreServ']); isset($_POST['InputPreServ']) ? $_POST['InputPreServ'] : '';
    $ElimServ = $conn->escape_string($_POST['InputIdentServ']); isset($_POST['InputIdentServ']) ? $_POST['InputIdentServ'] : '';
    $NomServ2 = $conn->escape_string($_POST['InputNomServ2']); isset($_POST['InputNomServ2']) ? $_POST['InputNomServ2'] : '';
    $DesServ2 = $conn->escape_string($_POST['InputDescServ2']); isset($_POST['InputDescServ2']) ? $_POST['InputDescServ2'] : '';
    $PreServ2 = $conn->escape_string($_POST['InputPreServ2']); isset($_POST['InputPreServ2']) ? $_POST['InputPreServ2'] : '';
    $IdenServ2 = $conn->escape_string($_POST['InputIdentServ2']); isset($_POST['InputIdentServ2']) ? $_POST['InputIdentServ2'] : '';

    if (isset($_POST['ButtonServi1'])) {
        $sql1 = $conn->prepare('INSERT INTO serveis (NomServei, Descripcio, Preu) VALUES (?, ?, ?)');
        $sql1->bind_param('ssd', $NomServ, $DesServ, $PreServ);
        $sql1->execute();

        $sql2 = "SELECT IDServei FROM serveis WHERE NomServei = '$NomServ' AND Descripcio = '$DesServ' AND Preu = '$PreServ'";
        $result = mysqli_query($conn,$sql2);
		$IDServei = mysqli_fetch_array($result);

        $sql3 = $conn->prepare('INSERT INTO gestionatserv (IDServei, IDDepartament) VALUES (?, 7)');
        $sql3->bind_param('i', $IDServei[0]);
        $sql3->execute();
    } elseif (isset($_POST['ButtonServi2'])) {
        $sql1 = "DELETE FROM adquireixserv WHERE IDServei = $ElimServ";
        $sql2 = "DELETE FROM gestionatserv WHERE IDServei = $ElimServ";
        $sql3 = "DELETE FROM serveis WHERE IDServei = $ElimServ";
        $conn->query($sql1);
        $conn->query($sql2);
        $conn->query($sql3);

        $sql4 = $conn->prepare('DELETE FROM adquireixserv WHERE IDServei = ?');
        $sql4->bind_param('i', $ElimServ);
        $sql4->execute();

        $sql5 = $conn->prepare('DELETE FROM gestionatserv WHERE IDServei = ?');
        $sql5->bind_param('i', $ElimServ);
        $sql5->execute();

        $sql6 = $conn->prepare('DELETE FROM serveis WHERE IDServei = ?');
        $sql6->bind_param('i', $ElimServ);
        $sql6->execute();
    } elseif (isset($_POST['ButtonServi3'])) {
        if (!empty($NomServ2)) {
            $sql7 = $conn->prepare('UPDATE serveis SET NomServei = ? WHERE IDServei = ?');
            $sql7->bind_param('si', $NomServ2, $IdenServ2);
            $sql7->execute();
        }
    
        if (!empty($DesServ2)) {
            $sql7 = $conn->prepare('UPDATE serveis SET Descripcio = ? WHERE IDServei = ?');
            $sql7->bind_param('si', $DesServ2, $IdenServ2);
            $sql7->execute();
        }
    
        if (!empty($PreServ2)) {
            $sql7 = $conn->prepare('UPDATE serveis SET Preu = ? WHERE IDServei = ?');
            $sql7->bind_param('di', $PreServ2, $IdenServ2);
            $sql7->execute();
        }
    }
    $conn->close();
    
    header("Location: InfoServiAdm.php?cosa=$email");
?>
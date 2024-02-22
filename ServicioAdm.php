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
 
    $NomServ = isset($_POST['InputNomServ']) ? $_POST['InputNomServ'] : '';
    $DesServ = isset($_POST['InputDescServ']) ? $_POST['InputDescServ'] : '';
    $PreServ = isset($_POST['InputPreServ']) ? $_POST['InputPreServ'] : '';
    $ElimServ = isset($_POST['InputIdentServ']) ? $_POST['InputIdentServ'] : '';
    $NomServ2 = isset($_POST['InputNomServ2']) ? $_POST['InputNomServ2'] : '';
    $DesServ2 = isset($_POST['InputDescServ2']) ? $_POST['InputDescServ2'] : '';
    $PreServ2 = isset($_POST['InputPreServ2']) ? $_POST['InputPreServ2'] : '';
    $IdenServ2 = isset($_POST['InputIdentServ2']) ? $_POST['InputIdentServ2'] : '';

    if (isset($_POST['ButtonServi1'])) {
        $sql1 = "INSERT INTO serveis (NomServei, Descripcio, Preu) VALUES ('$NomServ', '$DesServ', '$PreServ')";
        $conn->query($sql1);
        $sql2 = "SELECT IDServei FROM serveis WHERE NomServei = '$NomServ' AND Descripcio = '$DesServ' AND Preu = '$PreServ'";
        $result = mysqli_query($conn,$sql2);
		$IDServei = mysqli_fetch_array($result);
        $sql3 = "INSERT INTO gestionatserv (IDServei, IDDepartament) VALUES ($IDServei[0], 7)";
        $conn->query($sql3);
    } elseif (isset($_POST['ButtonServi2'])) {
        $sql1 = "DELETE FROM adquireixserv WHERE IDServei = $ElimServ";
        $sql2 = "DELETE FROM gestionatserv WHERE IDServei = $ElimServ";
        $sql3 = "DELETE FROM serveis WHERE IDServei = $ElimServ";
        $conn->query($sql1);
        $conn->query($sql2);
        $conn->query($sql3);
    } elseif (isset($_POST['ButtonServi3'])) {
        if (!empty($NomServ2)) {
            $ssql1 = "UPDATE serveis SET NomServei ='$NomServ2' WHERE IDServei = $IdenServ2";
            $conn->query($ssql1);
        }
    
        if (!empty($DesServ2)) {
            $ssql3 = "UPDATE serveis SET Descripcio = '$DesServ2' WHERE IDServei = $IdenServ2";
            $conn->query($ssql3);
        }
    
        if (!empty($PreServ2)) {
            $ssql5 = "UPDATE serveis SET Preu = '$PreServ2' WHERE IDServei = $IdenServ2";
            $conn->query($ssql5);
        }
    }
    $conn->close();
    
    header("Location: InfoServiAdm.php?cosa=$email");
?>
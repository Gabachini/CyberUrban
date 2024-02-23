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
 
    $NomProg = $conn->escape_string($_POST['InputNomProg']);
    $DesProg = $conn->escape_string($_POST['InputDescProg']);
    $PreProg = $conn->escape_string($_POST['InputPreProg']);
    $ElimProg = $conn->escape_string($_POST['InputIdentProg']);
    $NomProg2 = $conn->escape_string($_POST['InputNomProg2']);
    $DesProg2 = $conn->escape_string($_POST['InputDescProg2']);
    $PreProg2 = $conn->escape_string($_POST['InputPreProg2']);
    $IdenProg2 = $conn->escape_string($_POST['InputIdentProg2']);

    if (isset($_POST['ButtonProg1'])) {
        $sql1 = $conn->prepare('INSERT INTO programes (NomPrograma, Descripcio, Preu) VALUES (?, ?, ?)');
        $sql1->bind_param('ssd', $NomProg, $DesProg, $PreProg);
        $sql1->execute();

        $sql2 = "SELECT IDPrograma FROM programes WHERE NomPrograma = '$NomProg' AND Descripcio = '$DesProg' AND Preu = '$PreProg'";
        $result = mysqli_query($conn,$sql2);
		$IDPrograma = mysqli_fetch_array($result);

        $sql2 = $conn->prepare('INSERT INTO gestionatprog (IDPrograma, IDDepartament) VALUES (?, 8)');
        $sql2->bind_param('i', $IDPrograma[0]);
        $sql2->execute();
    } elseif (isset($_POST['ButtonProg2'])) {
        $sql3 = $conn->prepare('DELETE FROM adquireixprog WHERE IDPrograma = ?');
        $sql3->bind_param('i', $ElimProg);
        $sql3->execute();

        $sql4 = $conn->prepare('DELETE FROM gestionatprog WHERE IDPrograma = ?');
        $sql4->bind_param('i', $ElimProg);
        $sql4->execute();

        $sql5 = $conn->prepare('DELETE FROM programes WHERE IDPrograma = ?');
        $sql5->bind_param('i', $ElimProg);
        $sql5->execute();
    } elseif (isset($_POST['ButtonProg3'])) {
        if (!empty($NomProg2)) {
            $sql6 = $conn->prepare('UPDATE programes SET NomPrograma = ? WHERE IDPrograma = ?');
            $sql6->bind_param('si', $NomProg2, $IdenProg2);
            $sql6->execute();
        }
    
        if (!empty($DesProg2)) {
            $sql6 = $conn->prepare('UPDATE programes SET Descripcio = ? WHERE IDPrograma = ?');
            $sql6->bind_param('si', $DesProg2, $IdenProg2);
            $sql6->execute();
        }
    
        if (!empty($PreProg2)) {
            $sql7 = $conn->prepare('UPDATE programes SET Preu = ? WHERE IDPrograma = ?');
            $sql7->bind_param('si', $PreProg2, $IdenProg2);
            $sql7->execute();
        }
    }
    $conn->close();
    
    header("Location: InfoProgrAdm.php?cosa=$email");
?>


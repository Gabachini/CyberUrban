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
 
    $NomProg = isset($_POST['InputNomProg']) ? $_POST['InputNomProg'] : '';
    $DesProg = isset($_POST['InputDescProg']) ? $_POST['InputDescProg'] : '';
    $PreProg = isset($_POST['InputPreProg']) ? $_POST['InputPreProg'] : '';
    $ElimProg = isset($_POST['InputIdentProg']) ? $_POST['InputIdentProg'] : '';
    $NomProg2 = isset($_POST['InputNomProg2']) ? $_POST['InputNomProg2'] : '';
    $DesProg2 = isset($_POST['InputDescProg2']) ? $_POST['InputDescProg2'] : '';
    $PreProg2 = isset($_POST['InputPreProg2']) ? $_POST['InputPreProg2'] : '';
    $IdenProg2 = isset($_POST['InputIdentProg2']) ? $_POST['InputIdentProg2'] : '';

    if (isset($_POST['ButtonProg1'])) {
        $sql1 = "INSERT INTO programes (NomPrograma, Descripcio, Preu) VALUES ('$NomProg', '$DesProg', '$PreProg')";
        $conn->query($sql1);
        $sql2 = "SELECT IDPrograma FROM programes WHERE NomPrograma = '$NomProg' AND Descripcio = '$DesProg' AND Preu = '$PreProg'";
        $result = mysqli_query($conn,$sql2);
		$IDPrograma = mysqli_fetch_array($result);
        $sql3 = "INSERT INTO gestionatprog (IDPrograma, IDDepartament) VALUES ($IDPrograma[0], 8)";
        $conn->query($sql3);
    } elseif (isset($_POST['ButtonProg2'])) {
        $sql1 = "DELETE FROM adquireixprog WHERE IDPrograma = $ElimProg";
        $sql2 = "DELETE FROM gestionatprog WHERE IDPrograma = $ElimProg";
        $sql3 = "DELETE FROM programes WHERE IDPrograma = $ElimProg";
        $conn->query($sql1);
        $conn->query($sql2);
        $conn->query($sql3);
    } elseif (isset($_POST['ButtonProg3'])) {
        if (!empty($NomProg2)) {
            $ssql1 = "UPDATE programes SET NomPrograma ='$NomProg2' WHERE IDPrograma = $IdenProg2";
            $conn->query($ssql1);
        }
    
        if (!empty($DesProg2)) {
            $ssql3 = "UPDATE programes SET Descripcio = '$DesProg2' WHERE IDPrograma = $IdenProg2";
            $conn->query($ssql3);
        }
    
        if (!empty($PreProg2)) {
            $ssql5 = "UPDATE programes SET Preu = '$PreProg2' WHERE IDPrograma = $IdenProg2";
            $conn->query($ssql5);
        }
    }
    $conn->close();
    
    header("Location: InfoProgrAdm.php?cosa=$email");
?>


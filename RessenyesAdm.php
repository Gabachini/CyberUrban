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
 
    $IdentRess = isset($_POST['InputIdentRess']) ? $_POST['InputIdentRess'] : '';

    if (isset($_POST['ElimRess'])) {
        $sql1 = "DELETE FROM ressenyes WHERE IDRessenyes = $IdentRess";
        $conn->query($sql1);
    }

    $conn->close();
    
    header("Location: InfoResenyesAdm.php?cosa=$email");
?>
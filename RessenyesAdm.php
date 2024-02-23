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
 
    $IdentRess = $conn->escape_string($_POST['InputIdentRess']);

    if (isset($_POST['ElimRess'])) {
        $sql1 = $conn->prepare('DELETE FROM ressenyes WHERE IDRessenyes = ?');
        $sql1->bind_param('i', $IdentRess);
        $sql1->execute();
    }

    $conn->close();
    
    header("Location: InfoResenyesAdm.php?cosa=$email");
?>
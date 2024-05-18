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
 
    $ComentRess1 = $conn->escape_string($_POST['InputComentRess1']);
    $IdentRess1 = $conn->escape_string($_POST['InputIdentRess1']);
    $ComentRess2 = $conn->escape_string($_POST['InputComentRess2']);
    $IdentRess2 = $conn->escape_string($_POST['InputIdentRess2']);

    if (isset($_POST['ElimRess1'])) {
        $sql1 = $conn->prepare('INSERT INTO ressenyes (Comentari, IDClient) VALUES (?, 1)');
        $sql1->bind_param('s', $ComentRess1);
        $sql1->execute();
    } else if (isset($_POST['ElimRess2'])) {
        $sql1 = $conn->prepare('UPDATE ressenyes SET Comentari = ? WHERE IDRessenyes = ?');
        $sql1->bind_param('ss', $ComentRess2, $IdentRess1);
        $sql1->execute();
    } else if (isset($_POST['ElimRess3'])) {
        $sql1 = $conn->prepare('DELETE FROM ressenyes WHERE IDRessenyes = ?');
        $sql1->bind_param('i', $IdentRess2);
        $sql1->execute();
    }

    $conn->close();
    
    header("Location: InfoResenyesAdm.php?cosa=$email");
?>
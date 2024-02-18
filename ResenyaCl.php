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

    $ObtenerID = "SELECT IDClient FROM clients WHERE Email = '$email'";
    $result = mysqli_query($conn,$ObtenerID);
    $IDClient = mysqli_fetch_array($result);

    $IdentResseny1 = isset($_POST['IdentResseny1']) ? $_POST['IdentResseny1'] : '';
    $IdentResseny2 = isset($_POST['IdentResseny2']) ? $_POST['IdentResseny2'] : '';

    echo "$IdentResseny1, $IdentResseny2, $IDClient[0]";

    if (isset($_POST['ButtonResen1'])) {
        $sql1 = "INSERT INTO ressenyes (Comentari, IDClient) VALUES ('$IdentResseny1' ,$IDClient[0])";
        $conn->query($sql1);
    } elseif (isset($_POST['ButtonResen2'])) {
        $sql2 = "DELETE FROM ressenyes WHERE IDRessenyes = $IdentResseny2 AND IDClient = $IDClient[0]";
        $conn->query($sql2);
    }
    $conn->close();

    header("Location: InfoResenyesCl.php?cosa=$email");
?>
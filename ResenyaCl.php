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

    $IdentResseny1 = $conn->escape_string($_POST['IdentResseny1']);
    $IdentResseny2 = $conn->escape_string($_POST['IdentResseny2']);

    if (isset($_POST['ButtonResen1'])) {
        $sql1 = $conn->prepare('INSERT INTO ressenyes (Comentari, IDClient) VALUES (?, ?)');
        $sql1->bind_param('si', $IdentResseny1, $IDClient[0]);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido crear la reseña correctamente.";
        } else {
            $Verificacion = "Se ha creado la reseña correctamente correctamente.";
        }
    } elseif (isset($_POST['ButtonResen2'])) {
        $sql1 = $conn->prepare('DELETE FROM ressenyes WHERE IDRessenyes = ? AND IDClient = ?');
        $sql1->bind_param('si', $IdentResseny2, $IDClient[0]);
        $sql1->execute();
        if ($sql1->affected_rows === 0) {
            $Verificacion = "No se ha podido eliminar la reseña correctamente.";
        } else {
            $Verificacion = "Se ha hecho eliminar la reseña correctamente.";
        }
    }
    $conn->close();

    header("Location: InfoResenyesCl.php?cosa=$email&pepe=$Verificacion");
?>
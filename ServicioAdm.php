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

    // Obtener información del administrador
    $ObtenerIDAdmin = "SELECT user FROM administradors WHERE user = '$User'";
    $resultAdmin = mysqli_query($conn, $ObtenerIDAdmin);

        $IdentServ1 = isset($_POST['InputIdenti1']) ? $_POST['InputIdenti1'] : '';
        $IdentServ2 = isset($_POST['InputIdenti2']) ? $_POST['InputIdenti2'] : '';
        $IdentServEdit = isset($_POST['InputIdentiEdit']) ? $_POST['InputIdentiEdit'] : '';

        if (isset($_POST['ButtonServi1'])) {
            // Lógica para agregar un servicio
            $sql1 = "INSERT INTO adquireixserv (NomServei, Descripcio, Preu) VALUES ('dwadaw', 'awdawdawd', '78')";
            $conn->query($sql1);
        } elseif (isset($_POST['ButtonServi2'])) {
            // Lógica para eliminar un servicio
            $sql2 = "DELETE FROM adquireixserv WHERE IDServei = $IdentServ2";
            $conn->query($sql2);
        } elseif (isset($_POST['ButtonServiEdit'])) {
            // Lógica para editar un servicio
            $sql3 = "UPDATE adquireixserv SET IDServei = $IdentServEdit WHERE IDAdmin = $admin_id";
            $conn->query($sql3);
        }
        $conn->close();
    
    header("Location: InfoServiAdm.php?admin_id=$admin_id");
?>


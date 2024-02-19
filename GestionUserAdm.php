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

    $sql = "SELECT IDReserva ,DataReserva FROM reserves where IDClient = (SELECT IDClient FROM clients WHERE IDClient = $IDClient[0])";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<table border='1' id='tabla' border='1'; width='520'>
                <tr>
                    <th>Identificador</th>
                    <td>" . $row["IDReserva"] . "</td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td>" . $row["DataReserva"] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p id='CentrarTextoTabla'>No hay reservas encontrados.</p>";
    }
    $conn->close();
?>
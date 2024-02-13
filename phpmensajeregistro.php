<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';

    $sql = "SELECT * FROM clients WHERE NumTelefon = '$telefono' OR Email = '$correo'";
    $result = $conn->query($sql);

    header('Content-Type: application/json');

    if ($result->num_rows > 0) {
        echo json_encode(array('exists' => true));
    } else {
        echo json_encode(array('noexists' => false));
    }
?>
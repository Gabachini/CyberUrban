<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $nombre = $conn->escape_string($_POST['nombre']);
    $direccion = $conn->escape_string($_POST['direccion']);

    $sql = $conn->prepare('SELECT * FROM clients WHERE NumTelefon = ? OR Email = ?');
    $sql->bind_param('ss', $telefono, $correo);
    $sql->execute();
    $result = $sql->get_result();

    header('Content-Type: application/json');

    if ($result->num_rows > 0) {
        echo json_encode(array('exists' => true));
    } else {
        echo json_encode(array('noexists' => false));
    }
?>
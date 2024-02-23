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
    $telefono = $conn->escape_string($_POST['numtel']);
    $correo = $conn->escape_string($_POST['email']);
    $clave = $conn->escape_string($_POST['clave1']);
    $clave2 = $conn->escape_string($_POST['clave2']); 

    $sql = $conn->prepare('SELECT * FROM clients WHERE NumTelefon = ? OR Email = ?');
    $sql->bind_param('ss', $telefono, $correo);
    $sql->execute();
    $result = $sql->get_result();

    if ($clave === $clave2) {
        if ($result->num_rows === 0) {
            $ClaveEncryp = password_hash($clave, PASSWORD_DEFAULT);
            try {
                $sql2 = $conn->prepare('INSERT INTO clients (Nom, Direccio, NumTelefon, Email, clave) VALUES (?, ?, ?, ?, ?)');
                $sql2->bind_param('sssss', $nombre, $direccion, $telefono, $correo, $ClaveEncryp);
                $sql2->execute();
                header('Location: index.html');
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            header('Location: index.html');
        }
    }

    $conn->close();

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>
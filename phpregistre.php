<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    extract($_POST);

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    //$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    //$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    //$telefono = isset($_POST["numtel"]) ? $_POST['numtel'] : '';
    //$correo = isset($_POST['email']) ? $_POST['email'] : '';
    //$clave = isset($_POST['clave1']) ? $_POST['clave1'] : '';
    //$clave2 = isset($_POST['clave2']) ? $_POST['clave2'] : '';

    $sql = "SELECT * FROM clients WHERE NumTelefon = '$numtel' OR Email = '$email'";
    $result = $conn->query($sql);

    if ($clave1 === $clave2) {
        if ($result->num_rows === 0) {
            $ClaveEncryp = password_hash($clave1, PASSWORD_DEFAULT);
            try {
                $sql3 = "INSERT INTO clients (Nom, Direccio, NumTelefon, Email, clave) VALUES
                ('$nombre', '$direccion', '$numtel', '$email', '$ClaveEncryp')";
                $conn->query($sql3);
                echo "Hola1";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            header('Location: index.html');
            die();
        }
    }

    $conn->close();

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>
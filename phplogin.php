<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = isset($_POST['EmailLogin']) ? $_POST['EmailLogin'] : '';
    $password = isset($_POST['PasswordLogin']) ? $_POST['PasswordLogin'] : '';

    $sql = "SELECT * FROM clients WHERE Email = '$email'";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM clients WHERE Email = '$email'";
    $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM treballadors WHERE Email = '$email'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM administradors WHERE user = '$email'";
    $result3 = $conn->query($sql3);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['clave'])) {
            if ($result1->num_rows > 0) {
                header("Location: InfoPersonalCl.php?cosa=$email");
            } elseif ($result2->num_rows > 0) {
                header("Location: InfoPersonalCl.php?cosa=$email");
            } else {
                header("Location: InfoProgrAdm.php?cosa=$email");
            }
        } else {
            echo 'La contraseña no es válida.';
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>
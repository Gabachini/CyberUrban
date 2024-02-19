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

    $sql1 = "SELECT * FROM clients WHERE Email = '$email'";
    $result1 = $conn->query($sql1);
    $sql2 = "SELECT * FROM treballadors WHERE Email = '$email'";
    $result2 = $conn->query($sql2);
    $sql3 = "SELECT * FROM administradors WHERE user = '$email'";
    $result3 = $conn->query($sql3);

    if ($result1->num_rows > 0 || $result2->num_rows > 0 || $result3->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $row2 = $result2->fetch_assoc();
        $row3 = $result3->fetch_assoc();

        if ($result1->num_rows > 0) {
            if (password_verify($password, $row1['Clave'])) {
                header("Location: InfoPersonalCl.php?cosa=$email");
            } else {
                echo 'La contraseña no es válida.';
            }
        } elseif ($result2->num_rows > 0) {
            if (password_verify($password, $row2['Clave'])) {
                header("Location: InfoPersonalTr.php?cosa=$email");
            } else {
                echo 'La contraseña no es válida.';
            }
        } elseif ($result3->num_rows > 0) {
            if (password_verify($password, $row3['Clave'])) {
                header("Location: InfoPersonalAdm.php?cosa=$email");
            } else {
                echo 'La contraseña no es válida.';
            }
        }
    } else {
        echo "0 results";
    }

    $conn->close();
?>
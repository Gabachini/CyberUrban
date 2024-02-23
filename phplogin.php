<?php
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'cyberurban';

    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->escape_string($_POST['EmailLogin']);
    $password = $conn->escape_string($_POST['PasswordLogin']);

    $sql1 = $conn->prepare('SELECT * FROM clients WHERE Email = ?');
    $sql1->bind_param('s', $email);
    $sql1->execute();
    $result1 = $sql1->get_result();

    $sql2 = $conn->prepare('SELECT * FROM treballadors WHERE Email = ?');
    $sql2->bind_param('s', $email);
    $sql2->execute();
    $result2 = $sql2->get_result();

    $sql3 = $conn->prepare('SELECT * FROM administradors WHERE user = ?');
    $sql3->bind_param('s', $email);
    $sql3->execute();
    $result3 = $sql3->get_result();


    if ($result1->num_rows > 0 || $result2->num_rows > 0 || $result3->num_rows > 0) {
        if (!empty($result1)) {
            $row1 = $result1->fetch_assoc();
        }
        if (!empty($result2)) {
            $row2 = $result2->fetch_assoc();
        }
        if (!empty($result3)) {
            $row3 = $result3->fetch_assoc();
        }

        if ($result1->num_rows > 0) {
            if (password_verify($password, $row1['Clave'])) {
                header("Location: InfoPersonalCl.php?cosa=$email");
            } else {
                header("Location: index.html");
            }
        } elseif ($result2->num_rows > 0) {
            if (password_verify($password, $row2['Clave'])) {
                header("Location: InfoPersonalTr.php?cosa=$email");
            } else {
                header("Location: index.html");
            }
        } elseif ($result3->num_rows > 0) {
            if (password_verify($password, $row3['Clave'])) {
                header("Location: InfoPersonalAdm.php?cosa=$email");
            } else {
                header("Location: index.html");
            }
        }
    } else {
        header("Location: index.html");
    }

    $conn->close();
?>
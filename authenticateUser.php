<?php

include('admin/db_connect.php');

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $verify = $conn->query("SELECT * FROM users where username = '$username' ");
    if ($verify->num_rows > 0) {
        $data = $verify->fetch_array();
        if (password_verify($password, $data['password'])) {
            session_start();
            foreach ($data as $k => $v) {
                if (!is_numeric($k))
                    $_SESSION['login_' . $k] = $v;
            }
            $_SESSION['login_id'] = $data['id'];
            echo '<script>alert("Login successfully")</script>';    
            echo '<script>window.location = "index.php"</script>';
        }
    }

    echo '<script>alert("Username or password is incorrect.")</script>';
    echo '<script>window.location = "index.php?page=signin"</script>';
}

?>
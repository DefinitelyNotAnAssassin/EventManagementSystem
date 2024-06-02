<?php

include('admin/db_connect.php');

if (isset($_POST['username'])) {
    $name = $_POST['fullName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    // verify first if theres no existing user with that username 
    $check = $conn->query("SELECT * FROM users where username = '$username' ")->num_rows;
    if ($check > 0) {
        echo "<script>alert('Username already exist')</script>";
        echo "<script>window.location = 'signup.php'</script>";
        exit;
    }
    $conn->query("INSERT INTO users (name, username, password, type) VALUES ('$name', '$username', '$password', '$type')");

    echo "<script>alert('User added successfully!')</script>";
    echo "<script>window.location = 'index.php'</script>";
}

?>
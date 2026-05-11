<?php
session_start();
include("../config/db.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    $row = mysqli_fetch_assoc($query);

    if($row && password_verify($password, $row['password'])){
        $_SESSION['admin'] = $row['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password');window.location='login.php'</script>";
    }
}
?>
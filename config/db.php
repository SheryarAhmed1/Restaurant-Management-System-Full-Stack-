<?php
$conn = mysqli_connect("localhost", "root", "", "food_delivery");
if ($conn) {
    // echo "Connection Successful!";
} else {
    echo "DB Connection Failed: " . mysqli_connect_error();
}
?>
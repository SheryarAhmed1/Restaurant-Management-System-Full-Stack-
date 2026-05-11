<?php
include("../auth_check.php");     
include("../../config/db.php");    
$id = $_GET['id'];

$getImageQuery = "SELECT image FROM foods WHERE id = $id";
$result        = mysqli_query($conn, $getImageQuery);
$food          = mysqli_fetch_assoc($result);

if (!empty($food['image'])) {
    $imagePath = "../uploads/" . $food['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}
$deleteQuery = "DELETE FROM foods WHERE id = $id";
if (mysqli_query($conn, $deleteQuery)) {
    header("Location: view_food.php");
    exit();
}
?>

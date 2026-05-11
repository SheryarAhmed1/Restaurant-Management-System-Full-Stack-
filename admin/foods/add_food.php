<?php
include("../auth_check.php");    
include("../../config/db.php");    

if (isset($_POST['add'])) {

    /* GET FORM DATA */
    $food_name   = $_POST['name'];
    $food_price  = $_POST['price'];
    $food_status = $_POST['status']; 

    $image_name = $_FILES['image']['name'];
    $image_tmp  = $_FILES['image']['tmp_name'];

    $upload_path = "../uploads/" . $image_name;

    move_uploaded_file($image_tmp, $upload_path);
    mysqli_query(
        $conn,
        "INSERT INTO foods (name, price, image, status)
         VALUES ('$food_name', '$food_price', '$image_name', '$food_status')"
    );
    header("Location: view_food.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Food | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color:#c8d2cfff;
            padding-top:50px;
        }
        .add-form-card{
            max-width:500px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="add-form-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">➕ Add New Food</h2>
            <a href="view_food.php" class="btn btn-outline-secondary btn-sm">
                Cancel
            </a>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <!-- FOOD NAME -->
            <div class="mb-3">
                <label class="form-label fw-bold">Food Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    placeholder="Enter food name"
                    required>
            </div>
            <!-- FOOD PRICE -->
            <div class="mb-3">
                <label class="form-label fw-bold">Price (Rs)</label>
                <input 
                    type="number" 
                    name="price" 
                    class="form-control" 
                    placeholder="Enter price"
                    required>
            </div>
            <!-- FOOD IMAGE -->
            <div class="mb-3">
                <label class="form-label fw-bold">Food Image</label>
                <input 
                    type="file" 
                    name="image" 
                    class="form-control" 
                    required>
            </div>
            <div class="d-grid">
                <button type="submit" name="add" class="btn btn-success btn-lg">
                    Save Food Item
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
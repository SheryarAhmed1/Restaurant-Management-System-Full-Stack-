<?php
include("../auth_check.php");      
include("../../config/db.php");    

$id = $_GET['id'];

$selectQuery = "SELECT * FROM foods WHERE id = $id";
$result      = mysqli_query($conn, $selectQuery);
$food        = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name   = $_POST['name'];
    $price  = $_POST['price'];
    $status = $_POST['status'];
    if (!empty($_FILES['image']['name'])) {
        // New image uploaded
        $imageName = $_FILES['image']['name'];
        $tmpName   = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmpName, "../uploads/" . $imageName);

    } else {
        $imageName = $food['image'];
    }
    /* UPDATE QUERY */
    $updateQuery = "
        UPDATE foods SET
            name   = '$name',
            price  = '$price',
            image  = '$imageName',
            status = '$status'
        WHERE id = $id
    ";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: view_food.php");
        exit(); 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Food | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color:#c8d2cfff;
            padding-top:50px;
        }
        .form-container{
            max-width:600px;
            margin:auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        .current-img{
            width:120px;
            border-radius:10px;
            border:2px solid #ddd;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">✏️ Edit Food</h2>
            <a href="view_food.php" class="btn btn-secondary btn-sm">
                Back to List
            </a>
        </div>
        <!-- EDIT FORM -->
        <form method="POST" enctype="multipart/form-data">
            <!-- FOOD NAME -->
            <div class="mb-3">
                <label class="form-label fw-bold">Food Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control"
                    value="<?php echo $food['name']; ?>" 
                    required
                >
            </div>
            <!-- PRICE -->
            <div class="mb-3">
                <label class="form-label fw-bold">Price (Rs)</label>
                <input 
                    type="number" 
                    name="price" 
                    class="form-control"
                    value="<?php echo $food['price']; ?>" 
                    required
                >
            </div>
            <!-- IMAGE -->
            <div class="mb-3">
                <label class="form-label fw-bold">Current Image</label><br>
                <img 
                    src="../uploads/<?php echo $food['image']; ?>" 
                    class="current-img"
                    alt="Food Image"
                >
                <input type="file" name="image" class="form-control">
            </div>
            <!-- SUBMIT BUTTON -->
            <div class="d-grid">
                <button name="update" class="btn btn-primary btn-lg">
                    Update Food Details
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
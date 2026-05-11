<?php
include("../auth_check.php");  
include("../../config/db.php"); 
$query  = "SELECT * FROM foods";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Foods | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#c8d2cfff;
            padding-top:50px;
        }
        .table-container{
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
        }
        .food-img{
            width:70px;
            height:70px;
            object-fit:cover;
            border-radius:7px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">🥘 Food List</h2>
            <a href="add_food.php" class="btn btn-primary">
                + Add New Food
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>#<?php echo $row['id']; ?></td>
                        <td>
                            <img 
                                src="../uploads/<?php echo $row['image']; ?>" 
                                class="food-img"
                                alt="Food Image"
                            >
                        </td>
                        <td class="fw-bold">
                            <?php echo $row['name']; ?>
                        </td>
                        <td class="text-success fw-bold">
                            Rs <?php echo $row['price']; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a 
                                    href="edit_food.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <a 
                                    href="delete_food.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="5" class="text-muted text-center">
                            Koi food item nahi mila.
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
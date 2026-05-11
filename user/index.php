<?php
include("../config/db.php");
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Food Corner</title>
<style>
.hero-banner{
    background:
        linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
        url("../admin/uploads/banner1.png");
    background-size: cover;
    background-position: center;
    color: white;
    padding: 100px 0;
}
.card-hover:hover{
    transform: scale(1.03);
    transition: 0.3s ease-in-out;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
body{
    background-color: #c8d2cfff;
}
</style>
</head>
<body>
<div class="hero-banner text-center">
    <div class="container">
        <h1 class="display-3 fw-bold text-warning">
            🍔 Food Corner
        </h1>
        <p class="fs-4">
            Experience the Best Taste in City!
        </p>
        <a href="#menu" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold">
            Order Your Food Now
        </a>

    </div>
</div>
<hr class="container text-muted">
<div class="container mt-5" id="menu">

    <h2 class="text-center mb-5 fw-bold">
        🔥 Our Menu
    </h2>

    <div class="row">
<?php
$foods_query = "SELECT * FROM foods WHERE status='active'";
$foods = mysqli_query($conn, $foods_query);
if (mysqli_num_rows($foods) > 0) {
    while ($food = mysqli_fetch_assoc($foods)) {
?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0 card-hover">
                <!-- FOOD IMAGE -->
                <img 
                    src="../admin/uploads/<?php echo $food['image']; ?>"
                    class="card-img-top"
                    style="height:180px; object-fit:cover;"
                    alt="food"
                >
                <!-- FOOD DETAILS -->
                <div class="card-body text-center">
                    <h5 class="fw-bold">
                        <?php echo $food['name']; ?>
                    </h5>
                    <p class="text-muted fw-bold">
                        Rs <?php echo number_format($food['price']); ?>
                    </p>
                    <!-- ADD TO CART FORM -->
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="id" value="<?php echo $food['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $food['name']; ?>">
                        <input type="hidden" name="price" value="<?php echo $food['price']; ?>">
                        <button name="add" class="btn btn-success w-100 rounded-pill">
                            Add to Cart 🛒
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "
    <div class='col-12 text-center'>
        <p class='alert alert-info'>
            No food items available.
        </p>
    </div>";
}
?>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
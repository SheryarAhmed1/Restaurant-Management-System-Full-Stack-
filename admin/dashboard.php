<?php
include("auth_check.php");
include("header.php");
include("../config/db.php");
?>
<?php
$auto_update_query = "
    UPDATE orders 
    SET status = 'Delivered' 
    WHERE status = 'Preparing'
    AND created_at <= NOW() - INTERVAL 30 MINUTE
";
mysqli_query($conn, $auto_update_query);
/* Total Food Items */
$food_query = "SELECT COUNT(*) AS total_food FROM foods";
$food_result = mysqli_query($conn, $food_query);
$food = mysqli_fetch_assoc($food_result);

/* Total Orders */
$order_query = "SELECT COUNT(*) AS total_orders FROM orders";
$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

/* Preparing Orders Count */
$preparing_query = "
    SELECT COUNT(*) AS total 
    FROM orders 
    WHERE status = 'Preparing'
";
$preparing_result = mysqli_query($conn, $preparing_query);
$preparing = mysqli_fetch_assoc($preparing_result);

/* Delivered Orders Count */
$delivered_query = "
    SELECT COUNT(*) AS total 
    FROM orders 
    WHERE status = 'Delivered'
";
$delivered_result = mysqli_query($conn, $delivered_query);
$delivered = mysqli_fetch_assoc($delivered_result);

$recent_orders_query = "
    SELECT id, customer_name, phone, total, status 
    FROM orders 
    ORDER BY id DESC 
    LIMIT 30
";
$recent_orders = mysqli_query($conn, $recent_orders_query);
?>
<html>
    <head>
        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

</head>
<body>
<div class="container-fluid">
<div class="row">

<div class="col-md-2 sidebar">
    <h4 class="text-center text-white py-3">Admin Panel</h4>
    <a href="dashboard.php">Dashboard</a>
    <a href="foods/view_food.php">Foods</a>
    <a href="view_orders.php">Orders</a>
    <a href="logout.php">Logout</a>
</div>

<div class="col-md-10 p-4">
<h3 class="mb-4">Dashboard Overview</h3>
<div class="row">

<div class="col-md-4 mb-3">
<div class="card shadow">
<div class="card-body">
<h5>Total Food Items <br> <?php echo $food['total_food']; ?></h5>
</div>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="card shadow">
<div class="card-body">
<h5>Total Orders <br> <?php echo $order['total_orders']; ?></h5>
</div>
</div>
</div>

</div>
<div class="row mt-4">

<div class="col-md-6 mb-3">
<div class="card text-center border-primary">
<div class="card-body">
<h6>Preparing</h6>
<span class="badge bg-primary fs-5">
<?php echo $preparing['total']; ?>
</span>
</div>
</div>
</div>

<div class="col-md-6 mb-3">
<div class="card text-center border-success">
<div class="card-body">
<h6>Delivered</h6>
<span class="badge bg-success fs-5">
<?php echo $delivered['total']; ?>
</span>
</div>
</div>
</div>

</div>
<div class="card mt-4 shadow">
<div class="card-header bg-danger text-white">
Recent Orders
</div>

<div class="card-body p-0">
<table class="table table-striped mb-0 text-center">
<thead>
<tr>
<th>ID</th>
<th>Customer</th>
<th>Phone</th>
<th>Total</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php while($order_row = mysqli_fetch_assoc($recent_orders)) { ?>
<tr>
<td>#<?php echo $order_row['id']; ?></td>
<td><?php echo $order_row['customer_name']; ?></td>
<td><?php echo $order_row['phone']; ?></td>
<td>Rs <?php echo $order_row['total']; ?></td>
<td>
<?php
if ($order_row['status'] == "Preparing") {
    echo "<span class='badge bg-primary'>Preparing</span>";
} else {
    echo "<span class='badge bg-success'>Delivered</span>";
}
?>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php include("footer.php"); ?>
<script>
    window.history.pushState(null, "", window.location.href);
    window.onpopstate = function () {
        window.location.href = "login.php";
    };
</script>
</body>
</html>
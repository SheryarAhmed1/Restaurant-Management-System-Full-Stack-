<?php
include("auth_check.php");
include("../config/db.php");

$auto_status_query = "
    UPDATE orders
    SET status = 'Delivered'
    WHERE status = 'Preparing'
    AND created_at IS NOT NULL
    AND created_at <= NOW() - INTERVAL 30 MINUTE
";
mysqli_query($conn, $auto_status_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Orders | Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
<div class="card shadow p-4">
<h3 class="mb-4">📋 Customer Orders</h3>
<table class="table table-bordered text-center align-middle">

<thead class="table-dark">
<tr>
<th>Order ID</th>
<th>Customer Name</th>
<th>Phone Number</th>
<th>Total Amount</th>
<th>Status</th>
</tr>
</thead>
<tbody>

<?php

$order_query = "SELECT * FROM orders ORDER BY id DESC";
$order_result = mysqli_query($conn, $order_query);


while ($order = mysqli_fetch_assoc($order_result)) {
?>
<tr>

<td>#<?php echo $order['id']; ?></td>
<td><?php echo $order['customer_name']; ?></td>
<td><?php echo $order['phone']; ?></td>
<td>Rs <?php echo $order['total']; ?></td>

<td>
<?php

if ($order['status'] == "Preparing") {
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
</body>
</html>
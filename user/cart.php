<?php
session_start();
include("header.php");
/* ADD TO CART */
if(isset($_POST['add'])){
    $id = $_POST['id'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['qty']++;
    } else {
        $_SESSION['cart'][$id] = [
            'name'  => $_POST['name'],
            'price' => $_POST['price'],
            'qty'   => 1
        ];
    }
    header("Location: index.php#menu");
    exit();
}
if (isset($_POST['plus'])) {
    $food_id = $_POST['id'];
    $_SESSION['cart'][$food_id]['qty']++;
}
if (isset($_POST['minus'])) {
    $food_id = $_POST['id'];
    $_SESSION['cart'][$food_id]['qty']--;

    /* Remove Item If Quantity Becomes Zero */
    if ($_SESSION['cart'][$food_id]['qty'] <= 0) {
        unset($_SESSION['cart'][$food_id]);
    }
}
if (isset($_POST['remove'])) {

    $food_id = $_POST['id'];
    unset($_SESSION['cart'][$food_id]);
}
?>
<html>
    <head>
</head>
<body>
<div class="container mt-4">
<h3 class="mb-4 text-center">🛒 Your Cart</h3>
<?php if (!empty($_SESSION['cart'])) { ?>
<table class="table table-bordered text-center align-middle">
<tr>
    <th>Food</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Action</th>
</tr>

<?php
$grand_total = 0;
foreach ($_SESSION['cart'] as $id => $item) {
    $price = (int)$item['price'];
    $qty   = $item['qty'];
    $item_total = $price * $qty;
    $grand_total += $item_total;
?>
<tr>
    <!-- FOOD NAME -->
    <td><?php echo $item['name']; ?></td>
    <!-- FOOD PRICE -->
    <td>Rs <?php echo $price; ?></td>
    <td>
        <form method="POST" style="display:inline">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button name="minus" class="btn btn-danger btn-sm">−</button>
        </form>
        <strong class="mx-2"><?php echo $qty; ?></strong>
        <form method="POST" style="display:inline">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button name="plus" class="btn btn-success btn-sm">+</button>
        </form>
    </td>
    <td>Rs <?php echo $item_total; ?></td>
    <td>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button name="remove" class="btn btn-dark btn-sm">
                Remove
            </button>
        </form>
    </td>
</tr>
<?php } ?>
<tr>
    <th colspan="3">Grand Total</th>
    <th colspan="2">Rs <?php echo $grand_total; ?></th>
</tr>

</table>
<a href="checkout.php" class="btn btn-success btn-lg w-100">
    Proceed to Checkout
</a>
<?php } else { ?>
<p class="alert alert-warning text-center">
    Cart is Empty
</p>
<?php } ?>
</div>
<?php include("footer.php"); ?>
</body>
</html>
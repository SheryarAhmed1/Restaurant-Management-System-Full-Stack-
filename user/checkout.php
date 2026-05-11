<?php
session_start();
include("../config/db.php");  
include("header.php");         
$_SESSION['order_success'] = true;

if (empty($_SESSION['cart'])) {
    echo "<script>
            alert('Cart is empty');
            window.location='index.php';
          </script>";
    exit();
}

$grand_total = 0;

foreach ($_SESSION['cart'] as $cart_item) {

    $item_price = $cart_item['price'];
    $item_qty   = $cart_item['qty'];

    $item_total = $item_price * $item_qty;
    $grand_total += $item_total;
}

if (isset($_POST['order'])) {

    $customer_name    = $_POST['name'];
    $customer_phone   = $_POST['phone'];
    $customer_address = $_POST['address'];

    $insertOrderSQL = "
        INSERT INTO orders
        (customer_name, phone, address, total, payment_method, status)
        VALUES
        (
            '$customer_name',
            '$customer_phone',
            '$customer_address',
            '$grand_total',
            'COD',
            'Preparing'
        )
    ";

    mysqli_query($conn, $insertOrderSQL);
    $order_id = mysqli_insert_id($conn);
    foreach ($_SESSION['cart'] as $cart_item) {

        $food_name = $cart_item['name'];
        $price     = $cart_item['price'];
        $quantity  = $cart_item['qty'];

        $insertItemSQL = "
            INSERT INTO order_items
            (order_id, food_name, price, quantity)
            VALUES
            ('$order_id', '$food_name', '$price', '$quantity')
        ";

        mysqli_query($conn, $insertItemSQL);
    }
    unset($_SESSION['cart']);

    echo "<script>window.location='thankyou.php'</script>";
}
?>
<center>
<div class="container mt-4">
    <h3 class="mb-3">Checkout</h3>
    <form method="POST" class="col-md-6">
        <!-- CUSTOMER NAME -->
        <input
            type="text"
            name="name"
            class="form-control mb-2"
            placeholder="Your Name"
            required
        >
        <!-- PHONE NUMBER -->
        <input
            type="tel"
            name="phone"
            class="form-control mb-2"
            placeholder="Your Phone"
            required
        >
        <!-- ADDRESS -->
        <input
            type="text"
            name="address"
            class="form-control mb-2"
            placeholder="Your Address"
            required
        >
        <!-- TOTAL AMOUNT -->
        <div class="alert alert-info text-center">
            <strong>Total Amount: </strong> Rs <?php echo $grand_total; ?><strong> + 150 Delivery Charges</strong>
        </div>
        <!-- PLACE ORDER BUTTON -->
        <button name="order" class="btn btn-success w-100">
            Place Order (Cash on Delivery)
        </button>
    </form>
</div>
</center>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include("footer.php"); ?>
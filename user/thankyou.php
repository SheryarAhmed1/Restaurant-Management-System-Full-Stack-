<?php
include("header.php");
session_start();
if (!isset($_SESSION['order_success'])) {
    header("Location: index.php");
    exit();
}
unset($_SESSION['order_success']);
?>
<div class="container text-center mt-5">
    <h1 class="text-success" style="font-style:italic">🎉 Thank You!</h1>
    <h4>Your order has been placed Successfully</h4>
    <p class="mt-3">
        Our Team is Preparing Your Food 🍔🍕 <br>
        You will receive your order within 30 minutes.
    </p>
    <div class="mt-4">
        <a href="index.php" class="btn btn-primary me-2">
            Back to Home
        </a>
    </div>

</div>
<?php
include("footer.php");
?>
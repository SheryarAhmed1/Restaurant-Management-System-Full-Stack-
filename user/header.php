<!DOCTYPE html>
<html>
<head>
<title>Food Corner</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  nav{
          justify-content:flex-end;
          margin-left:auto;
          background-color: #a4cdc1ff;
  }
  ul{
    display:flex;
  }
  ul li{
    list-style-type:none;
    padding-right:5px;
    padding-left:5px;
  }
  ul li a{
    text-decoration:none;
    color:white;
  }
</style>  
</head>
<body>
<nav class="navbar ">
  <div class="container-fluid">
    <h5 class="text-white py-1">🍔 Food Corner</h5>
    <ul class="pt-2">
      <li><a href="index.php" class="btn btn-warning rounded-4 px-4">Home</a></li>
      <li><a href="cart.php" class="btn btn-warning rounded-4 px-4">🛒Cart</a></li>
      <li><a href="about.php" class="btn btn-warning rounded-4 px-4">About us</a></li>
      <li><a href="contact.php" class="btn btn-warning rounded-4 px-4 " >Contact us</a></li>
    </ul>
  </div>
</nav>
</body>
</html>
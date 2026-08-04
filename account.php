<?php
session_start();
?>
<html>
    <head>
        <title>Account</title>
        <link rel="stylesheet" href="account.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/fonts.css">
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrapjquery.js"></script>
        <script src="js/proper.js"></script>

    </head>
    <body>
    <nav class="navbar navbar-light bg-dark justify-content-between">
    <a class="navbar-brand">Admin: <?php echo $d=strtoupper($_SESSION['ename']); ?></a>
    <form class="form-inline">
    <a class="btn btn-outline-danger " href="index.php">Log Out</a>
    </form>
    </nav>
    <div class="container-fluid bg">
    <div class="row justify-content-center">
    <div class="list-group col-md-4">
    <a class="list-group-item list-group-item-success">
    Control Pannel
    </a>
    <a href="customer.php" class="list-group-item list-group-item-action">Book a New Slot</a>
    <a href="manage.php" class="list-group-item list-group-item-action">Manage Existing Bookings</a>
    <a href="history.php" class="list-group-item list-group-item-action">Bill History</a>
    <a href="check.php" class="list-group-item list-group-item-action">Check Available Slot</a>
    <a href="value.php" class="list-group-item list-group-item-action">Register a New Slot</a>
    </div>
    </div>
    </div>
    </body>
</html>
<?php
include('connection.php');
session_start();
$cname="";
$number="";
$license="";
if(isset($_POST['next'])){
    $cname=$_POST['cname'];
    $number=$_POST['number'];
    $license=$_POST['license'];
    $_SESSION['cname']=$cname;
    $_SESSION['number']=$number;
    $_SESSION['license']=$license;
    $sql= "INSERT INTO customer(cname,number,license) VALUES ('$cname','$number','$license')";
    mysqli_query($db,$sql);
    $c = "select cust_id from customer where license ='$license'";
    $result1 = mysqli_query($db,$c);
        while($row = $result1->fetch_assoc()){
            $_SESSION['cust_id']=$row["cust_id"];
        }
        echo "<script>
        window.location.href='vehicle.php';
        </script>";
}
?>
<html>
    <head>
        <title>Customer Details</title>
        <link rel="stylesheet" href="customer.css">
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
    <a class="btn btn-outline-danger" href="account.php">Go back to Account Section</a>
    </form>
    </nav>
    <div class="container-fluid bg">
            <div class="row justify-content-center">
            <div class="col-4">
                
            <form class="form-conatiner" action="customer.php" method="post">
                <div class="form-group">
                <h3>Customer Details</h3>
                </div>
                <div class="form-group">
                <label class="control-label">Customer Name</label>
                <input class="form-control" name="cname" type="text" value="<?php echo $cname; ?>" required>
                </div>
                <div class="form-group">
                <label class="control-label">Phone Number</label>
                <input class="form-control" name="number" type="text" value="<?php echo $number; ?>" required>
                </div>
                <div class="form-group">
                <label class="control-label">Driving License Number</label>
                <input class="form-control" name="license" type="text" value="<?php echo $license; ?>" required>
                <br>
                <input class="but btn-success btn-lg btn-block" type="submit" name="next" value="NEXT">
            </form>
            </div>
            </div>
            <div class="col-4">
            <form class="form-conatiner">
                <div class="form-group">
                <h3>Vehicle Details</h3>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Number</label>
                <input class="form-control" name="cname" type="text" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Type</label>
                <input class="form-control" name="number" type="text" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Model</label>
                <input class="form-control" name="license" type="text" disabled>
            </form>
            </div>
            </div>
            <div class="col-4">
            <form class="form-conatiner">
            <div class="form-group">
            <h3>Slot Details</h3>
            </div>
            <div class="form-group">
            <label class="control-label">Select a Slot</label>
            <select class="form-control" name="slot_id" id="" disabled>
            <option>--Select Slot--</option>
            </select>
            </div>
            </form>
            </div>
            </div>
    </div>
    </body>
</html>
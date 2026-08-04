<?php
include('connection.php');
session_start();
$veh_error ="";
$veh_nu="";
$veh_model="";
if(isset($_POST['next'])){
    $cust_id=$_SESSION['cust_id'];
    $veh_nu=$_POST['veh_nu'];
    $veh_type=$_POST['veh_type'];
    $veh_model=$_POST['veh_model'];
    $_SESSION['veh_nu']=$veh_nu;
    $_SESSION['veh_type']=$veh_type;
    $_SESSION['veh_model']=$veh_model;
    $sql_v="SELECT * FROM vehicle WHERE veh_nu='$veh_nu'";
    $res_v=mysqli_query($db,$sql_v);
    if(mysqli_num_rows($res_v)<1){
    $sql= "INSERT INTO vehicle(cust_id,veh_nu,veh_type,veh_model) VALUES ('$cust_id','$veh_nu','$veh_type','$veh_model')";
    $result = mysqli_query($db,$sql);
    $c = "select veh_nu from vehicle where cust_id ='$cust_id'";
    $result1 = mysqli_query($db,$c);
        while($row = $result1->fetch_assoc()){
            $_SESSION['veh_id']=$row["veh_nu"];
        }
        echo "<script>
        window.location.href='pslot.php';
        </script>";
    }else{
        $veh_error="Sorry... Invalid vehicle number";
    }
}
else if(isset($_POST['dismis'])){
    $cust_id=$_SESSION['cust_id'];
    $sq = "DELETE FROM customer WHERE cust_id='$cust_id'";
    mysqli_query($db,$sq);
    echo "<script>alert('Undoing Changes');
        window.location.href='account.php';
        </script>";

}
?>
<html>
<head>
        <title>Vehicle Details</title>
        <link rel="stylesheet" href="vehicle.css">
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
    <a class="btn btn-outline-danger " href="account.php">Go back to Account Section</a>
    </form>
    </nav>
    <div class="container-fluid bg">
            <div class="row justify-content-center">
            <div class="col-4">
            <form class="form-conatiner">
                <div class="form-group">
                <h3>Customer Details</h3>
                </div>
                <div class="form-group">
                <label class="control-label">Customer Name</label>
                <input class="form-control" name="cname" type="text" value="<?php echo  $_SESSION['cname']; ?>" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Phone Number</label>
                <input class="form-control" name="number" type="text" value="<?php echo $_SESSION['number']; ?>" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Driving License Number</label>
                <input class="form-control" name="license" type="text" value="<?php echo $_SESSION['license']; ?>" disabled>
            </form>
            </div>
            </div>
            <div class="col-4">
            <form class="form-conatiner" action="vehicle.php" method="post">
                <div class="form-group">
                <h3>Vehicle Details</h3>
                </div>
                <div class="form-group">
                <div <?php if(isset($veh_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Vehicle Number</label>
                <input class="form-control" class="user" name="veh_nu" type="text" value="<?php echo $veh_nu; ?>" required>
                <?php if(isset($veh_error)) ?>
                <span><?php echo $veh_error; ?></span>
                </div>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Type</label>
                    <select class="form-control" name="veh_type">
                    <option value="">--Select--</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                    <option value="scooty">Scooty</option>
                    <option value="truck">Truck</option>
                </select>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Model</label>
                <input class="form-control" class="user" name="veh_model" type="text" value="<?php echo $veh_model; ?>" required>
                </div>
                <div class="form-group">
                <input class="but btn-success btn-lg btn-block" type="submit" name="next" value="Next">
                </div>
                <div class="form-group">
                <input class="but btn-danger btn-lg btn-block" data-toggle="tooltip" tittle="" data-placement="top" type="submit" name="dismis" value="Dismiss">
                </div>
            </form>
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
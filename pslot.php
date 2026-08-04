<?php
include('connection.php');
    session_start();

    $sql="SELECT slot_id FROM pslot where veh_id IS NULL or veh_id=''";
    $result = mysqli_query($db,$sql);
    if(isset($_POST['book'])){
        $slot_id=$_POST['slot_id'];
        $veh_id=$_SESSION['veh_id'];
        date_default_timezone_set('Asia/Kolkata');
        $s_time = strtotime(date('Y-m-d H:i:s'));
        $sq = "UPDATE pslot SET veh_id='$veh_id',s_time='$s_time' WHERE slot_id='$slot_id'";
        $result1 = mysqli_query($db,$sq);
        echo "<script>alert('Slot booked Successfully');
            window.location.href='account.php';
            </script>";
        
    }
    else if(isset($_POST['dismis'])){
        $veh_id=$_SESSION['veh_id'];
        $sq = "DELETE FROM vehicle WHERE veh_nu='$veh_id'";
        mysqli_query($db,$sq);
        echo "<script>alert('Undoing Changes');
            window.location.href='account.php';
            </script>";
    
    }
?>
<html>
    <head>
        <title>Parking Slot</title>
        <link rel="stylesheet" href="pslot.css">
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
            <form class="form-conatiner">
                <div class="form-group">
                <h3>Vehicle Details</h3>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Number</label>
                <input class="form-control" name="cname" type="text" value="<?php echo $_SESSION['veh_nu']; ?>" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Type</label>
                <input class="form-control" name="number" type="text" value="<?php echo $_SESSION['veh_type']; ?>" disabled>
                </div>
                <div class="form-group">
                <label class="control-label">Vehicle Model</label>
                <input class="form-control" name="license" type="text" value="<?php echo $_SESSION['veh_model']; ?>" disabled>
            </form>
            </div>
            </div>
            <div class="col-4">
            <form class="form-conatiner" action="pslot.php" method="post">
            <div class="form-group">
            <h3>Slot details</h3>
            </div>
            <div class="form-group">
            <label class="control-label">Select a Slot</label>
            <select class="form-control" name="slot_id" id="">
            <option>--Select Slot--</option>
            <?php while($row = $result->fetch_assoc()){
            $slot_id = $row['slot_id'];
            echo "<option value='$slot_id'>$slot_id</option>";
            }
            ?>
            </select>
            </div>
            <div class="form-group">
            <input class="but btn-success btn-lg btn-block" type="submit" name="book" value="BOOK">
            </div>
            <div class="form-group">
            <input class="but btn-danger btn-lg btn-block" type="submit" name="dismis" value="Dismiss">
            </div>
            </form>
        </div>
        </div>
    </div>
    </body>
</html>
<?php
include('connection.php');
session_start();
$sql="SELECT * FROM bill";
$result=mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
if(isset($_POST['delete_history'])){
    $cust_id=$_POST['keytoproc'];
    $dlt="DELETE FROM bill WHERE cust_id='$cust_id'";
    mysqli_query($db,$dlt);
    echo "<script>alert('Bill History Deleted');</script>";
    header("refresh:1");
}
?>
<html>
    <head>
        <title>Bill History</title>
        <link rel="stylesheet" href="history.css">
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
        <div class="col col-lg-10">
       <table class="table table-striped">
           <thead class="thead-dark">
           <tr>
               <th>Customer Id</th>
               <th>Customer Name</th>
               <th>Customer License</th>
               <th>Vehicle Numer</th>
               <th>Slot Number</th>
               <th>Entry Time</th>
               <th>Exit time</th>
               <th>Duration</th>
               <th>Bill Amount</th>
               <th>Select</th>
               <th>Delete History</th>
           </tr>
           </thead>
           <tbody class="tb">
           <?php 
           if($num > 0){
               while($row = $result->fetch_assoc()){?>
            <tr>
                <form action="history.php" method="post">
                <td><?php echo $row['cust_id'];?></td>
                <td><?php echo $row['cust_name'];?></td>
                <td><?php echo $row['cust_license'];?></td>
                <td><?php echo $row['veh_id'];?></td>
                <td><?php echo $row['slot_id'];?></td>
                <td>
                    <?php $s_time = $row['s_time']+16199;
                    echo date('Y-m-d H:i:s',$s_time);
                    ?>
                </td>
                <td>
                    <?php $e_time = $row['e_time']+16199;
                    echo date('Y-m-d H:i:s',$e_time);
                    ?>
                </td>
                <td>
                    <?php $diff = $row['duration'];
                    $years = floor($diff/(365*60*60*24));
                    $months = floor(($diff-$years*365*60*60*24)/(30*60*60*24));
                    $days = floor(($diff-$years*365*60*60*24-$months*30*60*60*24)/(60*60*24));
                    $hours = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24)/(60*60));
                    $minutes = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24-$hours*60*60)/60);
                    $seconds = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24-$hours*60*60-$minutes*60));
                    echo $hours."h:".$minutes."m:".$seconds."s";
                    ?>
                </td>
                <td><?php echo $row['amount']."rs";?></td>
                <td>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="<?php echo $row['cust_id'];?>" name="keytoproc" value="<?php echo $row['cust_id'];?>" required>
                    <label class="custom-control-label" for="<?php echo $row['cust_id'];?>"></label>
                </div>
                </td>
                <td>
                    <input class="btn btn-outline-primary" type="submit" name="delete_history" value="Delete History">
                </td>
            </tr>
            </form>
        <?php
               }
           }
           ?>
           <tbody>
       </table>
        </div>
        </div>
    </div>
    </body>
</html>
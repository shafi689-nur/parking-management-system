<?php
include('connection.php');
session_start();
$slot_id=$_SESSION['slot_id'];
$sql="
select c.cust_id,c.cname,c.number,c.license,v.veh_nu,v.veh_type,v.veh_model,p.s_time from customer c,vehicle v,pslot p where c.cust_id=v.cust_id and v.veh_nu=p.veh_id and slot_id='$slot_id'";
$result=mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
if($num > 0){
    while($row = $result->fetch_assoc()){
        $cust_id=$row['cust_id'];
        $cust_name=$row['cname'];
        $number=$row['number'];
        $cust_license=$row['license'];
        $veh_id=$row['veh_nu'];
        $veh_type=$row['veh_type'];
        $veh_model=$row['veh_model'];
        $s_time=$row['s_time'];
if(isset($_POST['generate_bill'])){
    date_default_timezone_set('Asia/Calcutta');
    $e_time = strtotime( date('Y-m-d H:i:s'));
    $duration = abs($e_time - $s_time);
    $to=floor(($duration/60)/30);
    $amount = (40+($to*20));
    $slot_id = $_SESSION['slot_id'];
    $sq= "INSERT INTO bill(cust_name,cust_license,veh_id,slot_id,s_time,e_time,amount,duration,cust_id) VALUES ('$cust_name','$cust_license','$veh_id','$slot_id','$s_time','$e_time','$amount','$duration','$cust_id')";
    mysqli_query($db,$sq);
    echo "<script>alert('Bill paid for vehicle number: $veh_id');
    window.location.href='manage.php';
        </script>";

    
}
?>
<html>
    <head>
        <title>Payment Section</title>
        <link rel="stylesheet" href="bill.css">
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
    <a class="btn btn-outline-danger mr-sm-2 " href="manage.php">Go back to Manage Section</a>
    <a class="btn btn-outline-danger my-2 my-sm-0" href="account.php">Go back to Account Section</a>
    </form>
    </nav>
    <div class="container-fluid bg">
        <div class="row justify-content-center">
        <div class="col col-6">
        <form action="bill.php" method="post">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
            <th>
            <h3>Details for:</h3> 
            </th>
            <th>
            <h3><?php echo $_SESSION['slot_id']; ?></h3>
            </th>
            </tr>
            </thead>
            <tbody class="tb">
            <tr>
               <th scope="row">Customer Id</th>
               <td><?php echo $cust_id;?></td>
            </tr>
            <tr>
               <th scope="row">Customer Name</th>
               <td><?php echo $cust_name;?></td>
            </tr>
            <tr>
               <th scope="row">Phone Number</th>
               <td><?php echo $number;?></td>
            </tr>
            <tr>
               <th scope="row">License</th>
               <td><?php echo $cust_license;?></td>
            </tr>
            <tr>
               <th scope="row">Vehicle Number</th>
               <td><?php echo $veh_id;?></td>
            </tr>
            <tr>
               <th scope="row">Vehicle Type</th>
               <td><?php echo $veh_type;?></td>
            </tr>
            <tr>
               <th scope="row">Vehicle_model</th>
               <td><?php echo $veh_model;?></td>
            </tr>
            <tr>
               <th scope="row">Booking Time</th>
               <td><?php $s_time=$s_time+16199;
                 echo $time=date('Y-m-d H:i:s',$s_time);
                ?></td>
            </tr>
            <tr>
            <td><input type="submit" class="btn btn-outline-success" name="generate_bill" value="Pay Bill"></td>
            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Check Bill</button></td>
            </tr>
            </tbody>
            </table>
            </form>
        <?php
               }
           }
           ?>
           </div>
        </div>
    </div>
       <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
       <div class="modal-content">
       <div class="modal-header">
       <h3 class="modal-title" id="exampleModalLabel">Bill</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       </div>
       <div class="modal-body">
           <table class="table table-striped">
               <tr>
                   <th>Customer Name:</th>
                   <td><?php echo $cust_name;?></td>
               </tr>
               <tr>
                   <th>Phone Number:</th>
                   <td><?php echo $number;?></td>
               </tr>
               <tr>
                   <th>Vehicle Number:</th>
                   <td><?php echo $veh_id;?></td>
               </tr>
               <tr>
                   <th>Vehicle Type:</th>
                   <td><?php echo $veh_type;?></td>
               </tr>
               <tr>
                   <th>Vehicle Model:</th>
                   <td><?php echo $veh_model;?></td>
               </tr>
               <tr>
                   <th>Entry Time:</th>
                   <td><?php echo $time=date('Y-m-d H:i:s',$s_time);?></td>
               </tr>
               <tr>
                   <th>Exit Time:</th>
                   <td><?php
                  date_default_timezone_set('Asia/Calcutta');
                  $e_time = strtotime(date('Y-m-d H:i:s'));
                  echo $time=date('Y-m-d H:i:s',$e_time);
                ?></td>
               </tr>
               <tr>
                   <th>Duration:</th>
                   <td><?php
                $diff = abs(($e_time - $s_time)+16199);
                $years = floor($diff/(365*60*60*24));
                $months = floor(($diff-$years*365*60*60*24)/(30*60*60*24));
                $days = floor(($diff-$years*365*60*60*24-$months*30*60*60*24)/(60*60*24));
                $hours = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24)/(60*60));
                $minutes = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24-$hours*60*60)/60);
                $seconds = floor(($diff - $years*365*60*60*24-$months*30*60*60*24-$days*60*60*24-$hours*60*60-$minutes*60));
                echo $hours."h:".$minutes."m:".$seconds."s";
                ?></td>
               </tr>
               <tr>
                   <th>Amount:</th>
                   <td><?php
                $t=floor(($diff/60)/30);
                $am=40+(20*$t);
                echo $am."rs";
                ?></td>
               </tr>
           </table>
       </div>
       <div class="modal-footer">
       <div class="alert alert-warning" role="alert">
       <p>Payment Method: Cash Only</p>
       <p>**Base fare 40rs + 20rs for every next 30min.</p>
       </div>
       </div>
       </div>
       </div>
       </div>

    </body>
    <script>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>
<?php
include('connection.php');
session_start();
$sql="SELECT * FROM pslot WHERE veh_id=''";
$result=mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
$s="SELECT * FROM `pslot` WHERE s_time IS NOT NULL";
$result1=mysqli_query($db,$s);
$num1 = mysqli_num_rows($result1);
?>
<html>
    <head>
        <title>Available slots</title>
        <link rel="stylesheet" href="check.css">
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
    <div class="list-group col-md-3">
    <ul class="list-group">
      <li class="lis list-group-item bg-success d-flex justify-content-between align-items-center">
      List of the available slots:
      <span class="badge badge-light badge-pill"><?php echo $num;?></span>
      </li>
      <?php if($num > 0){
               while($row = $result->fetch_assoc()){?>
      <li class="lis list btn-outline-success">
      <?php echo $row['slot_id'];?>
      </li>
      <?php } }?>
      <?php if($num1 > 0){
               while($row = $result1->fetch_assoc()){?>
      <li class="lis list btn-outline-danger">
      <?php echo $row['slot_id'];?>
      </li>
      <?php } }?>
    </ul>
    </div>
    </div>
    </div>
</body>
</html>
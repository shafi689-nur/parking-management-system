<?php
include('connection.php');
session_start();
$sql="SELECT slot_id,veh_id FROM pslot WHERE s_time IS NOT NULL";
$result=mysqli_query($db,$sql);
$num = mysqli_num_rows($result);
if(isset($_POST['check_info'])){
    session_start();
    $_SESSION['slot_id']=$_POST['keytoproc'];
    $id=$_POST['keytoproc'];
    echo "<script>
        window.location.href='bill.php';
        </script>";
}
?>
<html>
    <head>
        <title>Manage Details</title>
        <link rel="stylesheet" href="manage.css">
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
        <div class="col col-md-6">
       <table class="table table-striped">
           <thead class="thead-dark">
           <tr>
               <th>Slot Id</td>
               <th>Vehicle Number</td>
               <th>Select</td>
               <th>Check Info</td>
           </tr>
           </thead>
           <tbody class="tb">
           <?php 
           if($num > 0){
               while($row = $result->fetch_assoc()){?>
            <tr>
                <form action="manage.php" method="post">
                <td><?php echo $row['slot_id'];?></td>
                <td><?php echo $row['veh_id'];?></td>
                <td>
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="<?php echo $row['slot_id'];?>"  name="keytoproc" value="<?php echo $row['slot_id'];?>" required>
                    <label class="custom-control-label" for="<?php echo $row['slot_id'];?>"></label>
                </div>
                </td>
                <td>
                    <input class="btn btn-outline-primary" type="submit" name="check_info" value="Check Info">
                </td>
                </form>
            </tr>
        <?php
               }
           }
           ?>
           </tbody>
       </table>
       </div>
        </div>
    </div>
    </body>
</html>
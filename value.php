<?php
include('connection.php');
session_start();
$id_error="";
$slot_id="";
if(isset($_POST['create'])){
    $slot_id=$_POST['slot_id'];
    $veh_id=NULL;
    $s = " select * from pslot where slot_id = '$slot_id'";
    $result=mysqli_query($db,$s);
    $num = mysqli_num_rows($result);
    if($num > 0){
        $id_error = "Sorry...Slot Id already exists";
    }
    else{
    $sql= "INSERT INTO pslot(slot_id,veh_id) VALUES ('$slot_id','$veh_id')";
        mysqli_query($db,$sql);
        echo "<script>alert('$slot_id created')</script>";
    }
}
?>
<html>
    <head>
        <title>Create Slot</title>
        <link rel="stylesheet" href="value.css">
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
        <div class="col-md-4">
            <form class="form-conatiner" action="value.php" method="post">
                <div class="form-group">
                <h3>Create a new slot</h3>
                </div>
                <div class="form-group">
                <div <?php if(isset($id_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Enter slot Id</label>
                <input class="form-control" class="user" name="slot_id" type="text" value="<?php echo $slot_id; ?>" required>
                <?php if(isset($id_error)) ?>
                <span><?php echo $id_error; ?></span>
                </div>
                <br>
                <div class="form-group">
                <input class="but btn-success btn-lg btn-block" type="submit" name="create" value="Create">
                </div>
            </form>
            </div>
        </div>
    </div>
    </body>
</html>
<?php
include('connection.php');
$pass_error="";
$id_error="";
$emp_id="";
if(isset($_POST['login'])){
    session_start();
    $emp_id=$_POST['emp_id'];
    $password=$_POST['password'];
    $password=md5($password);
    $s = " select * from employee where emp_id = '$emp_id' && password = '$password'";
    $c = "select ename,emp_id from employee where emp_id ='$emp_id'";
    $sql_i="SELECT * FROM employee WHERE emp_id='$emp_id'";
    $result = mysqli_query($db,$s);
    $result1 = mysqli_query($db,$c);
    $num = mysqli_num_rows($result);
    $res_i=mysqli_query($db,$sql_i);
    if($num == 1){
        while($row = $result1->fetch_assoc()){
            $_SESSION['ename']=$row["ename"];
            $_SESSION['emp_id']=$row["emp_id"];
        }
        echo "<script>alert('login successful');
        window.location.href='account.php';
        </script>";
    }
    else if(mysqli_num_rows($res_i) < 1){
        $id_error = "Invalid Employee Id";
    }
    else{
        $pass_error="Entered password is incorrect";
    }
}
?>

<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/fonts.css">
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrapjquery.js"></script>
        <script src="js/proper.js"></script>
    </head>
    <body>
    <div class="container-fluid bg">
            <div class="row justify-content-center">
            <div class="col-md-4">
            <form class="form-conatiner" action="login.php" method="post">
                <div class="form-group">
                <h1>LOG IN</h1>
                </div>
                <div class="form-group">
                <div <?php if(isset($id_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Employee Id</label>
                <input class="form-control" name="emp_id" type="text" value="<?php echo $emp_id; ?>"  required>
                <?php if(isset($id_error)) ?>
                <span><?php echo $id_error; ?></span>
                </div>
                </div>
                <div class="form-group">
                <div <?php if(isset($pass_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Password</label>
                <input class="form-control" name="password" type="password" required>
                <?php if(isset($pass_error)) ?>
                <span><?php echo $pass_error; ?></span>
                </div>
                </div>
                <br>
                <input class="but btn-success btn-lg btn-block" type="submit" name="login" value="LOGIN">
            </form>
            </div>
            </div>
        </div>
    </body>
</html>
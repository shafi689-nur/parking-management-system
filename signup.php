<?php
include('connection.php');
$id_error="";
$email_error="";
$pass_error="";
$ename="";
$emp_id="";
$email="";
if(isset($_POST['signup'])){
    session_start();
    $ename=$_POST['ename'];
    $emp_id=$_POST['emp_id'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $sql_i="SELECT * FROM employee WHERE emp_id='$emp_id'";
    $sql_e="SELECT * FROM employee WHERE email='$email'";
    $res_i=mysqli_query($db,$sql_i);
    $res_e=mysqli_query($db,$sql_e);
    if(mysqli_num_rows($res_i)>0){
        $id_error = "Sorry... Id already taken";
    }
    else if(mysqli_num_rows($res_e)>0){
        $email_error = "Sorry... Email already taken";
    }
    else if($password == $cpassword){
        $password = md5($password);
        $sql= "INSERT INTO employee(ename,emp_id,email,password) VALUES ('$ename','$emp_id','$email','$password')";
        mysqli_query($db,$sql);
        echo "<script>alert('signup successful');
        window.location.href='login.php';
        </script>";
    } else{
        $pass_error = "Sorry... Two password didn't match";


    }
}
?>
<html>
    <head>
        <title>SIGNUP</title>
        <link rel="stylesheet" href="signup.css">
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
            <form class="form-conatiner" action="signup.php" method="post">
                <div class="form-group">
               <h2>Sign Up</h2>
               </div>
               <div class="form-group">
                <label class="control-label">Full Name</label>
                <input class="form-control" name="ename" type="text" value="<?php echo $ename; ?>" required>
                </div>
                <div class="form-group">
                <div <?php if(isset($id_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Employee Id</label>
                <input class="form-control" name="emp_id" type="text" value="<?php echo $emp_id; ?>" required>
                <?php if(isset($id_error)) ?>
                <span><?php echo $id_error; ?></span>
                </div>
                </div>
                <div class="form-group">
                <div <?php if(isset($email_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Email Id</label>
                <input class="form-control" name="email" type="email" value="<?php echo $email; ?>" required>
                <?php if(isset($email_error)) ?>
                <span><?php echo $email_error; ?></span>
                </div>
                <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" name="password" type="password" required>
                </div>
                <div class="form-group">
                <div <?php if(isset($pass_error)){ ?>class="form_error"<?php } ?>>
                <label class="control-label">Confirm Password</label>
                <input class="form-control" name="cpassword" type="password" required>
                <?php if(isset($pass_error)) ?>
                <span><?php echo $pass_error; ?></span>
                </div>
                <br>
                <input class="but btn-success btn-lg btn-block" type="submit" name="signup" value="SIGNUP">
            </form>
            </div>
            </div>
        </div>
    </body>
</html>
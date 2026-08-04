<?php
include('connection.php');
$s="CALL `contact`();";
$sql=mysqli_query($db,$s);
$num=mysqli_num_rows($sql);

?>
<html>
    <head>
        <title>Contact</title>
        <title>Available slots</title>
        <link rel="stylesheet" href="contact.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/fonts.css">
        <script src="js/bootstrap.js"></script>
        <script src="js/bootstrapjquery.js"></script>
        <script src="js/proper.js"></script>
    </head>
    <body>
    <div class="container-fluid bg">
    <div class="row justify-content-center">
    <div class="list-group col-md-3">
    <ul class="list-group">
      <li class="lis list-group-item bg-primary d-flex justify-content-between align-items-center">
      Contact Details:
      </li>
      <?php if($num > 0){
               while($row = $sql->fetch_assoc()){?>
      <li class="lis list">
      <?php echo "Name: ".$row['name'];?>
      </li>
      <li class="lis list">
      <?php echo "Number: ".$row['number'];?>
      </li>
      <li class="lis list">
      <?php echo "Email: ".$row['email'];?>
      </li>
      <li class="lis list">
      <?php echo "Address: ".$row['address'];?>
      </li>
      <?php } }?>
    </ul>
    </div>
    </div>
    </div>
    </body>
</html>
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/log.php');

if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $select="select ID from tbladmin where  Email='$email' && Password='$password' ";
    $query=mysqli_query($con, $select);
    $ret=mysqli_fetch_array($query);
######################################################################################################
 		$log_msg =  $select;
		wh_log("************** Start Log For Day : '" . $log_time . "'**********");
		wh_log($log_msg);
		wh_log("************** END Log For Day : '" . $log_time . "'**********");
##################################################################################################	 
  
  
    if($ret>0){
      $_SESSION['detsuid1']=$ret['ID'];
     header('location:dashboard.php');
    }
    else{
    $msg="Invalid Details.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">


	<style type="text/css">

		@media screen and (max-width: 480px) {
              
              .checkspan{
			    padding-left: 175px !important;
		        }
         }
		
	</style>
	
</head>
<body>

	<div class="row">
			<h2 align="center">Daily Expense Tracker</h2>
	<hr />
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in
						<a href="../index.php" class="btn btn-danger" style="float: right;">User Login</a>
			 </div>
				<div class="panel-body">
					<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
					<form role="form" action="" method="post" id="" name="login">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="true">
							</div>
							<a href="forgot-password.php">Forgot Password?</a>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" id="myInput" type="password" value="" required="true"><br>
								<input type="checkbox" onclick="myFunction()">Show Password

							</div>
							<div class="checkbox" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
								<button type="submit" value="login" name="login" class="btn btn-primary">login</button><span class="checkspan">
								<!-- <a href="register.php" class="btn btn-primary">Register</a></span> -->
							</div>
							</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

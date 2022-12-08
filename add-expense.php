<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/log.php');

if (strlen($_SESSION['detsuid']==0)) {
	header('location:logout.php');
} else{

	if(isset($_POST['submit']))
	{ 
		$userid=$_SESSION['detsuid'];
		$dateexpense=$_POST['dateexpense'];
		$item=$_POST['item'];
		$costitem=$_POST['costitem'];
		$Quantity=$_POST['Quantity'];


		
		$select="SELECT `Money` as sum FROM `add_money`  where (UserId='$userid') ";
		$ret1=mysqli_query($con,$select);   
		$row1=mysqli_fetch_array($ret1);               
		
		$Opening_balance=$row1['sum'];  

		if($costitem>$Opening_balance){ 
			echo "<script>alert('insufficent Balance');</script>"; 
			echo "<script>window.location.href='add-expense.php'</script>";

		} else{
			$Closing_balance= $Opening_balance - $costitem; 
			$Update="UPDATE `add_money` SET `Money`='$Closing_balance'  where (UserId='$userid')";
			mysqli_query($con,$Update);

			

			$insert="insert into tblexpense(UserId,ExpenseDate,ExpenseItem,Opening_balance,ExpenseCost,Closing_balance,Quantity) value('$userid','$dateexpense','$item','$Opening_balance','$costitem','$Closing_balance','$Quantity')";
			$query=mysqli_query($con,$insert); }
######################################################################################################
			$log_msg =  $insert;
			//wh_log("************** Start Log For Day : '" . $log_time . "'**********");
			wh_log($log_msg);
			//wh_log("************** END Log For Day : '" . $log_time . "'**********");
##################################################################################################	 
			
			if($query){
				echo "<script>alert('Expense has been added');</script>";
				echo "<script>window.location.href='manage-expense.php'</script>";
			} 
			else {
				echo "<script>alert('Something went wrong. Please try again');</script>"; 
			}
			
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Daily Expense Tracker || Add Expense</title>
			<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
			<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/font-awesome.min.css" rel="stylesheet">
			<link href="css/datepicker3.css" rel="stylesheet">
			<link href="css/styles.css" rel="stylesheet">
			
			<!--Custom Font-->
			<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
		
		
		<div class="row">
			<div class="col-lg-12">
				
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
							echo $msg;
						}  ?> </p>
						<div class="col-md-12"> 
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" id="txtDate" value="" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<select class="form-control tags " name="item">
										<option value="pen">pen</option>
										<option value="notebook">notebook</option>
										<option value="mouse">mouse</option>
									</select>
								</div>  
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="number" value="" required="true" name="costitem">
								</div> 
								<div class="form-group">
									<label>Quantity</label>
									<input class="form-control" type="number" value="1"  required="true" name="Quantity">
								</div> 
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div> 
							</div> 
						</form>
					</div>
				</div>
			</div><!-- /.panel-->
		</div><!-- /.col-->
	</div><!-- /.row -->
	<?php include_once('includes/footer.php');?>
</div><!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">

	$(function(){
		var dtToday = new Date();
		
		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10)
			month = '0' + month.toString();
		if(day < 10)
			day = '0' + day.toString();
		
		var maxDate = year + '-' + month + '-' + day;
    //alert(maxDate);
    $('#txtDate').attr('max', maxDate);
});
</script>
<script type="text/javascript">
	
	$(".tags").select2({
		placeholder: 'Select an option',
		tags: true
	});
	
</script>
</body>
</html>
<?php }  ?>
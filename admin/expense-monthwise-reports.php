<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid1']==0)) {
  header('location:logout.php');
  } else{

  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker ||  Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
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
				<li class="active"> Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading"> Expense Report</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
					


							<form role="form" method="post" action="expense-monthwise-reports-detailed.php" name="bwdatesreport">
										
																									<div>  
																										<select name="userid"style="
																																width: 150px;
																																    height: 35px;
																																    margin: 0px 0 10px 0px;
																																    padding: 5px;
																																    border-radius: 5px;
																																    border: none;
																																        background-color: #e6dfd5;
																																    outline: none;
																																    font-weight: 600;
																																    box-shadow: rgb(0 0 0 / 90%) 2px 2px 5px;">
																											<option>Select User</option>
																											<!-- <option value="0" ?>All</option> -->
																											<?php $select="SELECT * FROM `tbluser`";
																														$query=mysqli_query($con,$select);
																											while($res=mysqli_fetch_array($query))  {  ?>

																											<option value="<?php echo $res['ID']; ?>"><?php echo $res['FullName']; ?></option>

																										<?php } ?>
																										</select>
																									</div>
		


								<div class="form-group">
									<label>From Date</label>
									<input class="form-control" type="date"  id="fromdate" name="fromdate" required="true">
								</div>
								<div class="form-group">
									<label>To Date</label>
									<input class="form-control" type="date"  id="todate" name="todate" required="true">
								</div>
								
							
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Submit</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->
			<?php include_once('includes/footer.php');?>
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>

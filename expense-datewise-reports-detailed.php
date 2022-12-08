<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/log.php');

if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
  ?>

  
<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Datewise Expense Report</title>
	<!--link -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
 	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
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
				<li class="active">Datewise Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Datewise Expense Report</div>
					<div class="panel-body">
					<a id="day" href="check.php" >	<button type="submit"  class="btn btn-primary" style="float: right;" name="export">export</button></a>

						<div class="col-md-12">
					
					<?php
					$fdate=$_POST['fromdate'];
					 $tdate=$_POST['todate'];
					$rtype=$_POST['requesttype'];
					//for report we use session 
					$_SESSION['fdate']=$fdate;
					$_SESSION['tdate']=$tdate;
					?>
<h5 align="center" style="color:blue">Datewise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
               <table   class="table table-bordered dt-responsive nowrap" id="exaample" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
             						<thead>
                                        <tr>
                                            <tr>
																              <th>S.NO</th>
																              <th>Date</th>
																              <th>Item</th>
																              <th>Quantity</th>
																              <th>Cost</th>
              
                                            </tr> 
                                        </tr>
                                        </thead>
						 <?php
								 $userid=$_SESSION['detsuid'];
									$select="SELECT ExpenseDate,ExpenseItem,ExpenseCost,Quantity FROM `tblexpense` where (ExpenseDate BETWEEN '$fdate' and '$tdate')&& (UserId='$userid') ";
									$ret=mysqli_query($con,$select);
									$cnt=1;
									######################################################################################################
									 		$log_msg =  $select;
											wh_log("************** Start Log For Day : '" . $log_time . "'**********");
											wh_log($log_msg);
											wh_log("************** END Log For Day : '" . $log_time . "'**********");
									##################################################################################################	 
									 
									while ($row=mysqli_fetch_array($ret)) {

						 ?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td><?php  echo $row['Quantity'];?></td>
                  <td><?php  echo $ttlsl=$row['ExpenseCost'];?></td>
               																	
                </tr>
                <?php
               				 $totalsexp+=$ttlsl; 
               				 $cnt=$cnt+1;
									}
									if($totalsexp!=0){?>

								 <tr>
								  <th colspan="4" style="text-align:right">Grand Total</th>     
								  <td><?php echo "<b>".number_format($totalsexp).".00" ."</b>";?></td>
								 </tr>     
								<?php }else{ ?> <tr>
								  <th colspan="4" style="text-align:center;">No matching records found</th></tr><?php } ?>
  </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->
			<?php include_once('includes/footer.php');?>
	
<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
 
		<script>
     $(document).ready(function(){
    $('#exaample').dataTable();
   });

	</script>
</body>
</html>
<?php } ?>
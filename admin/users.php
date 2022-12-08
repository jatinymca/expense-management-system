 <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid1']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<!-- <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Yearwise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	 
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head> -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || </title>
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
				<li class="active">Users</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			 <div class="panel panel-default">
					<div class="col-md-12">
	  				<table   class="table table-bordered dt-responsive nowrap" id="" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <tr>
              																	<th>S.NO</th>
																	              <th>Users</th>
																	              <th>Action</th>
																	               
                														</tr>
                                        </tr>
                                        </thead>
																 <?php 
																			$ret=mysqli_query($con,"SELECT * FROM `tbluser` ");
																			$cnt=1;
																			while ($row=mysqli_fetch_array($ret)) {
																				// $_SESSION['userid']=$row['ID'];

																	?>
																	              
                <tr>
                  <td><?php echo $cnt;?></td>
            			<td><?php  echo $row['FullName'] ;?></td>
            			<td><a href="manage-expense.php?userid=<?php echo $row['ID'];?>"  class="user" id= "" ><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                </tr>
                <?php
										  $cnt=$cnt+1;
									} ?>                                 
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

    // $(document).ready(function(){
 
    //   $(document).on('click','.user', function(){  
    //        var Id = $(this).attr("id");  
    //        alert(Id);

           // $.ajax({  
           //      url:"update.php",  
           //      method:"POST",  
           //      data:{employee_id:employee_id},  
           //      dataType:"json",  
           //      success:function(data){  
           //      	console.log(data.ID);
           //           $('#dateexpense').val(data.ExpenseDate);  
           //           $('#item').val(data.ExpenseItem);  
           //           $('#costitem').val(data.ExpenseCost);  
           //           $('#Quantity').val(data.Quantity);   
           //           $('#employee_id').val(data.ID);  
           //           $('#insert').val("Update");  
           //           $('#add_data_Modal').modal('show');  
           //      }  
  //          // });  
  //     });
 	// } );

	</script>
</body>
</html>
<?php } ?>
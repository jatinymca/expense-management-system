  <?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
include('includes/log.php');

if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$userid=$_SESSION['detsuid'];
$rowid=intval($_GET['delid']);



$sel="SELECT `ExpenseCost` FROM `tblexpense` WHERE ID='$rowid'";
$query=mysqli_query($con,$sel);
$row1=mysqli_fetch_array($query);  

// select money for updating
$select="SELECT `Money` as sum FROM `add_money`  where (UserId='$userid') ";
									$ret1=mysqli_query($con,$select);   
									$row2=mysqli_fetch_array($ret1);  

// update money before deleting itme
 $balance= $row1['ExpenseCost'] + $row2['sum']; 
                      	$Update="UPDATE `add_money` SET `Money`='$balance'  where (UserId='$userid')";
                      	mysqli_query($con,$Update);

// for delete row 
$del="delete from tblexpense where ID='$rowid'";
$query=mysqli_query($con,$del);

 
##################################################################################################
 		$log_msg = $del;
		wh_log("************** Start Log For Day : '" . $log_time . "'**********");
		wh_log($log_msg);
		wh_log("************** END Log For Day : '" . $log_time . "'**********");
##################################################################################################	 

if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}
  
if(isset($_POST['submit']))
  { 
  	 $userid=$_SESSION['detsuid'];
     $dateexpense=$_POST['dateexpense'];
     $id=$_POST['id'];
     $item=$_POST['item'];
     $costitem=$_POST['costitem'];
     $Quantity=$_POST['Quantity']; 

     	$select="SELECT `Money` as sum FROM `add_money`  where (UserId='$userid') ";
									$ret1=mysqli_query($con,$select);   
									$row1=mysqli_fetch_array($ret1);               
									              
                   $balance=$row1['sum']; 

      $sel="SELECT `ExpenseCost` FROM `tblexpense` WHERE ID='$id'";
			$query=mysqli_query($con,$sel);
			$row2=mysqli_fetch_array($query);
			$operation=$row2['ExpenseCost'];
			 

			// check that the user increment money or decrement money
                   if($costitem >=$operation) {//10>6=10-6=4
                   	$costitem1=$costitem-$operation;
                    $Closing_balance= $balance - $costitem1;}
                   else{
                   	$costitem1=$operation-$costitem;//5>10=8>10=2
                   	$Closing_balance= $balance + $costitem1;
                   } 

                  
     $Update="UPDATE `add_money` SET `Money`=' $Closing_balance'  where (UserId='$userid')";
                      	mysqli_query($con,$Update);


     $UPDATE="UPDATE `tblexpense` SET  `ExpenseItem`='$item',`ExpenseCost`= '$costitem',`Quantity`='$Quantity',`Closing_balance`='$Closing_balance'  WHERE  `ID`= '$id' ";
     $query=mysqli_query($con,$UPDATE );
##################################################################################################
 		$log_msg =  $UPDATE;
		wh_log("************** Start Log For Day : '" . $log_time . "'**********");
		wh_log($log_msg);                                                                            
		wh_log("************** END Log For Day : '" . $log_time . "'**********");                     
##################################################################################################	 
  
   
if($query){
echo "<script>alert('Record successfully Updated');</script>";
//echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}
  
}

  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Manage Expense</title>
	<!--link -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
 	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
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
							
							<div class="table-responsive">
            <table class="table table-bordered mg-b-0" id="example" >
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Expense Date</th>
                  <th>Expense Item</th>
                  <!-- <th>Opening balance</th> -->
                  <th>Expense Cost</th>
                  <th>Closing balance</th> 
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
              $userid=$_SESSION['detsuid'];
							$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid'");
							$cnt=1;
							while ($row=mysqli_fetch_array($ret)) { 
            ?>
                <tr>
                  <td><?php echo $cnt;?><input type="hidden" class="id" value="<?php  echo $cnt;?>"></td> 
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td><?php  echo $row['ExpenseCost'];?><input type="hidden" class="cost" value="<?php  echo $row['ExpenseCost'];?>"></td>
                  <td><?php  echo $row['Closing_balance'];?></td>
                  <td><?php  echo $row['Quantity'];?><input type="hidden" class="quantity" id="ii"  value="<?php  echo $row['Quantity'];?>"></td>
                  <td><a href="manage-expense.php?delid=<?php echo $row['ID'];?>"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash" aria-hidden="true"></i></a>  
                  <button type="button" class="   edit_data" id= "<?php echo $row['ID'];?>" data-toggle="modal" data-target="#exampleModal" style="display: contents;float: right; "><i class="fas fa-pencil-alt" style="margin-left: 20px;"></i></button>
                </tr>
                <?php 
									$cnt=$cnt+1;
									}?>
               
              </tbody>
            </table>
          </div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		</div><!-- /.row -->
	</div><!--/.main-->
			 
			 <!-- modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="manage-expense.php">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="text" id="dateexpense"  name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" id="item" required="true">
								</div>

						
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="number" id="costitem" required="true" name="costitem">
								</div>
										<input type="hidden" name="id" id="employee_id">	

								<div class="form-group">
									<label>Quantity</label>
									<input class="form-control" type="number" id="Quantity"    required="true" name="Quantity">
								</div>

								</div>
								
								<div class="modal-footer">
							      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							      <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
      							</div>
					 </form>
      </div>
      
    </div>
  </div>
</div>

<script>
     $(document).ready(function(){
    $('#example').dataTable();
   });

	$(document).ready(function(){ 
      $(document).on('click', '.edit_data', function(){  
           var employee_id = $(this).attr("id");  
           $.ajax({  
                url:"update.php",  
                method:"POST",  
                data:{employee_id:employee_id},  
                dataType:"json",  
                success:function(data){  
                	//console.log(data.ID);
                     $('#dateexpense').val(data.ExpenseDate);  
                     $('#item').val(data.ExpenseItem);  
                     $('#costitem').val(data.ExpenseCost);  
                     $('#Quantity').val(data.Quantity);   
                     $('#employee_id').val(data.ID);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });
 	});   
			
 </script>
 <script> 
	$('#ii').on('change',function(){
		   var cost=$('.cost').val();
	 	   var quantity=$('.quantity').val();
	 	   var total=0;
	 	   total=total+(cost*quantity);
	 	   console.log(total);
	})
 </script>	 

 	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>

 
</html>
<?php  wh_log($log_msg); }  ?>
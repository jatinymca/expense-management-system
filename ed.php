<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
	
	if(isset($_POST['submit'])){
		$fdate=$_POST['fdate'];
		$ldate=$_POST['ldate'];
		$select="SELECT ExpenseDate,ExpenseItem,ExpenseCost FROM `tblexpense` where (ExpenseDate BETWEEN '$fdate' and '$ldate')&& (UserId=12) group by ExpenseDate ";
		$que=mysqli_query($con,$select);
		//$res=mysqli_fetch_array($que);
		 
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>day report</title>
</head>
<body>
<div>
	<form method="post">
		from<input type="date" name="fdate"  ><br>
		to  <input type="date" name="ldate" ><br>
   		    <input type="submit" name="submit">
	</form>

	<table>
		<tr>
			<th>expense date</th>
			<th>item</th>
			<th>cost</th>
		</tr>
<?php 
  			while ($res=mysqli_fetch_array($que)) {
  			    
  		 	 
 ?>
		<tr>
			<th><?php echo $res['ExpenseDate'];  ?></th>
			<th> <?php echo $res['ExpenseItem'];  ?></th>
			<th><?php echo $t= $res['ExpenseCost'];  ?></th>
		</tr>
	<?php 
			$count+=$t;	
}
			echo"<th>".$count."</th>";	
 ?>
	</table>
</div>
</body>
</html>
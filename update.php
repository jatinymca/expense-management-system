  <?php  
 //fetch.php  
include('includes/dbconnection.php');  
 if(isset($_POST["employee_id"]))  
 {   
      $query = "SELECT * FROM tblexpense WHERE ID  = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);  
      $log_msg=$query;
      echo json_encode($row);  
 }  
 ?>
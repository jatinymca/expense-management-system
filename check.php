<?php 

session_start();
error_reporting(0);
include('includes/dbconnection.php');


if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

              $userid=$_SESSION['detsuid'];
           
                                    //date
                                        $fdate=$_SESSION['fdate'];
                                        $tdate=$_SESSION['tdate'];

                                      $Total_Cost=0;                  
                              $query=mysqli_query($con,"SELECT ExpenseDate,ExpenseItem,ExpenseCost,Quantity FROM `tblexpense` where (ExpenseDate BETWEEN '$fdate' and '$tdate')&& (UserId='$userid')   ORDER BY ExpenseDate ASC");
                                while ($result=mysqli_fetch_array($query)) {

                                    $ExpenseDate=$result[0];
                                    $ExpenseItem=$result[1];
                                    $ExpenseCost=$result[2];
                                    $Quantity=$result[3];
                                    $Total_Cost+=$ExpenseCost;
                                    $export[]=array('ExpenseDate'=>$ExpenseDate,'ExpenseItem'=>$ExpenseItem,'ExpenseCost'=>$ExpenseCost,'Quantity'=>$Quantity); 
                                }
                                $export[]=array("a"=>"","s"=>"Total_Cost","Total"=>$Total_Cost);
 
                                $Array=array('Date','Item','Cost','Quantity');
                                header('Content-Type: text/csv; charset=utf-8');
                                header('Content-Disposition: attachment; filename=report.csv');
                                                        $output = fopen('php://output', 'w' );
                                fputcsv($output,$Array);
                                    
                                     foreach($export as $data){
                                                        fputcsv($output, $data);
                                                          }
                                fclose($output);
                                
}
?>
 
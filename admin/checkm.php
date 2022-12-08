<?php 

session_start();
error_reporting(0);
include('includes/dbconnection.php');


if (strlen($_SESSION['detsuid1']==0)) {
  header('location:logout.php');
  } else{

                                   $userid=$_SESSION['userid'];
           
                                    //date
                                        $fdate=$_SESSION['fmonth'];
                                        $tdate=$_SESSION['tmonth'];

                              $query=mysqli_query($con,"SELECT ExpenseDate,ExpenseCost,ExpenseItem,Quantity, month(ExpenseDate) as rptmonth,year(ExpenseDate) as rptyear FROM tblexpense  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid')   ORDER BY ExpenseDate,rptmonth,rptyear ASC");
                                      $Total_Cost=0;                  
                                while ($result=mysqli_fetch_array($query)) {

                                    $ExpenseDate=$result[0];
                                    $ExpenseCost=$result[1];
                                    $ExpenseItem=$result[2];
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
 
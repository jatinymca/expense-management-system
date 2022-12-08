<?php 

session_start();
error_reporting(0);
include('includes/dbconnection.php');


if (strlen($_SESSION['detsuid1']==0)) {
  header('location:logout.php');
  } else{

              $userid=$_SESSION['userid'];
           
                                    //date
                                        $fdate=$_SESSION['fdate'];
                                        $tdate=$_SESSION['tdate'];

                              $query=mysqli_query($con,"SELECT tbluser.ID as t1 ,tbluser.FullName as t3 ,ExpenseDate, month(ExpenseDate), year(ExpenseDate),SUM(ExpenseCost) as t2 from tbluser INNER JOIN tblexpense ON tbluser.ID = tblexpense.UserId  where (ExpenseDate BETWEEN '$fdate' and '$tdate')  GROUP BY FullName");
                                      $Total_Cost=0;                  
                                      $S_no=1;                  
                                while ($result=mysqli_fetch_array($query)) {
                                     $S_no= $S_no;
                                    $Name=$result[1];
                                    $Cost=$result[5];
                                    //$ExpenseCost=$result[2];
                                   // $Quantity=$result[3];
                                    $Total_Cost+=$Cost;
                                    $export[]=array('S_NO'=>$S_no,'Name'=>$Name,'Cost'=>$Cost); 
                                    $S_no++;
                                }
                                
                                $export[]=array("a"=>"","s"=>"Total_Cost","Total"=>$Total_Cost);
 
                                $Array=array('S_NO','Name','Cost');
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
 
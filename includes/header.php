<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
       
?>
 
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header" style="padding: 12px;">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=" #sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                     <!-- <img src="assets/images/vertage.jpg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
                
                <a class="navbar-brand" href="dashboard.php" style="position:absolute;padding: initial;">Vert-age</a>
                <?php 

                    $userid=$_SESSION['detsuid'];
                 $select="SELECT `Money` as sum FROM `add_money`  where (UserId='$userid') ";
                                    $ret1=mysqli_query($con,$select);   
                                    $row1=mysqli_fetch_array($ret1);   ?>
                <p style="float: right;color: antiquewhite;">Total Balance: <?php  echo $row1['sum']; ?></p>
            </div>
            
        </div>
        
    </nav>

     
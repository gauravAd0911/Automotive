<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VPS</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<script>
function search(a){
      window.location.href='custhome.php?area='+a;
}

function park(p){
    window.location.href='custhome.php?type='+p;
}
</script>
<body>
    <?php
     session_start();
if($_SESSION['id']==null){
    header('location:user.php');
}

    ?>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">VPS</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
      <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a href="custhome.php"><i class=""></i>Home</a>
                    </li>
                    <li>
                        <a class="active-menu" href="booking.php"><i class=""></i>View Booking</a>
                    </li>
                     <li>
                        <a  href="editpassword.php"><i class=""></i>Change Password</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <center>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Booking</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
                
                <?php
                    include 'dbconnection.php';                
                    $query="select * from tblbooking,tblslots where tblbooking.username='{$_SESSION['id']}' and tblslots.id=tblbooking.id";                    
                    $result=mysqli_query($link,$query) or die(mysqli_error($link));
                    if(mysqli_num_rows($result)>0){
                    ?>
                    <form name="f" method="post" action="">
                        <table class="table" style="background-color: black;" width="40%">
                            <thead align="center" style="font-weight: bold"><tr>
                                <td>Vehicle Type</td>
                                <td>Vehicle No</td>
                                <td>Booking Time</td>
                                <td>Process</td>
                                <td>Cancel Booking</td></tr>
                            </thead>
            <?php
                 while ($row=mysqli_fetch_assoc($result)){
                 ?>
                    <tr>
                        <td><?php echo $row['vehicletype'] ?></td>
                        <td align='center'><?php echo $row['vehicleno'] ?></td>
                        <td align='center'><?php $orgDate = $row['starttime'];
                              $newDate = date("d-M-Y h:i A", strtotime($orgDate));  
                              echo $newDate; ?></td>
                        <td align='center'><a href='booking.php?bid=<?php echo $row['bookid'] ?>'>View</a></td>
                        <td align='center'><a href='booking.php?id=<?php echo $row['bookid'] ?>' onclick="return confirm('Do you really want to delete the booking');"><img src='images/discard.gif' width='24px' height='24px'/></a></td>
                    </tr>
                 <?php
                 }
                    }else{
                        echo "No booking available. To book slot <a href='custhome.php'>click here</a>";
                 ?>
                </table>
                </form>
                
            <?php  
                }
                if(isset($_GET['bid'])){
        $service="";
        $query="select * from tblprocess where bid='{$_GET['bid']}'";
        $result= mysqli_query($link, $query);
        if(mysqli_num_rows($result)>0){
            $row= mysqli_fetch_assoc($result);
            $service=$row['service'];
        }
    ?>
    <form name="ff" method="post" action="">
        <table>
            <tr><td>Booking ID:</td><td><input type="text" class="form-control" value="<?php echo $_GET['bid']; ?>" name="no" size="35" readonly/></td></tr>
            <tr><td>Service Undergoing:</td><td><textarea class="form-control" name="service" size="35" readonly><?php echo $service; ?></textarea></td></tr>
        </table>
    </form>
<?php 
}                
                if(isset($_GET['id'])){
                    $query="delete from tblbooking where bookid='{$_GET['id']}'";
                    $result=mysqli_query($link,$query);
                    if(mysqli_affected_rows($link)>0){
                        echo "<script> window.location.href='booking.php'</script>";
                    }else{
                        echo "Booking cannot be canceled at this time. Please try later";
                    }
                }
                ?>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        </center>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>

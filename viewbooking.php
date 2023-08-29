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
<body>
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
        <?php
      session_start();
      echo "Welcome : ".$_SESSION['name'];
      ?>
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
                        <a href="slot.php"><i class=""></i>Add Slots</a>
                    </li>
                    <li>
                        <a  href="direct.php"><i class=""></i>Direct Booking</a>
                    </li>
                    <li>
                        <a  class="active-menu" href="userhome.php"><i class=""></i>View Booking</a>
                    </li>
                     <li>
                        <a  href="billing.php"><i class=""></i>Generate Bill</a>
                     </li>
<!--                     <li>
                         <a  href="billreport.php"><i class=""></i>Billing Report</a>
                    </li>-->
                    <li>
                        <a  href="edit1.php"><i class=""></i>Change Password</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Today's Booking</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />      
                <h1>Bookings</h1>
                  <?php 
                  
if($_SESSION['id']==null){
    header('location:index.php');
}

include 'dbconnection.php';
$dt=date('Y-m-d');
$query="select distinct(id) as id,type from tblslots where username='{$_SESSION['id']}'";
$result=mysqli_query($link,$query);
while ($row=mysqli_fetch_assoc($result)){    
    $query="select * from tblbooking where id='{$row['id']}' and arrived='N'";
    $res=mysqli_query($link,$query);
    if(mysqli_num_rows($res)>0){
        $sl=1;
    echo "<br/><table width='60%' border='1px;'><thead align='center' style='font-weight: bold'>
        <tr><td>{$row['type']}</td>
        <td>Username</td>
        <td>Booking Date</td>
        <td>Vehicle No</td>
        <td>Time</td>
        <td>Arrived</td>
        <td>Cancel Booking</td></tr></thead>";
        while($r=mysqli_fetch_assoc($res)){
            echo "<tr><td>$sl</td>
                      <td>{$r['username']}</td>
                      <td>{$r['starttime']}</td>
                      <td>{$r['vehicleno']}</td>
                      <td>{$r['starttime']}</td>
                      <td align='center'><a href='userhome.php?bid={$r['bookid']}'><img src='images/in.png' width='24px;' height='20px;'></a></td>
                      <td align='center'><a href='userhome.php?del={$r['bookid']}'><img src='images/discard.gif' width='24px;' height='20px;'></a></td></tr>";
            $sl++;
        }
    }
    echo "</table>";
}

if(isset($_GET['bid'])){
    $query="update tblbooking set starttime=now(),arrived='Y' where bookid='{$_GET['bid']}'";
    $result=mysqli_query($link,$query);
    echo "<script> window.location.href='userhome.php' </script>";
}

if(isset($_GET['del'])){
    $query="delete from tblbooking where bookid='{$_GET['del']}'";
    $result=mysqli_query($link,$query);
    echo "<script> window.location.href='userhome.php' </script>";
}
?>
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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
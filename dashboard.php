<?php       session_start();
    include 'dbconnection.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VPS</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style1.css" rel="stylesheet" />
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
      echo "Welcome : ".$_SESSION['name'];
      ?>
      <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <?php include 'sidebar.php'; ?>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Online Booking</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <hr />      
                     
                <div class="col-lg-4 col-sm-6" style="width: 300px;">
                        <div class="card gradient-2">                            
                            <div class="card-body" style="background-color:#beb1ff; ">
                                <h3 class="card-title text-success"><center>Total staff</center></h3>
                                <div class="d-inline-block"><center>
                                   <?php
                                        $query="select count(*) as cnt from tblengg where garage='{$_SESSION['id']}'";
                                        $result= mysqli_query($link, $query);
                                        $row= mysqli_fetch_assoc($result);
                                   ?>
                                        <h2 class="text-dribbble" style="color:black"><?php echo $row['cnt']; ?></h2>
                                </div></center>
                            </div>
                        </div>
                    </div>
                
                <div class="col-lg-4 col-sm-6" style="width: 300px;">
                        <div class="card gradient-2">                            
                            <div class="card-body"  style="background-color:#beb1ff;">
                                <h3 class="card-title text-success"><center>Online Bookings</center></h3>
                                <div class="d-inline-block"><center>
                                   <?php
                                        $query="select count(*) as cnt from tblbooking where booktype='online' and arrived='N' and garage='{$_SESSION['id']}'";
                                        $result= mysqli_query($link, $query);
                                        $row= mysqli_fetch_assoc($result);
                                   ?>
                                        <h2 class="text-dribbble" style="color:black"><?php echo $row['cnt']; ?></h2>
                                </div></center>
                            </div>
                        </div>
                    </div>
              
                <div class="col-lg-4 col-sm-6" style="width: 300px;">
                        <div class="card gradient-2">                            
                            <div class="card-body" style="background-color:#beb1ff;">
                                <h3 class="card-title text-success"><center>Direct Booking</center></h3>
                                <div class="d-inline-block"><center>
                                   <?php
                                        $query="select count(*) as cnt from tblbooking where booktype='offline' and arrived='Y' and endtime like '%0000%' and garage='{$_SESSION['id']}'";
                                        $result= mysqli_query($link, $query);
                                        $row= mysqli_fetch_assoc($result);
                                   ?>
                                        <h2 class="text-dribbble"style="color:black"><?php echo $row['cnt']; ?></h2></center>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="col-lg-4 col-sm-6" style="width: 300px; margin-top: 22px;">
                        <div class="card gradient-2">                            
                            <div class="card-body" style="background-color:#beb1ff;">
                                <h3 class="card-title text-success"><center>Under Service</center></h3>
                                <div class="d-inline-block"><center>
                                   <?php
                                        $query="select count(*) as cnt from tblbooking where arrived='Y' and endtime like '%0000%' and garage='{$_SESSION['id']}'";
                                        $result= mysqli_query($link, $query);
                                        $row= mysqli_fetch_assoc($result);
                                   ?>
                                        <h2 class="text-dribbble"style="color:black"><?php echo $row['cnt']; ?></h2>
                                        </center>
                                </div>
                            </div>
                        </div>
                    </div>
              
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
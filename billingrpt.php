<?php session_start(); ?>
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
    <?php
     
if($_SESSION['id']==null){
    header('location:index.php');
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
                     <h2>View Booking</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr /><center>
                    
                    <form name="f" method="post" action="">
                        <table><tr><td><label>Start Date:</td></label><td><input type="date" class='form-control' name="dt1" style="width: 250px;" required/></td></tr>
                        <tr><td><label>End Date:</td></label><td><input type="date" class='form-control' name="dt2" size="50" required/></td></tr>
                        <tr><td></td><td>&nbsp;<input type="submit" class='btn btn-primary' name="click" value="Get Report"/></td></td></tr>
                        </table>
                    </form><br/><br/>
                    
 <?php
 
    if(isset ($_REQUEST['click'])){
        include 'dbconnection.php';
        $sum=0;
?>
    <table border="1px;" style="width: 80%; background-color: #39454dc2;">
        <tr><th style="color: #45d863;">Booking No.</th>
            <th style="color: #45d863;">Bill No</th>
            <th style="color: #45d863;">Bill Date</th>
            <th style="color: #45d863;">Bill Amount</th>            
        </tr>
    <?php
          $query="select * from tblbill where dtdate between '{$_POST['dt1']}' and '{$_POST['dt2']}'";
          $result= mysqli_query($link, $query);
          while($row= mysqli_fetch_assoc($result)){
              $query="select sum(rate) as amt from tblbilllist where billno='{$row['billno']}'";
              $result1= mysqli_query($link, $query);
              $row1= mysqli_fetch_assoc($result1); ?>
                <tr>
                    <td><?php echo $row['bookid']; ?></td>
                    <td><?php echo $row['billno']; ?></td>
                    <td><?php echo $row['dtdate']; ?></td>
                    <td><?php echo $row1['amt']; ?></td>
                </tr>
        <?php
          }
    }
?>
    </table>
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

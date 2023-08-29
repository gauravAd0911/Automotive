<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VPS</title>
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
                <?php include 'sidebar.php'; ?>
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Servicing</h2>   
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
   
    $query="select * from tblbooking where engg='{$_SESSION['id']}' and arrived='Y'";    
    $res=mysqli_query($link,$query);
    if(mysqli_num_rows($res)>0){
        $sl=1;
    echo "<br/><table class='table' style='background-color: #FFF;'><thead style='font-weight: bold'>
        <td>SL</td>
        <td>Vehicle No</td>
        <td>Service Type</td>
        <td>Add Details</td></tr></thead>";
        while($r=mysqli_fetch_assoc($res)){
            echo "<tr><td>$sl</td>
                      <td>{$r['vehicleno']}</td>
                      <td>{$r['issue']}</td>
                      <td><a href='addservice.php?bid={$r['bookid']}'>Add Service</a></td></tr>";
            $sl++;
        }
    }
    echo "</table>";

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
            <tr><td>Service:</td><td><textarea class="form-control" name="service" size="35" ><?php echo $service; ?></textarea></td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Add Service" style="width: 120px;"/></td></tr>
        </table>
    </form>
<?php 
}
if(isset($_REQUEST['save'])){
    $query="select * from tblprocess where bid='{$_GET['bid']}'";
    $result= mysqli_query($link, $query);
    if(mysqli_num_rows($result)>0){
        $query="update tblprocess set service='{$_POST['service']}' where bid='{$_POST['no']}'";
        $result=mysqli_query($link,$query);
        echo "<script> alert('Service added'); 
                       window.location.href='addservice.php'; </script>";
    }else{
        $query="insert into tblprocess(bid,service) values('{$_POST['no']}','{$_POST['service']}')";
        $result= mysqli_query($link, $query);
        if($result){
            echo "<script> alert('Service added'); 
                       window.location.href='addservice.php'; </script>";
        }else{
            echo "Error"; 
        }
    }
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
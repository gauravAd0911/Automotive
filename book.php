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
                        <a  href="booking.php"><i class=""></i>View Booking</a>
                    </li>
                     <li>
                        <a  href="editpassword.php"><i class=""></i>Change Password</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
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
          if(isset($_GET['id'])){
              $query="select * from tblslots where id='{$_GET['id']}'";
              $result=  mysqli_query($link,$query);
              $row=  mysqli_fetch_array($result);
   ?>
                <form name="f" action="" method="post">
        <table>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
            <tr><td>Vehicle Type:&nbsp;</td><td><input type="text" class="form-control" name="type" value="<?php echo $row['type'] ?>" size="35" readonly/></td></tr>
            <tr><td>Vehicle No:</td><td><input type="text" class="form-control" name="no" size="35" required/></td></tr>
            <tr><td>Date:</td><td><input type="date" class="form-control" name="date" size="35" required /></td></tr>
            <tr><td>Time:</td><td><input type="time" class="form-control" name="time" size="35" required /></td></tr>
            <tr><td>Issue:</td><td><textarea name="issue" class="form-control" required></textarea> </td></tr><tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Book" style="width: 120px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" style="width: 120px;" value="Reset"/></td></tr>
        </table>
    </form>
 <?php  
          }
          
if(isset($_REQUEST['save'])){
    $dt=$_POST['date']." ".$_POST['time'];
    
    $q=mysqli_query($link,"select * from tblbooking where id='{$_POST['id']}' and vehicleno='{$_POST['no']}' and starttime='$dt'");
    if(mysqli_num_rows($q)>0){
        echo "<script> alert('Slot already booked for the vehicle') </script>";
        die();
    }
    
    $res=mysqli_query($link,"select count(*) as cnt from tblbooking where id='{$_POST['id']}' and vehicletype='{$_POST['type']}' and starttime like '$dt%' and arrived<>'O'");
    $res1=mysqli_query($link,"select * from tblslots where id='{$_POST['id']}' and type='{$_POST['type']}'");
    $r=mysqli_fetch_assoc($res);
    $r1=mysqli_fetch_assoc($res1);
        if($r['cnt']<=$r1['slots']){
            $query="select * from tblbooking where vehicleno='{$_POST['no']}' and starttime like '{$_POST['date']}%' and arrived='N'";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                die("<br/>Slots already is booked for vehicle with no <b>".$row['vehicleno']."</b> at <b>".$row['starttime']."</b>");
            }
            $query="insert into tblbooking(id,username,vehicletype,booktype,vehicleno,starttime,endtime,arrived,issue,garage) values('{$_POST['id']}','{$_SESSION['id']}','{$_POST['type']}','online','{$_POST['no']}','$dt','','N','{$_POST['issue']}','{$r1['username']}')";
            $result=mysqli_query($link,$query) or die(mysqli_error());
            if($result){
                echo "<script>window.location.href='booking.php'</script>";
            }else{
                echo "error";
            }
        }else{
            echo "<script> alert('Slots are full.');</script>";
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
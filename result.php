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
                        <a class="active-menu" href="result.php"><i class=""></i>View Booking</a>
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
                     <h2>View Booking</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />
                <table border="1px;" width="30%">
                    <tr><thead align="center"><td><strong>Type</strong></td>
                    <td><strong>Marks</strong></td></thead></tr>
                    
 <?php
     session_start();
if($_SESSION['id']==null){
    header('location:index.php');
}

include 'dbconnection.php';
$sum=0;
$result=  mysqli_query($link,"Select marks from up_files where ftype='Synopsis' and usn='{$_SESSION['id']}'");
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo "<tr><td>Synopsis</td><td align='center'>{$row['marks']}</td></tr>";
    $sum=$sum+$row['marks'];
}else{
    echo "<tr><td>Synopsis </td><td align='center'>Yet to Upload</td></tr>";
}

$result=  mysqli_query($link,"Select marks from up_files where ftype='Phase 1' and usn='{$_SESSION['id']}'");
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo "<tr><td>Phase 1 </td><td align='center'>{$row['marks']}</td></tr>";
    $sum=$sum+$row['marks'];
}else{
    echo "<tr><td>Phase 1 </td><td align='center'>Yet to Upload</td></tr>";
}

$result=  mysqli_query($link,"Select marks from up_files where ftype='Phase 2' and usn='{$_SESSION['id']}'");
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo "<tr><td>Phase 2 </td><td align='center'>{$row['marks']}</td></tr>";
    $sum=$sum+$row['marks'];
}else{
    echo "<tr><td>Phase 2 </td><td align='center'>Yet to Upload</td></tr>";
}

$result=  mysqli_query($link,"Select marks from up_files where ftype='Project Report' and usn='{$_SESSION['id']}'");
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo "<tr><td>Project Report </td><td align='center'>{$row['marks']}</td></tr>";
    $sum=$sum+$row['marks'];
}else{
    echo "<tr><td>Project Report </td><td align='center'>Yet to Upload</td></tr>";
}

$result=  mysqli_query($link,"Select marks from up_files where ftype='Project Code' and usn='{$_SESSION['id']}'");
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo "<tr><td>Project Code </td><td align='center'>{$row['marks']}</td></tr>";
    $sum=$sum+$row['marks'];
}else{
    echo "<tr><td>Project Code </td><td align='center'>Yet to Upload</td></tr>";
}
    echo "<tr><td>Total </td><td align='center'>$sum</td></tr>";
    
    
    echo "</table><br/>";
    
        $result=mysqli_query($link,"select count(*) as c from up_files where usn='{$_SESSION['id']}'") or die(mysqli_error());
        $r=mysqli_fetch_assoc($result);
        if($r['c']==0){
            echo "<br/>Submitted<br/><img src='images/p0.png'/>";
        }
        else if($r['c']==1){
            echo "<br/>Submitted<br/><img src='images/p20.png'/>";
        }
        else if($r['c']==2){
            echo "<br/>Submitted<br/><img src='images/p40.png'/>";
        }
        else if($r['c']==3){
            echo "<br/>Submitted<br/><img src='images/p60.png'/>";
        }
        else if($r['c']==4){
            echo "<br/>Submitted<br/><img src='images/p80.png'/>";
        }
        else if($r['c']==5){
            echo "<br/>Submitted<br/><img src='images/p100.png'/>";
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
<?php                session_start();
?>
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
      window.location.href='index.php?area='+a;
}

function park(p){    
    window.location.href='index.php?type='+p;
}
</script>
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
                <a class="navbar-brand" href="index.html">VPS</a> 
            </div><br/>
           <center> <font Color="Orange"><i>Online Garage Booking</i></font></center>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
<!--      <a href="#" class="btn btn-danger square-btn-adjust">Logout</a> </div>-->
        </nav>   
           <!-- /. NAV TOP  -->
         <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
			</li>
                    <li>
                        <a href="admin.php"><i class=""></i>Admin/Garage Login</a>
                    </li>
                    <li>
                        <a  href="user.php"><i class=""></i>User Login</a>
                    </li>
                </ul>
            </div>           
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12" style="background-color:black">
                     <center><h2>Online Garage Booking</h2>   </center> 
                        <h5></h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                <hr />    
                
                <center>
    <form name="f" action="" method="post">
        <table>
            <?php
                if(isset($_GET['area'])){
                    $_SESSION['area']=$_GET['area'];
            ?>
            <tr><td>Area: &nbsp;</td><td><select name="area" onchange="javascript: search(this.value)" class="form-control" id="area">
                                            <option><?php echo $_SESSION['area'] ?></option>
            <?php
                }
                else if(isset($_GET['type'])){
            ?>
            <tr><td>Area: &nbsp;</td><td><select name="area" onchange="javascript: search(this.value)" class="form-control" id="area" >
                                            <option><?php echo $_SESSION['area'] ?></option>
            <?php
                }
                else{
                ?>    
                <tr><td>Area: &nbsp;</td><td><select name="area" onchange="javascript: search(this.value)" class="form-control" id="area" >
                                            <option>Select Area</option>
                  <?php
                } 
                ?> 
                                            <option>Angol</option>
                                            <option>Auto Nagar</option>
                                            <option>Belgaum City</option>
                                            <option>Hindwadi</option>
                                            <option>Mahantesh Nagar</option>
                                            <option>Nehru Nagar</option>
                                            <option>Shahapur</option>
                                            <option>Tilakwadi</option>
                                            <option>Udyambag</option>
                                            <option>Vadgaon</option>
                                    </select></td></tr><tr><td>&nbsp;</td></tr>              
        </table>      
        </form>
        </center>
                
                <?php
                include 'dbconnection.php';
                
                if(isset($_GET['area'])){           
                    $query="select distinct(address) as addr,username from tblslots where area='{$_GET['area']}'";
                    $result=mysqli_query($link,$query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $query="select name from tbluser where username='{$row['username']}'";
                        $result1=mysqli_query($link,$query);
                        $row1= mysqli_fetch_assoc($result1);
                        echo "<br/><input type='submit' style='width:auto;'value='{$row1['name']} - {$row['addr']}' onclick='javascript: park(this.value)' style='width: 250px;' class='btn btn-primary'/><br/>";
                    }
                }
                
                if(isset ($_GET['type'])){  
                    $name= explode("- ", $_GET['type']);
                    $t=$name[1];
                    $i=1;
                    $query="select * from tblslots,tbluser where tblslots.address='$t' and tblslots.area='{$_SESSION['area']}' and tbluser.username=tblslots.username";
                    $result=mysqli_query($link,$query) or die(mysqli_error());
                    $row= mysqli_fetch_assoc($result);
                    //$t=$row['slots'];                    
                    ?>
                <br/><b>Slots availability at <?php echo $row['name']." - ".$t; ?> details are listed below</b><br/><br/>
                    <form name="f" method="post" action="">
                <table border="1px;" width="40%">
                    <thead align="center" style="font-weight: bold"><tr>
                        <td>Vehicle Type</td>
                        <td>Available Slots</td>
                        <td>Book</td></tr>
                    </thead>
            <?php $result=mysqli_query($link,$query);
                 while($row=mysqli_fetch_assoc($result)){
                        $dt=date('Y-m-d');
                        $query="select count(*) as cnt from tblbooking where id='{$row['id']}' and vehicletype='{$row['type']}' and starttime like '$dt%' and arrived='B'";
                        $res=mysqli_query($link,$query) or die(mysqli_error());
                        if(mysqli_num_rows($res)>0){
                            $row1=mysqli_fetch_assoc($res);
                            $slots=$row['slots']-$row1['cnt'];
                        }
                 ?>
                    <tr>
                        <td><?php echo $row['type'] ?></td>
                        <td align='center'><?php echo $slots ?></td>
                        <?php
                        if($slots>0){
                            ?>                        
                        <td align='center'><a
                            href='book.php?id=<?php echo $row['id'] ?>'><img src='images/bill.ico' width='24px' height='24px'/></a></td>
                            <?php
                        }
                        ?>
                    </tr>
                 <?php
                 }
                 ?>
                </table>
                </form>
            <?php  
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

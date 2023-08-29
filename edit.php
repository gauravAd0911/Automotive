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
function validate(){
    
if(document.f.p1.value!=document.f.p2.value){
    alert("Password do not match");
    return false;
}
        return true;
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
                <a class="navbar-brand" href="#">VPS</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">
      <?php
      session_start();
      echo "Welcome : ".$_SESSION['id'];
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
                        <a href="newuser.php"><i class=""></i>Add New Garage</a>
                    </li>
                    <li>
                        <a  href="userlist.php"><i class=""></i>List Garages</a>
                    </li>
                     <li>
                        <a class="active-menu" href="edit.php"><i class=""></i>Change Password</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Change Password</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
                     <form name="f" method="post" action="editpass.php" onsubmit="javascript:return validate();">
     <table>
                
<?php

include 'dbconnection.php';
if($_SESSION['id']==null){
    header('location:index.php');
}
else{
    echo "<tr><td>User Name:</td><td><input type='text' class='form-control' name='name' value='{$_SESSION['id']}' size='35' readonly='true'/></td></tr>";
    echo "<tr><td>Old Password</td><td><input type='password' class='form-control' name='pass' size='35' required='required'/></td></tr>";
    echo "<tr><td>New Password</td><td><input type='password' class='form-control' name='p1' size='35' required='required'/></td></tr>";
    echo "<tr><td>Confirm Password</td><td><input type='password' class='form-control' name='p2' size='35' required='required'/></td></tr>";
}

?>
         <tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td><td><input type="submit" value="Change Password" class='btn btn-primary'/></td></tr>
         
</table>
         
</form>
        <?php
        if(isset($_GET['msg'])) { 
             if($_GET['msg'] == 4) { 
                echo 'Old password does not match'; 
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

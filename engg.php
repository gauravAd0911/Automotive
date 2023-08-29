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

<script>
function validate(){
    
if(document.f.pass.value!==document.f.cpass.value){
    alert("Password do not match");
    return false;
}

        return true;
}    
</script>
<body >
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
        echo "Welcome : ".$_SESSION['id'];
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
                     <h2>Add New Service Engineer</h2>   
                    </div>
                </div>              
                <hr/>                
                    <?php 
            
            if($_SESSION['id']==null){
                header('location:index.php');
            }
        ?>
        <form name="f" method="post" action="" onsubmit="javascript:return validate();">
        <table style=" background-color: black; border-radius:5px;">
            <tr><td>Engineer Name:</td><td><input type="text" class="form-control" pattern="[A-Za-z/ /]+" name="name" size="35" required="required"/></td></tr>
            <tr><td>UserName: &nbsp;</td><td><input type="text" class="form-control" name="user" size="35" required="required"/></td></tr>
            <tr><td>Password :</td><td><input type="password" class="form-control" name="pass" size="35" required="required"/></td></tr>
            <tr><td>Confirm Password :</td><td><input type="password" class="form-control" name="cpass" size="35" required="required"/></td></tr>
            <tr><td></td><td><input type="submit" name="sub" class="btn btn-primary" value="Submit"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset"  class="btn btn-primary" value="Reset" required="required"/></td></tr>
        </table>
        </form>
        
        
        <?php
        if(isset($_REQUEST['sub'])){
            include 'dbconnection.php';

$user=$_POST['user'];
$pass=$_POST['pass'];
$name=$_POST['name'];

$query="select * from tblengg where username='$user'";
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    header('location:engg.php?msg=1');
}
else{
$query="insert into tblengg(name,username,password,garage) values('$name','$user','$pass','{$_SESSION['id']}')";
$result=mysqli_query($link,$query);
if($result){
       echo "<script> window.location.href='engg.php?msg=2'; </script>";
}
else{
        echo "<script> window.location.href='engg.php?msg=5'; </script>";
    }
}
        }
        
        if(isset($_GET['msg'])) { 
            if($_GET['msg'] == 1) { 
                echo 'Username already present. Please try with another one.'; 
            }
            else if($_GET['msg'] == 2) { 
                echo 'New employee details added successfully'; 
            }
            else if($_GET['msg'] == 5) { 
                echo 'Information cannot be added at this time. Please try later'; 
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
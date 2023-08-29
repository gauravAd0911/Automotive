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
      if($_SESSION['id']==null){
          header("location:index.php");
      }
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
                     <h2>Add New Service</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
      <?php 
        
           if($_SESSION['id']==null){
            header('location:index.php');
            }
        ?>
        <form name="f" method="post" action="" onsubmit="javascript:return validate();">
            <table cellpading="40">
            <tr><td>Service Name: </td><td><input type="text" class="form-control" name="name" size="30" required="required"/></td></tr>
            <tr><td>Rate: &nbsp;</td><td><input type="text" pattern="[0-9]+" class="form-control" name="total" size="30" required="required"/></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Submit"/>&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" value="Reset" required="required"/></td></tr>
        </table>
        </form>
        <center>
        
        <?php
        include 'dbconnection.php'; 
        
        $query="select * from tblservice where username='{$_SESSION['id']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            ?>
                <br/><br/><form name="f" method="post" action="">
                    <table class="table" style="width: 50%; background-color: #000000db;">
                    <thead align="center" style="font-weight: bold"><tr>
                        <td>Service Name</td>
                        <td>Price</td>
                        <td>Delete</td></tr>
                    </thead>
            <?php
                 while ($row=  mysqli_fetch_assoc($result)){
                 ?>
                    <tr>
                        <td><?php echo $row['service'] ?></td>
                        <td align='center'><?php echo $row['rate'] ?></td>
                        <td align='center'><a href='service.php?del=<?php echo $row['id'] ?>' onclick="return confirm('Do you want to delete');"><img src='images/discard.gif' width='24px' height='24px'/></a></td>
                    </tr>
                 <?php
                 }
                 ?>
                </table>
                </center>
                </form>
   <?php                    
        }
        
        if(isset($_REQUEST['save'])){
            $service=$_POST['name'];
            $total=$_POST['total'];

            $query="select * from tblservice where username='{$_SESSION['id']}' and service='$service'";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                die("Service already added for ".$service);
            }

//            $query="select * from tbluser where username='{$_SESSION['id']}'";
//            $result=mysqli_query($link,$query);
//            if(mysqli_num_rows($result)>0){
//                $row=mysqli_fetch_assoc($result);
//            }

            $query="insert into tblservice(service,rate,username) values('$service','$total','{$_SESSION['id']}')";
            $result=mysqli_query($link,$query);
            if($result){
                echo "<script> window.location.href='service.php'</script>";
            }
            else{
                echo "Service cannot be added at this time";
             }   
        }



if(isset($_GET['del'])){
    $result=mysqli_query($link,"delete from tblservice where id='{$_GET['del']}'");
    if(mysqli_affected_rows($link)>0){
        echo "<script> window.location.href='service.php' </script>";
    }else{
        echo "Service cannot be deleted please try later";
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

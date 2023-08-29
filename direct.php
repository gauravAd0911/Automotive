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
      include 'dbconnection.php'; 
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
                     <h2>Booking</h2>   
                    </div>
                </div>              
                <hr/>          
                
                <!-- /.Add Details of Vehicle -->
        <center> 
    <form name="f" action="" method="post">
        <table>
            <tr><td>Vehicle Type:&nbsp;</td><td><select class="form-control" name="type">
                    <option>Two Wheeler</option>
                    <option>Four Wheeler</option></select></td></tr>
            <tr><td>Vehicle No:</td><td><input type="text" class="form-control" name="no" size="35" required/></td></tr>
            <tr><td>Issue:</td><td><textarea name="issue" class="form-control" required></textarea> </td></tr><tr><td>&nbsp;</td></tr>
            <tr><td>Engineer:</td><td><select name="engg" class="form-control">
                            <?php
                                $query="select username from tblengg where garage='{$_SESSION['id']}'";                                
                                $result= mysqli_query($link, $query) or die(mysqli_error($link));
                                while($row= mysqli_fetch_assoc($result)){
                                    echo "<option>{$row['username']}</option>";
                                }
                            ?>
                    </select> </td></tr><tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Book" style="width: 120px;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" style="width: 120px;" value="Reset"/></td></tr>
        </table>
    </form>
    </center>
 <?php  
          
if(isset($_REQUEST['save'])){
       
    $query=mysqli_query($link,"Select id from tblslots where type='{$_POST['type']}' and username='{$_SESSION['id']}'") or die(mysqli_error());
    if(mysqli_num_rows($query)>0){
        $id=mysqli_fetch_assoc($query);
    }
    else{
        die("Slots for {$_POST['type']} is not added in your garage");
    }
    
    $dt=date('Y-m-d');
    
    $res=mysqli_query($link,"select count(*) as cnt from tblbooking where id='{$id['id']}' and vehicletype='{$_POST['type']}' and starttime like '$dt%' and arrived<>'O'");
    $res1=mysqli_query($link,"select slots from tblslots where id='{$id['id']}' and type='{$_POST['type']}'");
    
    $r=mysqli_fetch_assoc($res);
    $r1=mysqli_fetch_assoc($res1);

        if($r['cnt']<=$r1['slots']){
             $query="select * from tblbooking where vehicleno='{$_POST['no']}' and starttime like '$dt%' and arrived='Y'";
            $result=mysqli_query($link,$query);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                die("<br/>Slots already is booked for vehicle with no <b>".$row['vehicleno']."</b> at <b>".$row['starttime']."</b>");
            }
                $query="insert into tblbooking(id,username,vehicletype,booktype,vehicleno,starttime,endtime,arrived,issue,garage,engg) values('{$id['id']}','{$_SESSION['id']}','{$_POST['type']}','Offline','{$_POST['no']}',now(),'','Y','{$_POST['issue']}','{$_SESSION['id']}','{$_POST['engg']}')";                
                $result=mysqli_query($link,$query) or die(mysqli_error());
                if($result){
                    echo "<script> alert('Vehichle Registered'); </script>";
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
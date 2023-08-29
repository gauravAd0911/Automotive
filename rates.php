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
    
if(document.f.pass.value!=document.f.cpass.value){
    alert("Password do not match");
    return false;
}
if(document.getElementById('br').value=="Select Branch"){
    alert("Please select the branch");
    return false;
}
if(document.getElementById('deg').value=="Select Semester"){
    alert("Please select the semester");
    return false;
}

var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = document.f.email.value;
   if(reg.test(address) == false) {
      alert('Invalid Email Address');
      return false;
   }            
   
   if(isNaN(document.f.contact.value))
           {
              alert("Enter valid contact no")
              return false;
           }
           
   if((document.f.contact.value.length>10)||(document.f.contact.value.length<10))
           {
               alert("Mobile Number should be 10 digit");
               return false;
           }
        return true;
}    
</script>
<body>
    <?php
    session_start();
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
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a href="slot.php"><i class=""></i>Add Slots</a>
                    </li>
                    <li>
                    <a  href="direct.php"><i class=""></i>Direct Booking</a>
                    </li>
                    <li>
                        <a  href="userhome.php"><i class=""></i>View Booking</a>
                    </li>
                     <li>
                        <a  href="billing.php"><i class=""></i>Generate Bill</a>
                     </li>
<!--                     <li>
                         <a  href="billreport.php"><i class=""></i>Billing Report</a>
                    </li>-->
                    <li>
                        <a  href="edit1.php"><i class=""></i>Change Password</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Rate Chart</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />     

            <?php
        include 'dbconnection.php'; 
        
        $query="select * from tblslots where username='{$_SESSION['id']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            ?>
                <br/><br/><form name="f" method="post" action="">
                <table border="1px;" width="40%">
                    <thead align="center" style="font-weight: bold"><tr>
                        <td>Garage Type</td>
                        <td>Slots</td>
                        <td>Hour Rate</td>
                        <td>Day Rate</td>
                        <td>Edit</td></tr>
                    </thead>
            <?php
                 while ($row=  mysqli_fetch_assoc($result)){
                 ?>
                    <tr>
                        <td><?php echo $row['type'] ?></td>
                        <td align='center'><?php echo $row['slots'] ?></td>
                        <td align='center'><?php echo $row['hrrate'] ?></td>
                        <td align='center'><?php echo $row['dayrate'] ?></td>
                        <td align='center'><a href='rates.php?id=<?php echo $row['id'] ?>'><img src='images/courselist.gif' width='24px' height='24px'/></a></td>
                    </tr>
                 <?php
                 }
                 ?>
                </table>
                </form>
   <?php                    
        }
        
       if(isset($_GET['id'])){
    
    $query="Select * from tblslots where id='{$_GET['id']}'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    echo "<br/><form name='f1' method='post' action=''>
    <input type='hidden' name='id' value='{$_GET['id']}'/>
    <table><tr><td>Garage Type: &nbsp;</td><td><input type='text' class='form-control' value='{$row['type']}' name='type'/></td></tr>
         <tr><td>Hour Rate:</td><td><input type='number' class='form-control' value='{$row['hrrate']}' name='hr'/></td></tr>
         <tr><td>Day Rate:</td><td><input type='number' class='form-control' value='{$row['dayrate']}' name='day'/></td></tr><tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td><td><input type='submit' class='btn btn-primary' value='Update' name='edit'/></td></tr>
         </form>";
}

if(isset($_REQUEST['edit'])){
    $result=mysqli_query($link,"update tblslots set hrrate='{$_POST['hr']}', dayrate='{$_POST['day']}' where id='{$_POST['id']}'");
    if(mysqli_affected_rows($link)>0){
        echo "<script> window.location.href='rates.php' </script>";
    }else{
        echo "Slots cannot be updated please try later";
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

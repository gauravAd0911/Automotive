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

if(document.getElementById('deg').value=="Select Designation"){
    alert("Please select the designation");
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
                        <a class="active-menu" href="userlist.php"><i class=""></i>List Garages</a>
                    </li>
                     <li>
                        <a  href="edit.php"><i class=""></i>Change Password</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Garage List</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
           
<?php

include 'dbconnection.php';

if($_SESSION['id']!="admin"){
            header('location:main.php');
}
        
if($_SESSION['id']==null){
    header('location:index.php');
}
else{
    ?>
                <table class="table" width="100%"  style='background-color:#060606bf;'>
            <thead align="center"><tr>
                    <td><strong>Full Name</strong></td>
                    <td><strong>Username</strong></td>
                    <td><strong>Area</strong></td>
                    <td><strong>Address</strong></td>
                    <td><strong>Mobile No</strong></td>
                    <td><strong>&nbsp;&nbsp;Edit&nbsp;&nbsp;</strong></td>
                    <td><strong>Delete</strong></td>
                </tr>
            </thead>   
            <?php

$query="select * from tbluser";
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>{$row['name']}</td>
          <td>{$row['username']}</td>
          <td>{$row['area']}</td>
          <td>{$row['address']}</td>
          <td>{$row['contact']}</td>
          <td align='center'><a href='userlist.php?id={$row['username']}' title='Update'><img src='images/courselist.gif' width='24px' height='24px'></a></td>";
          ?>
          <td align='center'><a href='deleteuser.php?id=<?php echo $row['username']?>' onclick="return confirm('Do you really want to delete the record')" title='Delete'><img src='images/discard.gif' width='20px' height='20px'></a></td></tr>
 <?php  }
   echo "</table>";
 }
}

if(isset ($_GET['id'])){
    $query="Select * from tbluser where username='{$_GET['id']}'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    ?>
       <br/><br/><form name="f" method="post" action="" onsubmit="javascript:return validate();">
        <table>
            <tr><td>Full Name:</td><td><input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" size="35" required="required"/></td></tr>
            <tr><td></td><td><input type="hidden" name="user" value="<?php echo $_GET['id'] ?>" size="35" required="required"/></td></tr>
            
            <tr><td>Area:</td><td><select name="area" style="width: 8" class="form-control">
                                            <option><?php echo $row['area'] ?></option>
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
                                    </select></td></tr>
            <tr><td>Address:</td><td><textarea class="form-control" name="address" size="35" required="required"><?php echo $row['address'] ?></textarea></td></tr>
            <tr><td>Mobile No:</td><td><input type="text" class="form-control" value="<?php echo $row['contact'] ?>" name="contact" size="35" required="required"/></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="edit" value="Update"/>&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" value="Reset" required="required"/></td></tr>
        </table>
        </form>
        <?php
}

if(isset($_REQUEST['edit'])){
    $query="update tbluser set name='{$_POST['name']}', area='{$_POST['area']}', address='{$_POST['address']}', contact='{$_POST['contact']}' where username='{$_POST['user']}'";
    $result=mysqli_query($link,$query);
    if(mysqli_affected_rows($link)>0){
        echo "<script>window.location.replace('userlist.php?m=1')</script>";
    }else{
        echo "<script>window.location.replace('userlist.php?m=2')</script>";
    }
}

if(isset($_GET['m'])){
    if($_GET['m']==1){
        echo "Record updated successfully";
    }
    else if($_GET['m']==2){
        echo "Record cannot be updated please try later";
    }
    else if($_GET['m']==3){
        echo "Record deleted Successfully";
    }
    else if($_GET['m']==4){
        echo "Record cannot be deleted please try later";
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

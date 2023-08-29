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
                     <h2>Add New Slot</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
      <?php 
        
           if($_SESSION['id']==null){
            header('location:index.php');
            }
        ?>
        <form name="f" method="post" action="" enctype="multipart/form-data" onsubmit="javascript:return validate();">
            <table>
            <tr><td>Slot Type: </td><td><select name="slot" class="form-control" style="width: 300px">
                                            <option>Two Wheeler</option>
                                            <option>Four Wheeler</option>
                                    </select></td></tr>
            <tr><td>Total Slots: &nbsp;</td><td><input type="text" pattern="[0-9]+" class="form-control" name="total" size="30" required="required"/></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Submit"/>&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" value="Reset" required="required"/></td></tr>
        </table>
        </form>
        
        
        <?php
        include 'dbconnection.php'; 
        
        $query="select * from tblslots where username='{$_SESSION['id']}'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            ?>
                <br/><br/><form name="f" method="post" action=""><center>
                    <table class="table" style="width: 50%; background-color: #3E0A6980;">
                    <thead align="center" style="font-weight: bold; color:#8afad0cc"><tr>
                        <td>Garage Type</td>
                        <td>Slots</td>
                        <td>Edit</td>
                        <td>Delete</td></tr>
                    </thead>
            <?php
                 while ($row=  mysqli_fetch_assoc($result)){
                 ?>
                    <tr>
                        <td><?php echo $row['type'] ?></td>
                        <td align='center'><?php echo $row['slots'] ?></td>
                        <td align='center'><a href='slot.php?id=<?php echo $row['id'] ?>'><img src='images/courselist.gif' width='24px' height='24px'/></a></td>
                        <td align='center'><a href='slot.php?del=<?php echo $row['id'] ?>' onclick="return confirm('Do you want to delete');"><img src='images/discard.gif' width='24px' height='24px'/></a></td>
                    </tr>
                 <?php
                 }
                 ?>
                </table>
                </center></form>
   <?php                    
        }
        
        if(isset($_REQUEST['save'])){
$slot=$_POST['slot'];
$total=$_POST['total'];

$query="select * from tblslots where username='{$_SESSION['id']}' and type='$slot'";
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    die("Slot already added for ".$slot);
}

$query="select * from tbluser where username='{$_SESSION['id']}'";
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
}

$query="insert into tblslots(username,area,address,type,slots) values('{$_SESSION['id']}','{$row['area']}','{$row['address']}','$slot','$total')";
$result=mysqli_query($link,$query);
if($result){
    echo "<script> window.location.href='slot.php'</script>";
}
else{
    echo "Slot cannot be added at this time";
 }   
}

if(isset($_GET['id'])){
    
    $query="Select * from tblslots where id='{$_GET['id']}'";
    $result=mysqli_query($link,$query);
    $row=mysqli_fetch_assoc($result);
    echo "<br/><form name='f1' method='post' action=''>
    <input type='hidden' name='id' value='{$_GET['id']}'/>
    <table><tr><td>Garage Type: &nbsp;</td><td><input type='text' class='form-control' value='{$row['type']}' name='type'/></td></tr>
         <tr><td>Slots:</td><td><input type='number' class='form-control' value='{$row['slots']}' name='total'/></td></tr><tr><td>&nbsp;</td></tr>
         <tr><td>&nbsp;</td><td><input type='submit' class='btn btn-primary' value='Update' name='edit'/></td></tr>
         </form>";
}

if(isset($_REQUEST['edit'])){
    $result=mysqli_query($link,"update tblslots set slots='{$_POST['total']}' where id='{$_POST['id']}'");
    if(mysqli_affected_rows($link)>0){
        echo "<script> window.location.href='slot.php' </script>";
    }else{
        echo "Slots cannot be updated please try later";
    }
}

if(isset($_GET['del'])){
    $result=mysqli_query($link,"delete from tblslots where id='{$_GET['del']}'");
    if(mysqli_affected_rows($link)>0){
        echo "<script> window.location.href='slot.php' </script>";
    }else{
        echo "Slots cannot be deleted please try later";
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

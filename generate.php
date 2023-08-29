<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VPS</title>
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
                     <h2>Billing</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />      
                <h1></h1><center>
                  <?php 
                  
if($_SESSION['id']==null){
    header('location:index.php');
}

include 'dbconnection.php';
if(isset($_GET['bid'])){
    // query for
    
?>
                <form name="f" method="post" action="">
                    <table>
                        <input type="hidden" name="id" value="<?php echo $_GET['bid'] ?>"/>
                        <tr><td>Vehicle No:</td><td><input type="text" value="<?php echo $_GET['vh']; ?>" class="form-control" name="no" size="35" required/></td></tr><tr><td>&nbsp;</td></tr>
                        <tr><td>Service:</td><td><select class="form-control" name='service'>
                                <?php
                                    $query="select * from tblservice where username='{$_SESSION['id']}'";
                                    $res= mysqli_query($link, $query);
                                    while($row= mysqli_fetch_assoc($res)){
                                        echo "<option>{$row['service']}</option>";
                                    }
                                ?>
                                </select>                            
                            </td></tr><tr><td>&nbsp;</td></tr>                        
                        <tr><td></td><td><input type="submit" class="btn btn-primary" name="save" value="Add to Bill" style="width: 120px;"/></td></tr>
                    </table>
                </form>
<?php
}

if(isset($_REQUEST['save'])){
    $query="select * from tbltemp where vno='{$_POST['no']}' and service='{$_POST['service']}'";
    $result= mysqli_query($link, $query) or die(mysqli_error($link));
    if(mysqli_num_rows($result)>0){
        echo "<script> alert('Service already added'); </script>";
    }else{
        $query="select * from tblservice where service='{$_POST['service']}' and username='{$_SESSION['id']}'";
        $result= mysqli_query($link, $query) or die(mysqli_error($link));
        $row= mysqli_fetch_assoc($result);
        $query="insert into tbltemp values('{$_POST['id']}','{$_POST['no']}','{$row['service']}','{$row['rate']}')";
        mysqli_query($link, $query);        
    }
            echo "<script> window.location.href='?bid={$_POST['id']}&vh={$_POST['no']}&disp=1'; </script>";
}
if(isset($_GET['disp'])){
    ?><br/>
                <table class="table" style="background-color: #0e0931b0; width:40%">
                    <tr>
                        <th>Service</th>
                        <th>Rate</th>
                    </tr>
                    <?php 
                        $query="select * from tbltemp where bid='{$_GET['bid']}'";
                        $result= mysqli_query($link, $query);
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr><td>{$row['service']}</td><td>{$row['rate']}</td>";
                        }
                    ?>
                </table>
    <button class="btn btn-danger" onclick="window.location.href='print.php?bid=<?php echo $_GET['bid']; ?>'">Print Bill</button>
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
    </center>
</body>
</html>
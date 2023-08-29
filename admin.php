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
            </div><br/>
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
                        <a class="active-menu"  href="admin.php"><i class=""></i>Admin/Garage Login</a>
                    </li>
                    <li>
                        <a href="user.php"><i class=""></i>User Login</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin/Garage Login</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
                
            <center>    <form name="f" method="post" action="login.php">
        <table>
            <tr><td><label>Username :&nbsp;</label></td><td><input type="text" autofocus="true" class="form-control" name="user" value=""/></td></tr><tr><td>&nbsp;</td></tr>
            <tr><td><label>Password :</label></td><td><input type="password" class="form-control" name="pass" value=""/></td></tr><tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type="submit" class="btn btn-primary" value="Login"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" class="btn btn-primary" value="Reset"/></td></tr>
        </table>
        </form>
        <br/><br/>
    
<!--<a href="register.php">Sign up</a><br/>-->
            
        <?php
        session_start();
        if(isset($_GET['msg'])) { 
            if($_GET['msg'] == 1) { 
                echo "<script> alert('Invalid Username/Password')</script>"; 
            }
            else if($_GET['msg'] == 2) { 
                echo 'Your request for registration is completed successfully.'; 
            }
            else if($_GET['msg'] == 3) { 
                echo 'Your request for registration cannot be processed. Please try later'; 
            }
            else if($_GET['msg'] == -1) { 
                echo 'You are successfully logged out'; 
            }
            else if($_GET['msg'] == 4) { 
                echo "<script>alert('Inavlid University Number/Password')</script>"; 
            }
        }
        ?>
            </center>  <!-- /. ROW  -->           
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

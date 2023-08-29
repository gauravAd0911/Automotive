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
<script lang="javascript">
function validate(){

if(document.getElementById('ft').value=="Select Type of File"){
    alert("Please select the file type");
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
                        <a class="active-menu" href="custhome.php"><i class=""></i>Home</a>
                    </li>
                    <li>
                        <a  href="booking.php"><i class=""></i>View Booking</a>
                    </li>
                     <li>
                        <a  href="editpassword.php"><i class=""></i>Change Password</a>
                    </li>
                  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>File Upload</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                <hr />                
 <?php
        session_start();
        include 'dbconnection.php';
        
        if($_SESSION['id']==Null){
            header('location:index.php');
        }
        
        $query="select subject from tblsubjects where branch='{$_SESSION['branch']}'";
        $result=mysqli_query($link,$query);
        
        echo "<form name='f' method='post' action='upload.php' enctype='multipart/form-data' onsubmit='javascript:return validate()'>
        <table>
            <tr><td>User Name:</td><td><input type='text' class='form-control' name='user' value='{$_SESSION['id']}' readonly='true'/></td></tr>
            <tr><td>Branch:</td><td><input type='text' name='branch' class='form-control' value='{$_SESSION['branch']}' size='35' readonly='true'/></td></tr>
            <tr><td>Semester:</td><td><input type=text readonly name='sem' id='sem' class='form-control' value='{$_SESSION['sem']}' ></td></tr>
            <tr><td>File Description: &nbsp;</td><td><input type='text' name='desc' class='form-control'  required='required'/></td></tr>
            <tr><td>File Type:</td><td><select name='ft' class='form-control' id='ft'>
                                            <option>Select Type of File</option>
                                            <option>Synopsis</option>
                                            <option>Phase 1</option>
                                            <option>Phase 2</option>
                                            <option>Project Report</option>
                                            <option>Project Code</option>
                                    </select></td></tr>
            <tr><td>Select File</td><td><input name='uploaded_file' type='file' required='required'/></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td></td><td><input type='submit' class='btn btn-primary' value='Upload'/></td></tr>
        </table>
        <input type='hidden' name='MAX_FILE_SIZE' value='1000000' />
        </form>";
        
        
        //session_start();
        if(isset($_GET['msg'])){ 
            if($_GET['msg'] == 1) { 
                echo "<script> alert('File size is exceeding then the limlit')</script>"; 
            }
            else if($_GET['msg'] == 2) { 
                echo 'Record was saved in the database and the file was uploaded'; 
            }
            else if($_GET['msg'] == 3) { 
                echo 'Record was not saved in the database but file was uploaded'; 
            }
            else if($_GET['msg'] == 4) { 
                echo 'Upload of file was unsuccessful'; 
            }
            else if($_GET['msg'] == 5) { 
                echo 'Error: File name already exists'; 
            }
            else if($_GET['msg'] == 6) { 
                echo 'Error: All file types except .exe file under 5 Mb are not accepted for upload'; 
            }
            else if($_GET['msg'] == 7) { 
                echo 'No file uploaded. File size is exceeding then the limlit. '; 
            }
        }
        
        echo "<br/>";
        $result=mysqli_query($link,"select count(*) as c from up_files where usn='{$_SESSION['id']}'") or die(mysqli_error());
        $r=mysqli_fetch_assoc($result);
        if($r['c']==0){
            echo "<br/>Submitted<br/><img src='images/p0.png'/>";
        }
        else if($r['c']==1){
            echo "<br/>Submitted<br/><img src='images/p20.png'/>";
        }
        else if($r['c']==2){
            echo "<br/>Submitted<br/><img src='images/p40.png'/>";
        }
        else if($r['c']==3){
            echo "<br/>Submitted<br/><img src='images/p60.png'/>";
        }
        else if($r['c']==4){
            echo "<br/>Submitted<br/><img src='images/p80.png'/>";
        }
        else if($r['c']==5){
            echo "<br/>Submitted<br/><img src='images/p100.png'/>";
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

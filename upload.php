<?php
	session_start();
        include 'dbconnection.php';
        
        $username=$_SESSION['id'];
        $branch=$_SESSION['branch'];
        $sem=$_SESSION['sem'];
        $type=$_POST['ft'];
	$filedesc=$_POST['desc'];
        
                
	if($_FILES['uploaded_file']['size'] >= 1048576*5) {
            if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=1');
            }
            else{
                header('location:custhome.php?msg=1');
            }
	}	
	
	 //upload random name/number
	 $rd2 = mt_rand(1000,9999)."_File"; 
	 
	 //Check that we have a file
	if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
            
  //Check if the file is JPEG image and it's size is less than 350Kb
  $filename = basename($_FILES['uploaded_file']['name']);
  
  $ext = substr($filename, strrpos($filename, '.') + 1);
  
  if (($ext != "exe") && ($_FILES["uploaded_file"]["type"] != "application/x-msdownload"))  {
    //Determine the path to which we want to save this file      
	  //$newname = dirname(__FILE__).'/uploads/'.$filename;
	  $newname="uploads/".$rd2."_".$filename;      
	  //Check if the file with the same name is already exists on the server
      if (!file_exists($newname)) {
        //Attempt to move the uploaded file to it's new place
        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$newname))) {
			//successful upload
          // echo "It's done! The file has been saved as: ".$newname;		   
		$qry2 = "INSERT INTO up_files (usn,branch,sem,ftype,floc,fdatein,fdesc,marks) VALUES ('$username','$branch','$sem','$type','$newname',NOW(),'$filedesc','0')";	
		//$result = @mysqli_query($link,$qry);
	    $result2 = mysqli_query($link,$qry2);		
		if ($result2){
		/*$errmsg_arr[] = 'record was saved in the database and the file was uploaded';
		$errflag = true;	
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
                    if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=2');
            }
            else{
		header("location:custhome.php?msg=2");
		exit();
            }
                //}	
		}
		else {
		/*$errmsg_arr[] = 'record was not saved in the database but file was uploaded';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
                    if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=3');
            }
            else{
		header("location: custhome.php?msg=3");
		exit();
                //}
                }		
                }
		
        } 
		else 
		{
           //unsuccessful upload
		   //echo "Error: A problem occurred during file upload!";
/*		$errmsg_arr[] = 'upload of file ' .$filename. ' was unsuccessful';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
                    if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=4');
            }
            else{
		header("location: custhome.php?msg=4");
		exit();}
                }
		   
        //}
      	} 
	  
	  else 
	  {
         //existing upload
		// echo "Error: File ".$_FILES["uploaded_file"]["name"]." already exists";
		/*$errmsg_arr[] = 'Error: File >>'.$_FILES["uploaded_file"]["name"].'<< already exists';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
              if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=5');
            }
            else{
		header("location: custhome.php?msg=5");
		exit();
                //}
            }
      }
	  
  	} 
  	else 
	{
		//wrong file upload
     //echo "Error: Only .jpg images under 350Kb are accepted for upload";
	 /*$errmsg_arr[] = 'Error: All file types except .exe file under 5 Mb are not accepted for upload';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
            if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=6');
            }
            else{
		header("location: custhome.php?msg=6");
		exit();
            }
               // }
        }
	
	} 
	
	else 
	{
		//no file to upload
 	//echo "Error: No file uploaded";
	
		/*$errmsg_arr[] = 'Error: No file uploaded';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();*/
            if($_SESSION['id']=="admin"){
                header('location:uploadadmin.php?msg=7');
            }
            else{
		header("location: custhome.php?msg=7");
		exit();
                //}
	}}
	mysqli_close();
?>
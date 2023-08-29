<?php
session_start();
include 'dbconnection.php';

$user=$_POST['user'];
$pass=$_POST['pass'];

$query="Select * from tbluser where username='$user' and password='$pass'";
$result=  mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    if(($row['username']==$user) && ($row['password']==$pass)){
        $_SESSION['id']=$row['username'];
        header('location:userhome.php');
    }  
   else{
       header('location:user.php?msg=1');
    }
}else{
       header('location:user.php?msg=4');
    }

?>
<?php
session_start();
include 'dbconnection.php';

$user=$_POST['user'];
$pass=$_POST['pass'];

$query="Select username,password from tbllogin where binary username='$user' and binary password='$pass'";
$result=  mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    $_SESSION['id']=$user;
    $_SESSION['name']="Admin";
    header('location:main.php');
}

else{    
        $query="Select * from tbluser where binary username='$user' and binary password='$pass'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
        $row= mysqli_fetch_assoc($result);
        $_SESSION['id']=$user;
        $_SESSION['name']=$row['name'];
        $_SESSION['type']="owner";
        header('location:dashboard.php');
    }else{
        $query="Select * from tblengg where binary username='$user' and binary password='$pass'";
        $result=mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            $row= mysqli_fetch_assoc($result);
            $_SESSION['id']=$user;
            $_SESSION['name']=$row['name'];
            $_SESSION['type']="engg";
            header('location:addservice.php');
        }
        else{
            header('location:admin.php?msg=1');
        }
    }
 }   
   
?>
<?php
session_start();
include 'dbconnection.php';

$user=$_POST['user'];
$pass=$_POST['pass'];
$name=$_POST['name'];
$area=$_POST['area'];
$address=$_POST['address'];
$contact=$_POST['contact'];
$loc=$_POST['loc'];

$query="select * from tblusers where username='$user'";
$result=mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    header('location:newuser.php?msg=1');
}
else{
$query="insert into tbluser(name,username,password,area,address,contact,location) values('$name','$user','$pass','$area','$address','$contact','$loc')";
$result=mysqli_query($link,$query);
if($result){
        header('location:newuser.php?msg=2');
}
else{
        header('location:newuser.php?msg=5');
    }
}
?>
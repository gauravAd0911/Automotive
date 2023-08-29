<?php
include 'dbconnection.php';

$reg=$_GET['id'];

$query="delete from tbluser where username='$reg'";
$result=  mysqli_query($link,$query);

if(mysqli_affected_rows($link)>0){
    header('location:userlist.php?m=3');
}
else{
    header('location:userlist.php?m=4');
}
?>
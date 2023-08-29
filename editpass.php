<?php
include 'dbconnection.php';
session_start();

$old=$_POST['pass'];
$p1=$_POST['p1'];

if($_SESSION['id']=="admin"){
    $query="select * from tbllogin where username='{$_SESSION['id']}' and password='$old'";
    $result=  mysqli_query($link,$query);
        if(mysqli_num_rows($result)>0){
            $query="update tbllogin set password='$p1' where username='{$_SESSION['id']}'";
            $result=mysqli_query($link,$query);
            if(mysqli_affected_rows($link)>0){
                header('location:main.php?msg=3');
            }
            
            else{
                header('location:edit.php?msg=4');
            }

        }
        else{
                header('location:edit.php?msg=4');
            }
}

else{
$query="select * from tblusers where username='{$_SESSION['id']}' and password='$old'";
$result=  mysqli_query($link,$query);
if(mysqli_num_rows($result)>0){
    $query="update tblusers set password='$p1' where username='{$_SESSION['id']}'";
    $result=mysqli_query($link,$query);
    if(mysqli_affected_rows($link)>0){
        header('location:userhome.php?msg=3');
    }
    else{
        header('location:edit.php?msg=4');
    }
  }
  else{
      header('location:edit.php?msg=4');
   }
}
?>

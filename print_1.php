<?php
include 'dbconnection.php';

mysqli_query($link, "insert into tblbill(services,dtdate,bookid,amount) values('{$_POST['issue']}',now(),'{$_POST['id']}','{$_POST['amt']}')");
mysqli_query($link, "update tblbooking set endtime=now(),service='done' where bookid='{$_POST['id']}'");

$query="SELECT * FROM tblbill,tblbooking WHERE tblbill.bookid='{$_POST['id']}' and tblbooking.bookid='{$_POST['id']}'";
$result=  mysqli_query($link,$query);
$row= mysqli_fetch_assoc($result);
echo "<table>
    <tr><td><strong>Date:</td><td>{$row['dtdate']}</td><td><strong>Bill NO:</td><td>{$row['billno']}</td></tr>
    <tr><td><strong>Vehicle No:</td><td>{$row['vehicleno']}</td><td><strong>Type</td><td>{$row['vehicletype']}</td></tr>
    <tr><td><strong>Start Time:</td><td>{$row['starttime']}</td><td><strong>End Time:</td><td>{$row['endtime']}</td></tr>
    <tr><td><strong>Services given</td><td>{$row['services']}</td><td><strong></td><td></td></tr>
    <tr><td><strong>Total Amount:</td><td>{$row['amount']}</td><td><strong>For:</td><td>{$row['booktype']} basis</td></tr>
</table>";

?>
<br/><a href="" onclick="window.print()">Print</a>
<br/><a href="billing.php">Back</a>
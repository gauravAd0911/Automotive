<?php
include 'dbconnection.php';

mysqli_query($link, "insert into tblbill(dtdate,bookid) values(now(),'{$_GET['bid']}')");

$query="select billno from tblbill where bookid='{$_GET['bid']}'";
$result= mysqli_query($link, $query);
$row=mysqli_fetch_assoc($result);
$billno=$row['billno'];
$query="select * from tbltemp where bid='{$_GET['bid']}'";
$result= mysqli_query($link, $query);
while($rr= mysqli_fetch_assoc($result)){
    mysqli_query($link, "insert into tblbilllist values('{$row['billno']}','{$rr['service']}','{$rr['rate']}')");
}
mysqli_query($link, "update tblbooking set endtime=now(),service='done' where bookid='{$_GET['bid']}'");

$query="SELECT * FROM tblbill,tblbooking WHERE tblbill.bookid='{$_GET['bid']}' and tblbooking.bookid='{$_GET['bid']}'";
$result=  mysqli_query($link,$query);
$row= mysqli_fetch_assoc($result);
echo "<table border='1' width='40%'>
    <tr><td><strong>Date:</td><td>{$row['dtdate']}</td><td><strong>Bill NO:</td><td>{$row['billno']}</td></tr>
    <tr><td><strong>Vehicle No:</td><td>{$row['vehicleno']}</td><td><strong>Type</td><td>{$row['vehicletype']}</td></tr>
    <tr><td><strong>Start Time:</td><td>{$row['starttime']}</td><td><strong>End Time:</td><td>{$row['endtime']}</td></tr>    
</table>";
echo "<table border='1' width='40%'><tr><th>Slno</th><th>Service</th><th>Rate</th></tr>";
    $query="select * from tblbilllist where billno='$billno'";
    $result= mysqli_query($link, $query);
    $sl=1;
    $gt=0;
    while($row= mysqli_fetch_assoc($result)){
        echo "<tr><td>$sl</td><td>{$row['service']}</td><td>{$row['rate']}</td></tr>";
        $sl++;
        $gt=$gt+$row['rate'];
    }
    echo "<tr><td></td><td>Grand Total</td><td>$gt</td></tr>";
    echo "</table>";
?>
<br/><a href="" onclick="window.print()">Print</a>
<br/><a href="billing.php">Back</a>
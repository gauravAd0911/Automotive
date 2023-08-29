<?php
require_once 'phplot.php';
session_start();
include 'dbconnection.php';

$menu = array();

$result=mysqli_query($link,"select * from totalstud order by year") or die(mysqli_error());
while($row=mysqli_fetch_assoc($result)){
   $menu[] = array($row['total']." - ".$row['boys'],$row['girls']);
}

$plot = new PHPlot(800, 600);
$plot->SetImageBorderType('plain');
$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetDataValues($menu);

$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

$plot->DrawGraph();
 
echo "<font color='red'>DSDS";
?>
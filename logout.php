<?php
session_start();
session_destroy();
unset($_SESSION["id"]);
unset ($_SESSION["branch"]);
unset ($_SESSION["sem"]);
header("location:index.php?msg=-1");
?>
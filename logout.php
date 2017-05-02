
<?php
session_start();

unset($_SESSION['loginuser']);
session_destroy();
$f = $_SESSION['loginuser'];
echo $f;
header('Location: login.php');
?>

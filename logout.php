<?php
esetcookie("user_id", "", tim() - 3600, "/"); 
header("Location: login.php");
exit();
?>
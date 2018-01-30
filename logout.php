<?php 
session_start();
unset($_SESSION['user']);
session_destroy();
die("<script>location.href = '/login.php'</script>");
?>
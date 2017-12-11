<?php 
session_start();
unset($_SESSION['user']);
session_destroy();
die("<script>location.href = 'https://www.ihouse-panel.com/git/login.php'</script>");
?>
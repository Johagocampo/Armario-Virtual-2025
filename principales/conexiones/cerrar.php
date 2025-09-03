<?php
session_start();
session_unset();
session_destroy();

header("Location: ../principales/main.php");
exit();
?>
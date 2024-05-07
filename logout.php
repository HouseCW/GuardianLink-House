<?php

session_start();

session_destroy();

header("Location: guardianlink.php");
exit;
?>
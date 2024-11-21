<?php
session_start();
header('Location: ../customer/index.php');
session_destroy();
?>
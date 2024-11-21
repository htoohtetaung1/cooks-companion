<?php
session_start();
if ($_SESSION['user_type'] === 'admin' && $_SESSION['loggedIn']) {
    header ('Location: ../admin/index.php');
} else if ($_SESSION['user_type'] === 'customer' && $_SESSION['loggedIn']) {
    header ('Location: ./profile_page.php');
} else {
    header ('Location: ./login_page.php');
}
?>
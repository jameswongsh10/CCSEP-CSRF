<?php
require_once('common.php');
if ($_POST['username'] === 'test' && $_POST['password'] === 'password') {
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['username'] = $_POST['username'];
    resetAccount();
    header('Location: /account.php');
} else {
    header('Location: /index.html');
}
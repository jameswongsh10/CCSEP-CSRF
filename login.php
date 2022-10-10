<?php
require_once('common.php');
if ($_POST['username'] === 'test' && $_POST['password'] === 'password') {
    $_SESSION['isLoggedIn'] = true;
    $_SESSION['username'] = $_POST['username'];
    resetAccount();
    //CSRF Patching
    $_SESSION['token'] = getCSRFToken($_POST['password']);
    header('Location: /account.php');
} else {
    header('Location: /index.html');
}
<?php
require_once('common.php');
if(!isLoggedIn()) {
    header('Location: /index.html');
}

$amount = $_REQUEST['amount'];
$to = $_REQUEST['to'];

if ($amount > $_SESSION['balance']) {
    die("insufficient funds");
}

$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

if (!$token || $token !== $_SESSION['token']) {
    // return 405 http status code
    echo '<script>alert("CSRF Patched. You are not authorized to access the page.")</script>';
    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    exit;
} else {
    // process the form
    $_SESSION['balance'] -= $amount;
    array_push($_SESSION['transfers'], array("to" => $to, "from" => $_SESSION['username'], "amount" => $amount));

    header('Content-Type: application/json');
    header('Location: /account.php');
    $_SESSION['alertMessage'] = "HEHE Money gone";
    echo json_encode(array("balance" => $_SESSION['balance'], "transfers" => $_SESSION['transfers']));
}
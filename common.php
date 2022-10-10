<?php
session_start();

/**
 * Generate, store, and return the CSRF token
 *
 * @return string[]
 */

$password = "testtesttest";
function getCSRFToken($password)
{
    $nonce = uniqid();
    $expires = time() + 3600;
    $data = bin2hex($nonce) . "-" . session_id() . "-" . $expires;
    $hash = hash_hmac('sha256', $data, $password);

    echo $data . "-" . $hash;
    return $data . "-" . $hash;
}

function isLoggedIn()
{
    if ($_SESSION['isLoggedIn'] === true) {
        return true;
    }
    return false;
}

function resetAccount()
{
    $_SESSION['balance'] = 500000;
    $_SESSION['transfers'] = [];
}
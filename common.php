<?php
session_start();

function isLoggedIn() {
    if ($_SESSION['isLoggedIn'] === true) {
        return true;
    }

    return false;
}

function resetAccount() {
    $_SESSION['balance'] = 500000;
    $_SESSION['transfers'] = [];
}
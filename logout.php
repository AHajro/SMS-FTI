<?php
session_start();

unset($_SESSION['adminUserid']);
unset($_SESSION['admin']);

unset($_SESSION['studentUserid']);
unset($_SESSION['student']);

unset($_SESSION['pedagogUserid']);
unset($_SESSION['pedagog']);

header("Location:index.html");
?>
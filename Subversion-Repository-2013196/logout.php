<?php

session_start();
// remove all session variables
session_unset();

// destroy the session
session_destroy();

//die("sucess");

$redirectURL = 'index.php';
		header("Location: ".$redirectURL);

?>
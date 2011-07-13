<?php
// *********************************************************
// MitosEHR Configuration file per site
// MySQL Config
// *********************************************************

//**********************************************************************
// Database Init Configuration
//**********************************************************************
$_SESSION['site']['db']['type'] = 'mysql';
$_SESSION['site']['db']['host'] = 'localhost';
$_SESSION['site']['db']['port'] = '3306';
$_SESSION['site']['db']['username'] = 'mitosdb';
$_SESSION['site']['db']['password'] = 'pass';
$_SESSION['site']['db']['database'] = 'mitosdb';

//**********************************************************************
// AES Key
// 256bit - key
//**********************************************************************
$_SESSION['site']['AESkey'] = "abcdefghijuklmno0123456789012345";

//**********************************************************************
// Setup Command
// If it's true, the application will
// run the Setup Wizard 
//**********************************************************************
$_SESSION['site']['setup'] = false;

?>

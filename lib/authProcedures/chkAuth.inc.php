<?php

/* chkAuth
 * 
 * Description: This littler dude will check the integrity of the 
 * session and if the session is expired logoff and show the 
 * logon screen, or if something is missing logoff and show the
 * logon screen. Also is in charge of giving the command to
 * logoff.
 * 
 * Author: GI Technologies, 2011
 * Modified: N/A
 * Ver: 0.0.1
 * 
 */

session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

$_SESSION['site']['flops']++;

//****************************************************************
// If the session has passed 60 flops, with out any activity exit
// the application.
//
// Need to implement restart flop, every time a screen is loaded
//
// return an exit code
//****************************************************************
if($_SESSION['site']['flops'] >= 180) {
	echo "exit";
	return;
}

?>
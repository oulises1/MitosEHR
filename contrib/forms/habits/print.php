<?
# print the habits form.


include("../../../lib/acl.inc.php");

formHeader("Habits form");

	// this part is the copy of what we have inside the function on the report.php file
	include_once ('form_report.php');

?>
<hr>
<a href="<?php echo $GLOBALS['form_exit_url']; ?>" onclick="top.restoreSession()">Done</a>

<?php
formFooter();
?>

<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php
// v0.0.2
// Under GPLv3 License
//
// Integrated by: Ernesto Rodriguez in 2011
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');
include_once($_SESSION['site']['root']."/classes/dbHelper.class.php");

//******************************************************************************
// Reset session count 10 secs = 1 Flop
//******************************************************************************
$_SESSION['site']['flops'] = 0;

//------------------------------------------
// Database class instance
//------------------------------------------
$mitos_db = new dbHelper();
// *************************************************************************************
// Parce the data generated by EXTJS witch is JSON
// *************************************************************************************
$data = json_decode ( $_POST['row'], true );
//------------------------------------------
// get the current user name
//------------------------------------------
$user = $_SESSION['user']['name'];

// *************************************************************************************
// Validate and pass the POST variables to an array
// This is the moment to validate the entered values from the user
// although Sencha EXTJS make good validation, we could check again 
// just in case 
// *************************************************************************************
$row['date']        = $data['date'];
$row['body']        = $data['body'];
$row['groupname']   = $data['groupname'];
$row['activity']   	= $data['activity'];

// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT statement
// *************************************************************************************
$sql = $mitos_db->sqlBind($row, "onotes", "U", "id='" . $data['id'] . "'");
$mitos_db->setSQL($sql);
$ret = $mitos_db->execLog();

if ( $ret == "" ){
	echo '{ success: false, errors: { reason: "'. $ret[2] .'" }}';
} else {
	echo "{ success: true }";
}
?>
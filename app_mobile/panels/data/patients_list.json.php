<?php
// **************************************************************************************
// patient_search.inc.php
// Description: This file will contain all server side script to help
// the Patient Live Search
// v0.0.1
//
// Author: Ernesto J Rodriguez
// Modified: n/a
//
// MitosEHR (Electronic Health Records) 2011
// **************************************************************************************

// **************************************************************************************
// Start MitosEHR session
// **************************************************************************************
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

// **************************************************************************************
// Load all the necessary libraries
// **************************************************************************************
include_once($_SESSION['site']['root']."/classes/dbHelper.class.php");

// **************************************************************************************
// Reset session count 10 secs = 1 Flop
// **************************************************************************************
$_SESSION['site']['flops'] = 0;

// **************************************************************************************
// Database class instance
// **************************************************************************************
$mitos_db = new dbHelper();

// ------------------------------------------------------------------------------
// sql statement and json to get patients
// ------------------------------------------------------------------------------
$mitos_db->setSQL("SELECT id,pid,pubpid,fname,lname,mname FROM patient_data");
$total = $mitos_db->rowCount();
$rows = array();

foreach($mitos_db->execStatement(PDO::FETCH_ASSOC) as $row){
    $row['fullname'] =  $row['fname']. " ".$row['mname'] . " ".$row['lname'];
    array_push($rows, $row);
}
print_r(json_encode(array('totals'=>$total,'row'=>$rows)));
?>
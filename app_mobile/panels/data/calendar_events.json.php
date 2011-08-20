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


$mitos_db->setSQL("SELECT c.id AS event_id, c.user_id, c.patient_id, c.start, c.end, CONCAT(p.fname, ' ', p.mname, ' ', p.lname) AS fullname
                     FROM calendar_events AS c
                LEFT JOIN patient_data AS p
                       ON (c.user_id = p.id)");
$total = $mitos_db->rowCount();

$today          = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
$thisweek       = date('W');
$tomorrow       = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));
$nextmonth      = date("Y-m-d", mktime(0, 0, 0, date("m")+1, date("d"),   date("Y")));

$rows = array();
foreach($mitos_db->execStatement(PDO::FETCH_ASSOC) as $row){

    $time = strtotime($row['start']);
    $date = date("Y-m-d", $time);
    if ($date ==  $today) {
        $group = 'Today';
    } elseif($date == $tomorrow){
        $group = 'Tomorrow';
    } elseif($thisweek == (int)date('W',$time)){
        $group = 'This Week';
    } elseif($date < $nextmonth ) {
        $group = 'This Month';
    }

    $row['group'] = $group;

    array_push($rows, $row);
}


print_r(json_encode(array('totals'=>$total,'row'=>$rows)));

?>
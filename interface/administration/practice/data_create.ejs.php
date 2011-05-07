<?php
//--------------------------------------------------------------------------------------------------------------------------
// data_create.ejs.php / List Options
// v0.0.2
// Under GPLv3 License
//
// Integrated by: GI Technologies Inc. in 2011
//
// Remember, this file is called via the Framework Store, this is the AJAX thing.
//--------------------------------------------------------------------------------------------------------------------------

session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

include_once("../../../library/dbHelper/dbHelper.inc.php");
include_once("../../../library/I18n/I18n.inc.php");
require_once("../../../repository/dataExchange/dataExchange.inc.php");

//------------------------------------------
// Database class instance
//------------------------------------------
$mitos_db = new dbHelper();

// *************************************************************************************
// Parce the data generated by EXTJS witch is JSON
// *************************************************************************************
$data = json_decode ( $_POST['row'], true );

// *************************************************************************************
// Validate and pass the POST variables to an array
// This is the moment to validate the entered values from the user
// although Sencha EXTJS make good validation, we could check again 
// just in case 
// *************************************************************************************

switch ($_GET['task']) {
	case 'pharmacy':	
		$row['name'] 					= dataEncode($data['name']);
		$row['transmit_method'] 		= dataEncode($data['transmit_method']);
		$row['email'] 					= dataEncode($data['email']);
	break;
	case 'insurance':
		$row['name'] 					= dataEncode($data['name']);
		$row['attn'] 					= dataEncode($data['attn']);
		$row['cms_id'] 					= dataEncode($data['cms_id']);
		$row['freeb_type'] 				= dataEncode($data['freeb_type']);
		$row['x12_receiver_id'] 		= dataEncode($data['x12_receiver_id']);
		$row['x12_default_partner_id'] 	= dataEncode($data['x12_default_partner_id']);
		$row['alt_cms_id'] 				= dataEncode($data['alt_cms_id']);
	break;
}
$row['phone_country_code'] 		= dataEncode($data['phone_country_code']);
$row['phone_area_code'] 		= dataEncode($data['phone_area_code']);
$row['phone_prefix'] 			= dataEncode($data['phone_prefix']);
$row['phone_number'] 			= dataEncode($data['phone_number']);
$row['fax_country_code'] 		= dataEncode($data['fax_country_code']);
$row['fax_area_code'] 			= dataEncode($data['fax_area_code']);
$row['fax_prefix'] 				= dataEncode($data['fax_prefix']);
$row['fax_number'] 				= dataEncode($data['fax_number']);
$row['line1'] 					= dataEncode($data['line1']);
$row['line2'] 					= dataEncode($data['line2']);
$row['city'] 					= dataEncode($data['city']);
$row['state'] 					= dataEncode($data['state']);
$row['zip'] 					= dataEncode($data['zip']);
$row['plus_four'] 				= dataEncode($data['plus_four']);
$row['country'] 				= dataEncode($data['country']);


// *************************************************************************************
// Finally that validated POST variables is inserted to the database
// This one make the JOB of two, if it has an ID key run the UPDATE statement
// if not run the INSERT stament
// *************************************************************************************
switch ($_GET['task']) {
	case 'pharmacy':
		$mitos_db->setSQL("INSERT INTO pharmacies 
								   SET name 			= '".$row['name']."',"."
								   	   transmit_method 	= '".$row['transmit_method']."',"."
									   email 			= '".$row['email']."'");
		$mitos_db->execLog();
	break;
	case 'insurance':
		$mitos_db->setSQL("INSERT INTO insurance_companies 
								   SET name 					= '".$row['name']."',"."
								   	   attn 					= '".$row['attn']."',"."
								   	   cms_id 					= '".$row['cms_id']."',"."
								   	   freeb_type 				= '".$row['freeb_type']."',"."
								   	   x12_receiver_id 			= '".$row['x12_receiver_id']."',"."
								   	   x12_default_partner_id 	= '".$row['x12_default_partner_id']."',"."
									   alt_cms_id 				= '".$row['alt_cms_id']."'");
		$mitos_db->execLog();
	break;
}
// *************************************************************************************
// Lets get the last Inserted ID  and use it to insert the address and phone/fax numbers
// *************************************************************************************
$last_insert_id = $mitos_db->lastInsertedId();
// *************************************************************************************
// Lets Insert the address for the new pharmacy or insurance
// *************************************************************************************
$mitos_db->setSQL("INSERT INTO addresses
						   SET line1			= '".$row['line1']."',"."
						       line2			= '".$row['line2']."',"."
						       city				= '".$row['city']."',"."
						       state			= '".$row['state']."',"."
						       zip				= '".$row['zip']."',"."
						       plus_four		= '".$row['plus_four']."',"."
						       country			= '".$row['country']."',"."
							   foreign_id 		= '".$last_insert_id."'");
$mitos_db->exec();
// *************************************************************************************
// Lets Insert the phone number for the new pharmacy or insurance
// *************************************************************************************
$mitos_db->setSQL("INSERT INTO phone_numbers
						   SET country_code		= '".$row['phone_country_code']."',"."
						       area_code		= '".$row['phone_area_code']."',"."
						       prefix			= '".$row['phone_prefix']."',"."
						       number			= '".$row['phone_number']."',"."
							   foreign_id 		= '".$last_insert_id."'");
$mitos_db->exec();
// *************************************************************************************
// Lets Insert the Fax number for the new pharmacy or insurance
// *************************************************************************************
$mitos_db->setSQL("INSERT INTO phone_numbers
						   SET country_code		= '".$row['fax_country_code']."',"."
						       area_code		= '".$row['fax_area_code']."',"."
						       prefix			= '".$row['fax_prefix']."',"."
						       number			= '".$row['fax_number']."',"."
							   foreign_id 		= '".$last_insert_id."'");
$mitos_db->exec();
?>
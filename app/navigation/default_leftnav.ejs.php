<?php
session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');
include_once($_SESSION['site']['root']."/classes/I18n.class.php");
// *************************************************************************************
// Renders the items of the navigation panel
// Default Nav Data
// *************************************************************************************
$nav = array(
    array( 'text' => i18n('Dashboard', 'r'), 'leaf' => true, 'cls' => 'file', 'iconCls' => 'icoDash',      'hrefTarget' => 'dashboard/dashboard.ejs.php' ),
    array( 'text' => i18n('Calendar', 'r'),  'leaf' => true, 'cls' => 'file', 'iconCls' => 'icoCalendar',  'hrefTarget' => 'calendar/calendar.ejs.php' ),
    array( 'text' => i18n('Messages', 'r'),  'leaf' => true, 'cls' => 'file', 'iconCls' => 'mail',         'hrefTarget' => 'messages/messages.ejs.php' ),
);
// *************************************************************************************
// Patient Folder
// *************************************************************************************
$patient_folder = array( 'text' => i18n('Patient', 'r'), 'cls' => 'folder', 'expanded' => true, 'children' =>
    array(
        array( 'text' => i18n('New Patient', 'r'),     'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'patient_file/new/new_patient.ejs.php' ),
        array( 'text' => i18n('Patient Summary', 'r'), 'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'patient_file/summary/summary.ejs.php' ),
        array( 'text' => i18n('Visits', 'r'),   'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'patient_file/visits/visits.ejs.php' ),
    )
);
// *************************************************************************************
// Fees Folder
// *************************************************************************************
$fees_folder = array( 'text' => i18n('Fees', 'r'), 'cls' => 'folder', 'expanded' => true, 'children' =>
    array(
        array( 'text' => i18n('Billing', 'r'),         'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'fees/billing/billing.ejs.php' ),
        array( 'text' => i18n('Checkout', 'r'),        'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'fees/checkout/checkout.ejs.php' ),
        array( 'text' => i18n('Fees Sheet', 'r'),      'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'fees/fees_sheet/fees_sheet.ejs.php' ),
        array( 'text' => i18n('Payments', 'r'),        'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'fees/payments/payments.ejs.php' ),
    )
);
// *************************************************************************************
// Administration Folder
// *************************************************************************************
$admin_folder = array( 'text' => i18n('Administration', 'r'), 'cls' => 'folder', 'expanded' => true, 'children' =>
    array(
        array( 'text' => i18n('Global Settings', 'r'), 'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/globals/globals.ejs.php' ),
        array( 'text' => i18n('Facilities', 'r'),      'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/facilities/facilities.ejs.php' ),
        array( 'text' => i18n('Users', 'r'),           'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/users/users.ejs.php' ),
        array( 'text' => i18n('Practice', 'r'),        'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/practice/practice.ejs.php' ),
        array( 'text' => i18n('Services', 'r'),        'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/services/services.ejs.php' ),
        array( 'text' => i18n('Roles', 'r'),           'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/roles/roles.ejs.php' ),
        array( 'text' => i18n('Layouts', 'r'),         'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/layout/layout.ejs.php' ),
        array( 'text' => i18n('Layouts 2', 'r'),         'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/layout/layout2.ejs.php' ),
        array( 'text' => i18n('Lists', 'r'),           'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/lists/lists.ejs.php' ),
        array( 'text' => i18n('Event Log', 'r'),       'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'administration/log/log.ejs.php' ),
    )
);
// *************************************************************************************
// Miscellaneous Folder
// *************************************************************************************
$misc_folder = array( 'text' => i18n('Miscellaneous', 'r'), 'cls' => 'folder', 'expanded' => true, 'children' =>
    array(
        array( 'text' => i18n('Web Search', 'r'),      'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'miscellaneous/websearch/websearch.ejs.php' ),
        array( 'text' => i18n('Address Book', 'r'),    'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'miscellaneous/addressbook/addressbook.ejs.php' ),
        array( 'text' => i18n('Office Notes', 'r'),    'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'miscellaneous/office_notes/office_notes.ejs.php' ),
        array( 'text' => i18n('My Settings', 'r'),     'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'miscellaneous/my_settings/my_settings.ejs.php' ),
        array( 'text' => i18n('My Account', 'r'),      'leaf' => true, 'cls' => 'file', 'hrefTarget' => 'miscellaneous/my_account/my_account.ejs.php' ),
    )
);
// *************************************************************************************
// Test Folder
// *************************************************************************************
$test_folder = array( 'text' => i18n('Test', 'r'), 'cls' => 'folder', 'expanded' => true, 'children' =>
    array(
    )
);
// *************************************************************************************
// Here we can parse and edit folders keys values, before pushing them into $nav
// ei. $admin_folder['expanded'] = false;
// *************************************************************************************

// $patient_folder['expanded']  = $_SESSION['nav']['patient_folder']['expanded'];
// $fees_folder['expanded']     = $_SESSION['nav']['fees_folder']['expanded'];
// $admin_folder['expanded']    = $_SESSION['nav']['admin_folder']['expanded'];
// $misc_folder['expanded']     = $_SESSION['nav']['misc_folder']['expanded'];


// TODO: ACL will determine which folders will be push to $nav array. IMPORTANT!
// *************************************************************************************
// Lets push all the folders into $nav and print json return
// *************************************************************************************
array_push( $nav, $patient_folder, $fees_folder, $admin_folder, $misc_folder, $test_folder );
print_r(json_encode($nav));
?>
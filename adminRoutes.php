<?php


/**
 * Quick Link Routes
 */

$router->map('GET','/view_staff',  function( ) {
    require __DIR__ . '/controller/backend/admin/view_staff.php';
} , 'view_staff');

$router->map('POST','/form_view_staff',  function( ) {
    require __DIR__ . '/controller/backend/admin/form_view_staff.php';
} , 'form_view_staff');

$router->map('GET','/edit_staff',  function( ) {
    require __DIR__ . '/controller/backend/admin/edit_staff.php';
} , 'edit_staff');

$router->map('POST','/delete_staff',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_staff.php';
} , 'delete_staff');

/**
 * Admin Routes
 */

$router->map('GET','/dashboard',  function( ) {
    require __DIR__ . '/controller/backend/admin/dashboard.php';
} , 'dashboard');

$router->map('GET','/procurement',  function( ) {
    require __DIR__ . '/controller/backend/admin/procurement.php';
} , 'procurement');

$router->map('GET','/sites',  function( ) {
    require __DIR__ . '/controller/backend/admin/sites.php';
} , 'sites');

$router->map('GET','/employees-list',  function( ) {
    require __DIR__ . '/controller/backend/employee/employees-list.php';
} , 'employees-list');

$router->map('GET','/assetissuance',  function( ) {
    require __DIR__ . '/controller/backend/employee/assetissuance.php';
} , 'assetissuance');

$router->map('GET','/receiveable',  function( ) {
    require __DIR__ . '/controller/backend/employee/receiveable.php';
} , 'receiveable');

$router->map('GET','/inventory',  function( ) {
    require __DIR__ . '/controller/backend/employee/inventory.php';
} , 'inventory');

$router->map('GET','/report',  function( ) {
    require __DIR__ . '/controller/backend/employee/report.php';
} , 'report');

$router->map('POST','/postreport',  function( ) {
    require __DIR__ . '/controller/backend/employee/postreport.php';
} , 'postreport');

$router->map('GET','/employees',  function( ) {
    require __DIR__ . '/controller/backend/employee/employees.php';
} , 'employees');

$router->map('GET','/profile/[*:sid]',  function($sid) {
    require __DIR__ . '/controller/backend/profile/profile.php';
} , 'profile');

$router->map('GET','/uploadtypes',  function( ) {
    require __DIR__ . '/controller/backend/admin/uploadtypes.php';
} , 'uploadtypes');

/**
 * Unit Routes
 */
$router->map('GET','/unit/[*:oid]',  function( $oid ) {
    require __DIR__ . '/controller/backend/admin/unit.php';
} , 'unit');

$router->map('POST','/add_unit',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_unit.php';
} , 'add_unit');

$router->map('POST','/update_unit',  function( ) {
    require __DIR__ . '/controller/backend/admin/update_unit.php';
} , 'update_unit');

$router->map('GET','/edit_unit/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/edit_unit.php';
} , 'edit_unit');

$router->map('POST','/delete_unit',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_unit.php';
} , 'delete_unit');


/**
 * Unit Details Routes
 */

$router->map('GET','/unitdetails/[*:oid]',  function( $oid ) {
    require __DIR__ . '/controller/backend/admin/unitdetails.php';
} , 'unitdetails');

$router->map('GET','/get_posting/[*:ippis]',  function( $ippis ) {
    require __DIR__ . '/controller/backend/admin/get_posting.php';
} , 'get_posting');

$router->map('POST','/add_member',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_member.php';
} , 'add_member');




/**
 * Posting Routes
 */
$router->map('GET','/postings',  function( ) {
    require __DIR__ . '/controller/backend/admin/postings.php';
} , 'postings');

$router->map('GET','/get_units/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/get_units.php';
} , 'get_units');

$router->map('POST','/add_posting',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_posting.php';
} , 'add_posting');

$router->map('POST','/update_posting',  function( ) {
    require __DIR__ . '/controller/backend/admin/update_posting.php';
} , 'update_posting');

$router->map('GET','/edit_posting/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/edit_posting.php';
} , 'edit_posting');

$router->map('POST','/delete_posting',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_posting.php';
} , 'delete_posting');

$router->map('GET','/pendingposting',  function( ) {
    require __DIR__ . '/controller/backend/admin/pendingposting.php';
} , 'pendingposting');


/**
 * Async Calls
 */

 /** Office Structure */
$router->map('POST','/add_office',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_office.php';
} , 'add_office');

$router->map('POST','/update_office',  function( ) {
    require __DIR__ . '/controller/backend/admin/update_office.php';
} , 'update_office');

$router->map('GET','/edit_office/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/edit_office.php';
} , 'edit_office');

$router->map('POST','/delete_office',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_office.php';
} , 'delete_office');

/**Upload Types */
$router->map('POST','/add_type',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_type.php';
} , 'add_type');

$router->map('POST','/update_type',  function( ) {
    require __DIR__ . '/controller/backend/admin/update_type.php';
} , 'update_type');

$router->map('GET','/get_type/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/get_type.php';
} , 'get_type');

$router->map('POST','/delete_type',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_type.php';
} , 'delete_type');


/** Employee */


$router->map('POST','/add_employee',  function( ) {
    require __DIR__ . '/controller/backend/employee/add_employee.php';
} , 'add_employee');

$router->map('POST','/update_employee',  function( ) {
    require __DIR__ . '/controller/backend/employee/update_employee.php';
} , 'update_employee');

$router->map('GET','/edit_employee/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/employee/edit_employee.php';
} , 'edit_employee');

$router->map('GET','/edit_inventory/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/employee/edit_inventory.php';
} , 'edit_inventory');

$router->map('POST','/delete_employee',  function( ) {
    require __DIR__ . '/controller/backend/employee/delete_employee.php';
} , 'delete_employee');

$router->map('GET','/employeesajx',  function( ) {
    require __DIR__ . '/controller/backend/employee/employeesajx.php';
} , 'employeesajx');

/** Receivable */
$router->map('POST','/add_receivable',  function( ) {
    require __DIR__ . '/controller/backend/employee/add_receivable.php';
} , 'add_receivable');

$router->map('POST','/update_receivable',  function( ) {
    require __DIR__ . '/controller/backend/employee/update_receivable.php';
} , 'update_receivable');

$router->map('GET','/edit_receivable/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/employee/edit_receivable.php';
} , 'edit_receivable');

$router->map('POST','/delete_receivable',  function( ) {
    require __DIR__ . '/controller/backend/employee/delete_receivable.php';
} , 'delete_receivable');

$router->map('GET','/receivableajx',  function( ) {
    require __DIR__ . '/controller/backend/employee/receivableajx.php';
} , 'receivableajx');

/** Report */
$router->map('POST','/add_report',  function( ) {
    require __DIR__ . '/controller/backend/employee/add_report.php';
} , 'add_report');

$router->map('POST','/update_report',  function( ) {
    require __DIR__ . '/controller/backend/employee/update_report.php';
} , 'update_report');

$router->map('GET','/edit_report/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/employee/edit_report.php';
} , 'edit_report');

$router->map('POST','/delete_report',  function( ) {
    require __DIR__ . '/controller/backend/employee/delete_report.php';
} , 'delete_report');

$router->map('GET','/reportajx',  function( ) {
    require __DIR__ . '/controller/backend/employee/reportajx.php';
} , 'reportajx');

/** Employee Management */

/** Emergency Contact */
$router->map('POST','/add_emergency',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_emergency.php';
} , 'add_emergency');

$router->map('POST','/update_emergency',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_emergency.php';
} , 'update_emergency');

$router->map('GET','/get_emergency/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_emergency.php';
} , 'get_emergency');

$router->map('POST','/delete_emergency',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_emergency.php';
} , 'delete_emergency');

/**NOK Detail */
$router->map('POST','/add_nok',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_nok.php';
} , 'add_nok');

$router->map('POST','/update_nok',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_nok.php';
} , 'update_nok');

$router->map('GET','/get_nok/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_nok.php';
} , 'get_nok');

$router->map('POST','/delete_nok',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_nok.php';
} , 'delete_nok');

/**Education Details */
$router->map('POST','/add_education',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_education.php';
} , 'add_education');

$router->map('POST','/update_education',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_education.php';
} , 'update_education');

$router->map('GET','/get_education/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_education.php';
} , 'get_education');

$router->map('POST','/delete_education',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_education.php';
} , 'delete_education');


/** Training Routes */

$router->map('POST','/add_training',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_training.php';
} , 'add_training');

// $router->map('POST','/update_education',  function( ) {
//     require __DIR__ . '/controller/backend/profile/update_education.php';
// } , 'update_education');

// $router->map('GET','/get_education/[*:id]',  function( $id ) {
//     require __DIR__ . '/controller/backend/profile/get_education.php';
// } , 'get_education');

$router->map('POST','/delete_training',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_training.php';
} , 'delete_training');

/** Doc Upload */

$router->map('POST','/doc_upload',  function( ) {
    require __DIR__ . '/controller/backend/profile/doc_upload.php';
} , 'doc_upload');

$router->map('GET','/get_upload/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_upload.php';
} , 'get_upload');

$router->map('POST','/update_upload',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_upload.php';
} , 'update_upload');

$router->map('POST','/delete_upload',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_upload.php';
} , 'delete_upload');

$router->map('GET','/downloadall/[*:ssid]',  function( $ssid ) {
    require __DIR__ . '/controller/backend/profile/downloadall.php';
} , 'downloadall');

/** /Doc Upload */

/** Discipline Upload */
$router->map('POST','/add_discipline',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_discipline.php';
} , 'add_discipline');

$router->map('GET','/get_discipline/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_discipline.php';
} , 'get_discipline');

$router->map('POST','/update_discipline',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_discipline.php';
} , 'update_discipline');

$router->map('POST','/delete_discipline',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_discipline.php';
} , 'delete_discipline');
/** /Discipline Upload */

/** Requests Routes*/
$router->map('POST','/add_requests',  function( ) {
    require __DIR__ . '/controller/backend/profile/add_request.php';
} , 'add_requests');

$router->map('GET','/get_request/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/profile/get_request.php';
} , 'get_request');

$router->map('POST','/update_request',  function( ) {
    require __DIR__ . '/controller/backend/profile/update_request.php';
} , 'update_request');

$router->map('POST','/delete_request',  function( ) {
    require __DIR__ . '/controller/backend/profile/delete_request.php';
} , 'delete_request');
/** /Requests Routes */


/**Head Routes */

$router->map('GET','/heads',  function( ) {
    require __DIR__ . '/controller/backend/admin/heads.php';
} , 'heads');

$router->map('POST','/add_head',  function( ) {
    require __DIR__ . '/controller/backend/admin/add_head.php';
} , 'add_head');

$router->map('POST','/update_head',  function( ) {
    require __DIR__ . '/controller/backend/admin/update_head.php';
} , 'update_head');

$router->map('GET','/get_head/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/admin/get_head.php';
} , 'get_head');

$router->map('POST','/delete_head',  function( ) {
    require __DIR__ . '/controller/backend/admin/delete_head.php';
} , 'delete_head');

/** /Head Routes */
?>
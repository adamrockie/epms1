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

$router->map('GET','/assetissuance',  function( ) {
    require __DIR__ . '/controller/backend/employee/assetissuance.php';
} , 'assetissuance');

$router->map('GET','/receiveable',  function( ) {
    require __DIR__ . '/controller/backend/employee/receiveable.php';
} , 'receiveable');

$router->map('GET','/contract',  function( ) {
    require __DIR__ . '/controller/backend/employee/contract.php';
} , 'contract');

// procurement section 
$router->map('GET','/procurement_request',  function( ) {
    require __DIR__ . '/controller/backend/employee/procurement_request.php';
} , 'procurement_request');

$router->map('POST', '/add_request_item', function () {
    require __DIR__ . '/controller/backend/employee/add_request_item.php';
}, 'add_request_item');

$router->map('GET', '/get_item_request/[*:id]', function ($id) {
    $_GET['id'] = $id;
    require __DIR__ . '/controller/backend/employee/get_request_item.php';
}, 'get_item_request');
 
$router->map('POST', '/update_request_item', function () {
    require __DIR__ . '/controller/backend/employee/update_request_item.php';
}, 'update_request_item');
 
$router->map('POST', '/delete_item_request', function () {
    require __DIR__ . '/controller/backend/employee/delete_request_item.php';
}, 'delete_item_request');
 
$router->map('POST', '/add_item_remark', function () {
    require __DIR__ . '/controller/backend/employee/add_request_remark.php';
}, 'add_item_remark');




$router->map('POST','/add_inventory',  function( ) {
    require __DIR__ . '/controller/backend/employee/add_inventory.php';
} , 'add_inventory');


$router->map('GET','/inventory',  function( ) {
    require __DIR__ . '/controller/backend/employee/inventory.php';
} , 'inventory');

$router->map('POST','/update_inventory',  function( ) {
    require __DIR__ . '/controller/backend/employee/update_inventory.php';
} , 'update_inventory');

$router->map('GET','/view_inventory/[*:id]', function($id) {
    $_GET['id'] = $id;  
    require __DIR__ . '/controller/backend/employee/view_inventory.php';
}, 'view_inventory');

$router->map('POST','/reduce_qty', function() {
    require __DIR__ . '/controller/backend/employee/reduce_qty.php';
}, 'reduce_qty');

$router->map('GET','/report',  function( ) {
    require __DIR__ . '/controller/backend/employee/report.php';
} , 'report');

$router->map('POST','/invgenreport',  function( ) {
    require __DIR__ . '/controller/backend/employee/invgenreport.php';
} , 'invgenreport');

$router->map('POST','/recgenreport',  function( ) {
    require __DIR__ . '/controller/backend/employee/recgenreport.php';
} , 'recgenreport');

$router->map('GET','/profile/[*:sid]',  function($sid) {
    require __DIR__ . '/controller/backend/profile/profile.php';
} , 'profile');

$router->map('GET','/edit_inventory/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/employee/edit_inventory.php';
} , 'edit_inventory');

$router->map('GET','/request',  function( ) {
    require __DIR__ . '/controller/backend/employee/request.php';
} , 'request');


$router->map('GET','/view_request/[*:id]',  function($id) {
    $_GET['id'] = $id; 
    require __DIR__ . '/controller/backend/employee/view_request.php';
}, 'view_request');


$router->map('POST','/update_item_request',  function( ) {
    require __DIR__ . '/controller/backend/employee/update_item_request.php';
} , 'update_item_request');

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

/** Requests Routes*/
$router->map('GET','/pending_requests',  function( ) {
    require __DIR__ . '/controller/backend/requests/pending_requests.php';
} , 'pending_requests');

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

?>
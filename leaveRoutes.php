<?php


/**
 * Leave Management Routes
 */

$router->map('GET','/leave_management',  function(  ) {
    require __DIR__ . '/controller/backend/leave/leave_management.php';
} , 'leave_management');

$router->map('POST','/add_leave',  function(  ) {
    require __DIR__ . '/controller/backend/leave/add_leave.php';
} , 'add_leave');

$router->map('GET','/leave',  function(  ) {
    require __DIR__ . '/controller/backend/leave/leave.php';
} , 'leave');

$router->map('GET','/get_leave_details/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/leave/get_leave_details.php';
} , 'get_leave_details'); 

/**
 * Leave Types Routes
 */
$router->map('GET','/get_leave_type/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/leave/get_leave_type.php';
} , 'get_leave_type');

$router->map('POST','/add_leave_type',  function(  ) {
    require __DIR__ . '/controller/backend/leave/add_leave_type.php';
} , 'add_leave_type');

$router->map('POST','/post_update_leave_type',  function( ) {
    require __DIR__ . '/controller/backend/leave/post_update_leave_type.php';
} , 'post_update_leave_type');

$router->map('POST','/delete_leave',  function( ) {
    require __DIR__ . '/controller/backend/leave/delete_leave.php';
} , 'delete_leave');

 
?>
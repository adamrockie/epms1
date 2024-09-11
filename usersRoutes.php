<?php


/**
 * User Management Routes
 */

$router->map('GET','/users',  function(  ) {
    require __DIR__ . '/controller/backend/user/users.php';
} , 'users');

$router->map('GET','/get_user/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/user/get_user.php';
} , 'get_user');

$router->map('GET','/get_user2/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/user/get_user2.php';
} , 'get_user2');

$router->map('POST','/add_user',  function(  ) {
    require __DIR__ . '/controller/backend/user/add_user.php';
} , 'add_user');

$router->map('POST','/post_update_user',  function( ) {
    require __DIR__ . '/controller/backend/user/post_update_user.php';
} , 'post_update_user');

$router->map('POST','/delete_user',  function( ) {
    require __DIR__ . '/controller/backend/user/delete_user.php';
} , 'delete_user');

/**
 * Password Reset Section
 */

$router->map('GET','/confirm_password',  function(  ) {
    require __DIR__ . '/controller/frontend/confirm_password.php';
} , 'confirm_password');

$router->map('POST','/post_confirm_reset',  function(  ) {
    require __DIR__ . '/controller/frontend/post_confirm_reset.php';
} , 'post_confirm_reset');

$router->map('GET','/reset',  function(  ) {
    require __DIR__ . '/controller/frontend/reset.php';
} , 'reset');

$router->map('POST','/post_password',  function(  ) {
    require __DIR__ . '/controller/frontend/post_password.php';
} , 'post_password');

$router->map('GET','/verify',  function(  ) {
    require __DIR__ . '/controller/frontend/verify.php';
} , 'verify');

$router->map('GET','/register',  function(  ) {
    require __DIR__ . '/controller/frontend/register.php';
} , 'register');

$router->map('POST','/post_register',  function(  ) {
    require __DIR__ . '/controller/frontend/post_register.php';
} , 'post_register');

$router->map('GET','/change_password',  function(  ) {
    require __DIR__ . '/controller/backend/user/change_password.php';
} , 'change_password');

$router->map('POST','/post_change_password',  function(  ) {
    require __DIR__ . '/controller/backend/user/post_change_password.php';
} , 'post_change_password'); 

$router->map('POST','/checkpassword',  function(  ) {
    require __DIR__ . '/controller/backend/user/checkpassword.php';
} , 'checkpassword');

 
?>
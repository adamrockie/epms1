<?php


/**
 * Role Management Routes
 */

$router->map('GET','/roles',  function(  ) {
    require __DIR__ . '/controller/backend/role/roles.php';
} , 'roles');

$router->map('GET','/get_role/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/role/get_role.php';
} , 'get_role');


$router->map('POST','/add_role',  function(  ) {
    require __DIR__ . '/controller/backend/role/add_role.php';
} , 'add_role');

$router->map('POST','/update_role',  function( ) {
    require __DIR__ . '/controller/backend/role/update_role.php';
} , 'update_role');

$router->map('POST','/delete_role',  function( ) {
    require __DIR__ . '/controller/backend/role/delete_role.php';
} , 'delete_role');

$router->map('POST','/add_permission',  function(  ) {
    require __DIR__ . '/controller/backend/role/add_permission.php';
} , 'add_permission');

 
?>
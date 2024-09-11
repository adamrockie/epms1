<?php

require_once 'Classes/AltoRouter.php';

$router = new AltoRouter();
$router->setBasePath('/epms1');

/**
 * Frontend Routes
 */

$router->map('GET','/',  function(  ) {
    require __DIR__ . '/controller/frontend/login.php';
} , 'home');

$router->map('GET','/home',  function(  ) {
    require __DIR__ . '/controller/frontend/login.php';
} , 'home2');


$router->map('GET','/login',  function(  ) {
    require __DIR__ . '/controller/frontend/login.php';
} , 'login');

$router->map('POST','/post_login',  function(  ) {
    require __DIR__ . '/controller/frontend/post_login.php';
} , 'process_login');


$router->map('GET','/logout',  function(  ) {
    require __DIR__ . '/controller/backend/logout.php';
} , 'logout');


$router->map('GET','/passwordreset',  function(  ) {
    require __DIR__ . '/controller/frontend/passwordreset.php';
} , 'passwordreset');

$router->map('POST','/post_reset',  function(  ) {
    require __DIR__ . '/controller/frontend/post_reset.php';
} , 'post_reset');


/**
 * Admin Routes
 */
include_once 'adminRoutes.php';

/**
 * Admin Routes
 */

 /**
  * Users Routes
  */

  include_once 'usersRoutes.php';
  include_once 'rolesRoutes.php';
  include_once 'leaveRoutes.php';
  include_once 'apiRoutes.php';
  
  /***
   * Users Routes
   */




/**
 * AJAX Section
 */
$router->map('POST','/checkuser',  function(  ) {
    require __DIR__ . '/controller/backend/checkuser.php';
} , 'checkuser');

$router->map('POST','/checkemail',  function(  ) {
    require __DIR__ . '/controller/backend/checkemail.php';
} , 'checkemail');

$router->map('GET','/get_lga/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/get_lga.php';
} , 'get_lga');



// match current request
$match = $router->match();


if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] ); 
} else {
    // no route was matched
    //header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require __DIR__ . '/404.html';
}

<?php


/**
 * API Routes
 */

//Get a staff current department
$router->map('GET','/api_staff_dept/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/api/api_staff_dept.php';
} , 'api_staff_dept');

//Get a list of all departments
$router->map('GET','/api_depts',  function(  ) {
    require __DIR__ . '/controller/backend/api/api_depts.php';
} , 'api_depts');

//Get the detail of a single department
$router->map('GET','/api_dept/[*:dept]',  function( $dept ) {
    require __DIR__ . '/controller/backend/api/api_dept.php';
} , 'api_dept');

//Get a list of all available units in all department
$router->map('GET','/api_units',  function(  ) {
    require __DIR__ . '/controller/backend/api/api_units.php';
} , 'api_units');

//Get the detail of a single unit
$router->map('GET','/api_unit/[*:uid]',  function( $uid ) {
    require __DIR__ . '/controller/backend/api/api_unit.php';
} , 'api_unit');

//Get a staff list of a department
$router->map('GET','/api_dept_staff/[*:did]',  function( $did ) {
    require __DIR__ . '/controller/backend/api/api_dept_staff.php';
} , 'api_dept_staff');

//Get a staff current status
$router->map('GET','/api_validate_staff/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/api/api_validate_staff.php';
} , 'api_validate_staff');

//Get a list of all staff of the office
$router->map('GET','/api_staff',  function(  ) {
    require __DIR__ . '/controller/backend/api/api_staff.php';
} , 'api_staff');

//Get a staff details
$router->map('GET','/api_staff/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/api/aapi_staff.php';
} , 'asapi_staff');

//Get a list of all directors in the office
$router->map('GET','/api_heads',  function(  ) {
    require __DIR__ . '/controller/backend/api/api_heads.php';
} , 'api_heads');

//Get director of a department
$router->map('GET','/api_head/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/api/api_head.php';
} , 'api_head');

//Get a list of all available ranks
$router->map('GET','/api_ranks',  function( ) {
    require __DIR__ . '/controller/backend/api/api_ranks.php';
} , 'api_ranks');

$router->map('GET','/api_doctypes',  function( ) {
    require __DIR__ . '/controller/backend/api/api_doctypes.php';
} , 'api_doctypes');

$router->map('GET','/api_doc',  function(  ) {
    require __DIR__ . '/controller/backend/api/api_doc.php';
} , 'api_doc');

$router->map('GET','/api_doc/[*:id]',  function( $id ) {
    require __DIR__ . '/controller/backend/api/aapi_doc.php';
} , 'aapi_doc');


 
?>
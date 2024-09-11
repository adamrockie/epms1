<?php
require "config.php";
require_once 'twig.php';

use Classes\Config;
use Classes\Redirect;
use Database\Models\Users as UserModel;
use Classes\Session;
use Database\Models\Employees;
use Database\Models\Offices;

//$user = new User();


//Pagination
/*
$total = Employees::where('status', '=', 'active')->get()->count();//->orwhere('membership_status', '=', 'Lifetime achievement fellow')->get()->count();
$current_page = null;

if($_GET) {
$current_page = $_GET['page'];   

    if(!$current_page){
        //Redirect::to('fellowsdirectory?page=1');
        echo "<script> window.location = 'employees-list?page=1'; </script>";
    }
}

$rcount = 'empty';

if (isset($_GET['page']) && $_GET['page']!="") { $page = $_GET['page']; } else { $page = 1; }

$perpage = 50;

$skip = ($page-1) * $perpage;
$previous_page = $page - 1;
$next_page = $page + 1;
$adjacents = "2";
$total_pages = ceil($total/$perpage);
$second_last = $total_pages - 1;

*/


$response = array();
$data = array();
$employees_count = Employees::with('office')->with('designation')->get()->count();

if($employees_count > 0):

$employees_ajx = Employees::with('office')->with('designation')->get()->sortBy('names')->toArray();

foreach ($employees_ajx as $key => $employee) {

    
    $response[$key]['ippis'] = $employee['ippis'];
    $response[$key]['staff_num'] = $employee['staff_num'];
    $response[$key]['names'] = $employee['names'];
    $response[$key]['jde_num'] = $employee['jde_num'];
    $response[$key]['branch_code'] = $employee['branch_code'];
    $response[$key]['dob'] = $employee['dob'];
    $response[$key]['doe'] = $employee['doe'];
    $response[$key]['designation'] = $employee['designation']['designation'];
    $response[$key]['level'] = $employee['level'];
    $response[$key]['gender'] = $employee['gender'];    
    $response[$key]['phone'] = $employee['phone'];
    $response[$key]['nationality'] = $employee['nationality'];
    $response[$key]['office'] = $employee['office']['name'];
    $response[$key]['passport'] = $employee['passport'];
    $response[$key]['status'] = $employee['status'];

}

foreach ($response as $value) {

    $data[] = $value;

}


echo json_encode([
    'status'    =>'success',
    'data'      =>$data,
]);

else:

    [$status, $message] = ['error', 'An error occurred, employees could not be retrieved'];
    echo json_encode([
        'status'=>$status, 
        'msg'=>$message
    ]);

endif;

exit;

if($user->isLoggedIn()){

    
    $sessionName= Config::get('session/session_name');
    $id         = Session::get($sessionName);
    $userc      = UserModel::where('id', '=', $id)->first();

    $offices = Offices::all();
   
    echo $twig->render('backend/employee/employees.html.twig', [
        'title'             => 'Employees',
        'userc'             => $userc,
        'offices'           => $offices,        
        ]);


}else{
    Redirect::to('home');
}

?>
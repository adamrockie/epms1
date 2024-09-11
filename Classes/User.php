<?php
/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;

use Classes\Session;
use Classes\DB;
use Classes\Config;
use Classes\Hash;
use Classes\Cookie;
use Database\Models\Users as UserModel;
use Database\Models\Sessions as SessionsModel;

class User{

    private $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;
    

    public function __construct($user = null){
        //$this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');

        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
               
                if($this->find($user)){

                    $this->_isLoggedIn = true;
                }else{
                    //Process Logout
                }
            }
        }else{
            $this->find($user);
        }
    }

    public function update($fields = array(), $userId = null){
        if(!$userId &&  $this->isLoggedIn()){
            $userId = $this->data()->userId;
        }

        if(!$this->_db->update('userstable', $userId, $fields)){
            throw new Exception('There was a problem updating.');
        }
    }

    public function create($fields = array()){
        if(!$this->_db->insert('userstable', $fields)){
            throw new Exception('There was a problem creating the account.');
        }
    }
    
    public function sessionfind($user = null){
        if($user){
            //$field = (is_numeric($user)) ? 'userId' : 'username';
            $data = UserModel::where('email', '=', $user)->first();
            //$data = $this->_db->get('userstable', array($field, '=', $user));

            if(!is_null($data)){
                $this->_data = $data->first();
                return $this->_data;
            } 
          
        }
        return false;
    }

    public function find($user = null){
        
        if($user){
            if(is_numeric($user)){
                $data = UserModel::where('id', '=', $user)->first();   
            }else{
                $data = UserModel::where('email', '=', $user)->first();
            }
            
            if(!is_null($data)){

                $this->_data = $data->first();
                return true;
            }else{
                return false;
            }
          
        }
        return false;
    }


    public function login($email = null, $password = null, $remember = false){

        if(!$email && !$password && $this->exists()){

            $data = UserModel::where('email', '=', $email)->first();
            Session::put($this->_sessionName, $data->id);

        }else{
            
            $user = $this->find($email);

            if($user){

                $data = UserModel::where('email', '=', $email)->first();

                if($data->status==='active'){

                    if(password_verify($password, $data->password)){

                        Session::put($this->_sessionName, $data->id);

                        if($remember){
                            $hash = Hash::unique();
                            $hashCheck = SessionsModel::where('user_id', '=', $data->id)->first();


                            if(!$hashCheck){
                                SessionsModel::insert(
                                    ['user_id'=> $data->id, 'hash' => $hash]
                                );
                            }else{
                                $hash = $hashCheck->first()->hash;
                            }
                            Cookie::put($this->_cookieName, $hash, (86400 * 90));
                        }
                        return true;
                    }

                }else{

                    Session::flash('auth', 'Account not verified or disabled');
                    Redirect::to('login');

                }
            }

        }
        return false;
    }

    public function hasPermission($key){
        
        $group = $this->_db->get('groups', array('name','=', $this->data()->user_role));

        if($group->count()){

            $permissions = json_decode($group->first()->permissions, true);
            
            if($permissions[$key] == true){
                return true;
            }
        }
        return false;

    } 

    public function exists(){
        return (!empty($this->_data)) ? true : false; 
    }

    public function logout(){
        $sessionName = Config::get('session/session_name');
        $session = Session::get($sessionName); 

        //$data = UserModel::where('email', '=', $email)->first();
        //$this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
        SessionsModel::where('user_id', '=', $session)->delete();
        
        Session::delete($this->_sessionName);
        //Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedIn;
    }


    public function countall($tocount=null){
        count($tocount);
        return $this;
    }


    public function allStates($table = null){
        if($table){
            $data = $this->_db->getAll('states', $table);

            if($data->count()){
                $this->_data = $data->all();
                return true;
            }

        }
        return false;
    }

    public function findState($sid = null){
        if($sid){
            $field = (is_numeric($sid)) ? 'state_id' : 'username';
            $data = $this->_db->get('states', array($field, '=', $sid));

            if($data->count()){
                $this->_data = $data->first();
                return true;
            } 
          
        }
        return false;
    }


    
}
<?php 

/**
 * One framework
 * Author: Lamidi Ismaila
 * Email: dgoldenone@gmail.com
 */

namespace Classes;

use Classes\Config;



class DB {
    private static $_instance = null;
    private $_pdo,
            $_error,
            $_query = false,
            $_results,
            $_count = 0; 
    private function __construct(){
        try {
            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
        }catch (PDOExceptio $e){
            die($e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params=array()){
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){
            $x=1;
            if(count($params)){
                foreach ($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table,$where=array()){
        if(count($where)===3){
            $operators = array('=','>','<','>=','<=');
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }

        }
        return false;

    }

    public function sortedaction($action, $table,$where=array(), $sorted_field){
        if(count($where)===3){
            $operators = array('=','>','<','>=','<=');
            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ORDER BY {$sorted_field} DESC LIMIT 1";

                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }

        }
        return false;

    }

    public function actionAll($action, $table){          
            $value = null;  
            $sql = "{$action} FROM {$table}";
                if(!$this->query($sql,array($value))->error()){
                    return $this;
                }
           
    }

    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);

    }

    public function getsorted($table, $where, $sorted){
        return $this->sortedaction('SELECT *', $table, $where, $sorted);

    }

    public function getAll($table){
        return $this->actionAll('SELECT *', $table);

    }

    
    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);

    }

    public function insert($table, $fields = array()){
    
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach($fields as $field){
            $values .= '?';

            if($x < count($fields)){
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
        
        if(!$this->query($sql, $fields)->error()){
            return true;
        }

        return false;
    }

    public function update($table, $id, $fields){
        $set = '';
        $x = 1;

        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
       
        $sql = "UPDATE {$table} SET {$set} WHERE userId = {$id}";

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }

    public function results(){
        return $this->_results;   
    }

    public function first(){
        return $this->results()[0];
    }

    public function all(){
        return $this->results();
    }

    public function error(){
        return $this->_error;
    }

    public function count(){
        return $this->_count;
    }
}

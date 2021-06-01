<?php 

class User{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function findUserByEmail($email){
        $sql = 'SELECT email FROM customers WHERE email=:email';
        $values = [':email',$email];
        if($this->db->queryDB($sql,Database::SELECTSINGLE,$values)->email == $email){
            return true;
        }
        else{
            return false;
        }

    }
    public function register($data){
        $sql = "INSERT INTO customers(firstName,lastName,email,password) VALUES(:firstName,:lastName,:email,:password)";
        $values = array([':firstName',$data['firstName']],[':lastName',$data['lastName']],[':email',$data['email']],[':password',$data['password']]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            return false;
        }
    }
}
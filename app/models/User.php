<?php 

class User{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function findUserByEmail($email){
        $sql = 'SELECT email FROM users WHERE email=:email';
        $values = [':email',$email];
        if($this->db->queryDB($sql,Database::SELECTSINGLE,$values)->email == $email){
            return true;
        }
        else{
            return false;
        }

    }
    public function register($data){
        $sql = "INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
        $values = array([':name',$data['name']],[':email',$data['email']],[':password',$data['password']]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            return false;
        }
    }
}
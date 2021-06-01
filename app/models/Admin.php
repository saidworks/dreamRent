<?php 

class Admin{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }
    public function findAdminByEmail($email){
        $sql = 'SELECT email FROM admins WHERE email=:email';
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

    public function login($email,$password){
        $sql = "SELECT * FROM customers WHERE email=:email";
        $values = [':email',$email];
        $row = $this->db->queryDB($sql,Database::SELECTSINGLE,$values);
        $hashed_password = $row->password;
        if(password_verify($password,$hashed_password)){
            return $row;
        } 
        else{
            return false;
        }
    }
    public function getUserById($id){
        $sql = 'SELECT * FROM admins WHERE id=:id';
        $values = [':id',$id];
        $row = $this->db->queryDB($sql,Database::SELECTSINGLE,$values);
        if($row->id == $id){
            return $row;
        }
        else{
            return false;
        }

    }
}
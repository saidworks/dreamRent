<?php
class Post {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
        
    }
    public function getPosts(){
        $sql = "SELECT *,v.id as vehicleId
                FROM vehicle as v
                LEFT JOIN vehicle_category as c
                ON v.CategoryId = c.id
                ";
        $result = $this->db->queryDB($sql,Database::SELECTALL);
        return $result;
    }
    public function addPost($data){
        $sql = "INSERT INTO vehicle(categoryId,picture,description,rate) VALUES(:categoryId,:picture,:description,:rate)";
        $values = array([':categoryId',$data['categoryId']],[':picture',$data['picture']],[':description',$data['description']],[':rate',$data['rate']]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            return false;
        }

    }
    public function getPostById($id){
        $sql = 'SELECT * FROM vehicle WHERE id=:id';
        $values = [':id',$id[0]];
        $row = $this->db->queryDB($sql,Database::SELECTSINGLE,$values);
        return $row;
    }
    public function getCategory(){
        
    }

    public function editPost($data){
        $sql = "UPDATE vehicle SET categoryId=:categoryId,picture=:picture,description=:description,rate=:rate WHERE id=:id";
        $values = array([':categoryId',$data['categoryId']],[':picture',$data['picture']],[':description',$data['description']],[':rate',$data['rate']],[':id',$data['id'][0]]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            return false;
        }
    }
    public function deletePost($id){
        $sql = "DELETE FROM vehicle WHERE id=:id";
        $values =[':id',$id];
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            return false;
        }
    }

}
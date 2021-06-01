<?php
class Booking {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getPosts(){
        $sql = "SELECT v.id as vehicleId,v.categoryId as categoryId ,v.rate as rate,v.picture as picture,v.description as description
                FROM vehicle as v
                LEFT JOIN vehicle_category as c
                ON v.CategoryId = c.id
                ";
        $result = $this->db->queryDB($sql,Database::SELECTALL);
        return $result;
    }
    public function booking($data){
        // need customer id 
        $sql = "INSERT INTO rentals(customerId,dateOut,dateReturned,vehicleId,vehicleCategoryId,paymentMethod,totalPaid ) VALUES(:customerId,:dateOut,:dateReturned,:vehicleId,:vehicleCategoryId,:paymentMethod,:totalPaid)";
        $diff= (int)((strtotime($data["dateReturned"]) - strtotime($data["dateOut"])));
        $totalPaid = $diff/(3600*24) * $data['rate'];
        $values = array([':customerId',$data['user_id']],[':dateOut',$data['dateOut']],[':dateReturned',$data['dateReturned']],[':vehicleId',$data['vehicleId'][0]],[':vehicleCategoryId',$data['categoryId']],[':paymentMethod',$data['paymentMethod']],[':totalPaid',$totalPaid]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            var_dump($totalPaid);
            return false;
        }
    }


}
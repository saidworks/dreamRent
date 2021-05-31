<?php
class Booking {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function getPosts(){
        $sql = "SELECT v.id as vehicleId,v.categoryId as categoryId ,v.rate as rate,v.picture as picture
                FROM vehicle as v
                LEFT JOIN vehicle_category as c
                ON v.CategoryId = c.id
                ";
        $result = $this->db->queryDB($sql,Database::SELECTALL);
        return $result;
    }
    public function booking($data){
        // need customer id 
        $sql = "INSERT INTO rentals(customerId,dateOut,dateReturned,vehcileId,vehicleCategoryId,paymentMethod,totalPaid ) VALUES(:customerId,:dateOut,:dateReturned,:vehicleId,:vehicleCategoryId,:paymentMethod,:totalPaid)";
        $diff= ((strtotime($data["dateReturned"]) - strtotime($data["dateOut"])));
        $totalPaid = (int)$diff/(3600*24) * $data['rent'];
        var_dump($totalPaid);
        $values = array([':customerId',$data['user_id']],[':dateOut',$data['dateOut']],[':dateReturned',$data['dateReturned']],[':vehicleId',$data['vehicleId']],[':vehicleCategoryId',$data['categoryId']],[':paymentMethod',$data['paymentMethod']],[':totalPaid',$totalPaid]);
        if($this->db->queryDB($sql,Database::EXECUTE,$values)){
            return true;
        }
        else{
            var_dump($totalPaid);
            return false;
        }
    }


}
<?php 
/* PDO database class:
    * Connect to database
    * Create prepared statements 
    * Bind Values 
    * Return rows and results 
*/
class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    const SELECTSINGLE = 1;
    const SELECTALL = 2;
    const EXECUTE = 3;

    private $dbh;
    private $stmt;
    private $error;
    public function __construct(){
        // set DSN 
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        //create PDO instance 
        try{
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    // Prepare statements with query
    // function from blog project to be adapted 
    // it takes an sql statement and mode like select single value and values as array
    /* for values it need always to be [:placeholder,placeholder] => value[0] = ':placeholder' */ 
    public function queryDB($sql,$mode,$values=null){
        // $type = null;
        //prepare 
        $this->stmt = $this->dbh->prepare($sql);
        //bind value if entered
        if($values){
            foreach($values as $value){
                if(is_array($value)){   
                $this->stmt->bindValue($value[0],$value[1]);}
                else{
                $this->stmt->bindValue($values[0],$values[1]);
                    }
                }
            }
        //execute
        if($this->stmt->execute()){
        //check mode
        if(in_array($mode,array(self::EXECUTE,self::SELECTALL,self::SELECTSINGLE))){
            if($mode==self::SELECTALL){
                $result = $this->stmt -> fetchAll(PDO::FETCH_OBJ);
                return $result;
                }
            elseif($mode==self::SELECTSINGLE){
                $result = $this->stmt -> fetch(PDO::FETCH_OBJ);
                return $result;
                }
            elseif($mode==self::EXECUTE){
                return true;
            }
            } 
        else{
            throw new Exception('<br> Invalid mode');
         }
        }
    }
    // get row count 
    public function rowCount(){
        return $this->stmt->rowCount();
    }
} 

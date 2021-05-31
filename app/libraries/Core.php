<?php 
/* 
* Main app core Class
* Creates URL and loads core controller
* URL Format -/controller/method/params
*/

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'Index';
    protected $params = [];
    
    public function __construct(){
        // print_r($this->getUrl());
        $url = $this->getUrl();
        //look in controllers for first value 
        //ucwords capitalize first letter
        if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
            // if exists then set as controller 
            $this->currentController = ucwords($url[0]);
            //unset 0 index
            unset($url[0]);
        }
        //require the controller 
        require_once '../app/controllers/'.$this->currentController.'.php';
        //instantiate controller class 
        $this->currentController = new $this->currentController;
        //check second part of url 
        if(isset($url[1])){
            //check to see if methods exists in controller 
            if(method_exists($this->currentController,$url[1])){
                $this->currentMethod = $url[1];  
            }
            unset($url[1]); 
        }
        
        // Get parameters 
        $this->params = $url ? array_values($url) : [];
        // Call a callback with array of params 
        call_user_func([$this->currentController,$this->currentMethod],$this->params);
    }
    
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }

    }
}
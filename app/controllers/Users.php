<?php
class Users extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('User');
        }
    public function register(){
        // Check for post
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //proces form
                //sanitize POST data 
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
               //init data 
               $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'repassword' => trim($_POST['repassword']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'repassword_error' =>''
            ];
                // Validate email 
                if(empty($data['email'])){
                $data['email_err'] = 'Please enter your email';    
                }
                if($this->userModel->findUserByEmail($data['email'])){
                $data['email_err'] = 'There is an account with this email';    
                }
                // Validate name 
                if(empty($data['name'])){
                    $data['name_err'] = 'Please enter your name';    
                    }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';    
                    }
                elseif(strlen($data['password'])<6){
                    $data['password_err'] = "Password can't be less than 6 characters";
                }
                // Validate password confirmation
                if(empty($data['repassword'])){
                    $data['repassword_err'] = 'Please enter your password confirmation';    
                    }
                else{
                    if($data['password'] != $data['repassword']){
                        $data['repassword_err'] = 'Password confirmation does not match with password';  
                    }
                }
                //make sure  errors are empty
                if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['repassword_err'])){
                    // Validated 
                    //Process using model
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT); 
                    //insert values into database
                   if($this->userModel->register($data)){
                       header('location:'.URLROOT.'/users/login');
                   }
                    
                }
                else{
                    //load view with errors
                    $this->view('users/register',$data);
                }                
        }
        else{
            //init data 
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'repassword' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'repassword_error' =>''
            ];
            //load view 
            $this->view('users/register',$data);
        }
    }
    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
             //proces form
                //sanitize POST data 
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
               //init data 
               $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];
                // Validate email 
                if(empty($data['email'])){
                $data['email_err'] = 'Please enter your email';    
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';    
                    }
                //make sure  errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated 
                    die('Success');
                }
                else{
                    //load view with errors
                    $this->view('users/login',$data);
                }                
        }
        else{
             //init data 
             $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];
            //load view 
            $this->view('users/login',$data);
        }
    }

}
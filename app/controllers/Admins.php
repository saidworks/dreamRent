<?php
class Admins extends Controller {
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
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
                       // check for user/email 
                if($this->adminModel->findAdminbyEmail($data['email'])){
                    //User found
                    // check and set logged in user
                    $loggedInUser = $this->adminModel->login($data['email'],$data['password']);
                    if($loggedInUser){
                        //create session variables
                        $this->createUserSession($loggedInUser);
                    }
                    else{
                        $data['password_err'] = 'Password incorrect';
                        $this->view('admins/login',$data);
                    }
                }
                else{
                    $data['email_err'] = 'no user found';
                }
                }
                else{
                    //load view with errors
                    $this->view('admins/login',$data);
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
            $this->view('admins/login',$data);
        }
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_firstName']);
        unset($_SESSION['user_lastName']);
        session_destroy();
        redirect('pages/index');
        
    }
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_firstName'] = $user->firstName;
        $_SESSION['user_lastName'] = $user->lastName;
        redirect('posts/index');
    }
  
}
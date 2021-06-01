<?php 
class Bookings extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('/users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->bookingModel = $this->model('Booking');
    }
    public function index(){
        // get the posts 
        $posts = $this->bookingModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('bookings/index',$data);
    }
    public function booking($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize POST array 
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
             
            
        $data = [
            'categoryId' => trim($_POST['categoryId']),
            'rate' => trim($_POST['rate']),
            'user_id' => $_SESSION['user_id'],
            'dateOut' => trim($_POST['dateOut']),
            'dateReturned' => trim($_POST['dateReturned']),
            'vehicleId' => trim($_POST['vehicleId']),
            'paymentMethod' => trim($_POST['paymentMethod']),
            'categoryId_err' => '',
            'payment_err' => '',
            'dateOut_err' => '',
            'dateReturned_err' => ''
        ];
       
        //form validation 
        // validate categoryId
        if(empty($data['categoryId'])){
            $data['categoryId_err'] = 'Please enter category id';
        }
        if(empty($data['rate'])){
            $data['rate_err'] = 'Please enter rental rate';
        }
        if(empty($data['paymentMethod'])){
            $data['payment_err'] = 'Please choose payment method';
        }
        // validate dates
        if(empty($data['dateOut'])){
            $data['dateOut_err'] = 'Please choose a date for pick up';
        }
        if(empty($data['dateReturned'])){
            $data['dateReturned_err'] = 'Please choose a date for drop off';
        }
        // make sure no errors 
        if(empty($data['categoryId_err']) && empty($data['payment_err']) && empty($data['rate_err'])){
            // validated
            if($this->bookingModel->booking($data)){
                flash('post_message','Reserved successfully');
                redirect('bookings');
            }
            else{
                die('something went wrong');
            }
        }
        else{
            //Load view with errors
            $this->view('bookings/booking',$data);

        }
    }
    else {
        $post = $this->postModel->getPostById($id);
        //check for owner 
        if($_SESSION['user_email'] != 'zitouni.sd@gmail.com'){
            redirect('posts');
        }
        $data = [
            'user_id' => $_SESSION['user_id'],
            'vehicleId' => $id,
          'description' => $post->description,
          'picture' => $post->picture ,
          'categoryId' => $post->categoryId,
          'rate' => $post->rate
        ];
        
        $this->view('bookings/booking',$data);
    }

    }
    
}
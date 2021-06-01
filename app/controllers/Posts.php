<?php 
class Posts extends Controller{
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('/users/login');
        }
          //check for owner 
          if($_SESSION['user_email'] != 'zitouni.sd@gmail.com'){
            redirect('bookings');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index(){
        // get the posts 
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index',$data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize POST array 
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
             // upload picture
                $directory = URLROOT;
                $destination = $directory.$_FILES['upload']['name'];
                $filename =$_FILES['upload']['tmp_name'];
                if(isset($_POST["submit"])){
                    if($_FILES['upload']['error']==0){
                        // switch($_FILES['upload']['type']){
                        //     case[]

                        // }  
                    if (move_uploaded_file($filename,$destination)){
                        echo "<h2 class='main__title'> Product added successfully<h2><br>";
                        
                    }
                        else  {
                        echo "failure";
                    }
                    }
                        else {
                            if($_FILES['upload']['error']==1 || $_FILES['upload']['error']==2){
                                echo "Your file is too big please select a smaller one! then try again!<br>";}
                            else{
                                echo "your file is only partly uploaded";
                                }
                    }

                    }
            
        $data = [
            'categoryId' => trim($_POST['categoryId']),
            'description' => trim($_POST['description']),
            'rate' => trim($_POST['rate']),
            'picture' => $destination,
            'user_id' => $_SESSION['user_id'],
            'categoryId_err' => '',
            'description_err' => ''
        ];
       
        //form validation 
        // validate categoryId
        if(empty($data['categoryId'])){
            $data['categoryId_err'] = 'Please enter category id';
        }
        if(empty($data['rate'])){
            $data['rate_err'] = 'Please enter rental rate';
        }
        if(empty($data['description'])){
            $data['description_err'] = 'Please enter description text';
        }
        // make sure no errors 
        if(empty($data['categoryId_err']) && empty($data['description_err']) && empty($data['rate_err'])){
            // validated
            if($this->postModel->addPost($data)){
                flash('post_message','Post Added');
                redirect('posts');
            }
            else{
                die('something went wrong');
            }
        }
        else{
            //Load view with errors
            $this->view('posts/add',$data);

        }
    }
        $this->view('posts/add',$data);

    }
    public function show($id){
        $post = $this->postModel->getPostById($id);
        $data = ['post' => $post];
        $this->view('posts/show',$data);
    }
    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize POST array 
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
             // upload picture
                $directory = URLROOT;
                $destination = $directory.$_FILES['upload']['name'];
                $filename =$_FILES['upload']['tmp_name'];
                if(isset($_POST["submit"])){
                    if($_FILES['upload']['error']==0){
                        // switch($_FILES['upload']['type']){
                        //     case[]

                        // }  
                    if (move_uploaded_file($filename,$destination)){
                        echo "<h2 class='main__title'> Product added successfully<h2><br>";
                        
                    }
                        else  {
                        echo "failure";
                    }
                    }
                        else {
                            if($_FILES['upload']['error']==1 || $_FILES['upload']['error']==2){
                                echo "Your file is too big please select a smaller one! then try again!<br>";}
                            else{
                                echo "your file is only partly uploaded";
                                }
                    }

                    }
            
        $data = [
            'categoryId' => trim($_POST['categoryId']),
            'description' => trim($_POST['description']),
            'rate' => trim($_POST['rate']),
            'picture' => $destination,
            'user_id' => $_SESSION['user_id'],
            'categoryId_err' => '',
            'description_err' => '',
            'id' => $id
        ];
       
        //form validation 
        // validate categoryId
        if(empty($data['categoryId'])){
            $data['categoryId_err'] = 'Please enter category id';
        }
        if(empty($data['rate'])){
            $data['rate_err'] = 'Please enter rental rate';
        }
        if(empty($data['description'])){
            $data['description_err'] = 'Please enter decription text';
        }
        // make sure no errors 
        if(empty($data['categoryId_err']) && empty($data['description_err']) && empty($data['rate_err'])){
            // validated
            if($this->postModel->editPost($data)){
                var_dump($data);
                flash('post_message','Post modified');
                //redirect('posts');
            }
            else{
                die('something went wrong');
            }
        }
        else{
            //Load view with errors
            $this->view('posts/edit',$data);

        }
    }
    else {
        $post = $this->postModel->getPostById($id);
      
        $data = [
            'id' => $id,
          'description' => $post->description,
          'picture' => $post->picture ,
          'categoryId' => $post->categoryId,
          'rate' => $post->rate
        ];
        
        $this->view('posts/edit',$data);
    }


    }
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $this->postModel->getPostById($id);
            //check for owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            
            if($this->postModel->deletePost($id[0])){
                flash('post_message','Post Removed');
                redirect('posts');
            }
            else{
                die('something went wrong');
            }
        }
        else{
            redirect('posts');
        }
    }
}
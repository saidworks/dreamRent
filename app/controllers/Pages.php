<?php
class Pages extends Controller{
    public function __construct(){
 

    }
  
    public function index(){
        $data = [
            'title' => SITENAME,
            'description' => 'Where you can find your ride at an affordable price'

        ];
        $this->view('pages/index',$data);
    }
    public function about(){
        $data = [
            'title' => 'About US',
            'description' => 'We are a new local car renting company, who put the customer at the heart of our work'
        ];
      $this->view('pages/about',$data);


    }   
}
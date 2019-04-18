<?php

class Index extends CI_Controller{
    
    

    public function homepage(){
        $this->load->view('template_index/header');
        $this->load->view('index/home');
        $this->load->view('template_index/navbar');  
        $this->load->view('template_index/footer');  

    }
    public function login(){
        $this->load->view('template_login/header');
        $this->load->view('login/login');
        $this->load->view('template_login/footer');  

    }
}


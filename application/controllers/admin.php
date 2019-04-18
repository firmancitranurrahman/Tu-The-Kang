<?php

class Admin extends CI_Controller {
    public function dashboard(){
        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('template_admin/topnav');
        $this->load->view('admin/dashboard');
        $this->load->view('template_admin/footer');
        

    }



}
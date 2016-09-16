<?php

class Bank extends CI_Controller{
    function __construct() {
        parent::__construct();
        if($this->session->logged_in != 'YES'){
            $this->load->view('login_page');
        }
        $this->load->model('bank_model');
    }
    
    function index(){
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/bank_pages/bank');
        $this->load->view('nav_bars/footer');
    }
    
    function add_bank(){
        $bank_id = $this->bank_model->add_bank();
        echo json_encode($bank_id);
    }
    
    function get_banks(){
        $banks_information = $this->bank_model->get_banks();
        echo json_encode($banks_information);
    }
    
}

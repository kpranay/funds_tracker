<?php

class Bank_account extends CI_Controller {
    function __construct() {
        parent::__construct();
        if($this->session->logged_in != 'YES'){
            $this->load->view('login_page');
        }
        $this->load->model('bank_account_model');
    }
    
    function index(){
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/bank_pages/bank_account');
        $this->load->view('nav_bars/footer');
    }
    
    function add_bank_account(){
        $bank_account_id = $this->bank_account_model->add_bank_account();
        echo json_encode($bank_account_id);
    }
    
    function get_bank_accounts(){
        $bank_accounts_information = $this->bank_account_model->get_bank_accounts();
        echo json_encode($bank_accounts_information);
    }
    
    function get_bank_accounts_template(){
        $this->load->helper('form');
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/bank_pages/bank_accounts_template');
        $this->load->view('nav_bars/footer');
    }
}

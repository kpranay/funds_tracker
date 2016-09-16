<?php

class Bank_book extends CI_Controller {
    function __construct() {        
        parent::__construct();
        if($this->session->logged_in != 'YES'){
            $this->load->view('login_page');
        }        
        $this->load->model('bank_book_model');
    }
    
    function index(){       
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/bank_pages/bank_book');
        $this->load->view('nav_bars/footer');
    }
    
    function add_bank_book(){
        $bank_book_id = $this->bank_book_model->add_bank_book();
        echo json_encode($bank_book_id);
    }
    
    function get_bank_books(){
        $bank_books_infromation = $this->bank_book_model->get_bank_books();
        echo json_encode($bank_books_infromation);
    }
}

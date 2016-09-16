<?php

class Cheque_book extends CI_Controller{    
    function __construct() {
        parent::__construct();   
        if($this->session->logged_in != 'YES'){
            $this->load->view('login_page');
        }
        $this->load->model('cheque_book_model');
    }
    
    function index(){        
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/bank_pages/cheque_book');
        $this->load->view('nav_bars/footer');
    }
    
    function add_cheque_book(){
        $cheque_book_id = $this->cheque_book_model->add_cheque_book();
        echo json_encode($cheque_book_id);
    }
    
    function get_cheque_books(){
        $cheque_books_information = $this->cheque_book_model->get_cheque_books();
        echo json_encode($cheque_books_information);
    }
}


?>
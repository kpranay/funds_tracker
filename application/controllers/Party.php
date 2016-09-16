<?php

class Party extends CI_Controller {    
    function __construct(){
        parent::__construct();        
        if($this->session->logged_in != 'YES'){
            $this->load->view('login_page');           
        }        
        $this->load->model('party_model');        
    }
    
    function index(){
        $this->load->view('nav_bars/header');
        $this->load->view('nav_bars/left_nav');
        $this->load->view('pages/party_pages/party');
        $this->load->view('nav_bars/footer');
    }
    
    function add_party(){      
        $party_id = $this->party_model->add_party();
        echo json_encode($party_id);
    }
    
    function get_party(){        
        $party_information = $this->party_model->get_party();
        echo json_encode($party_information);
    }
}

?>

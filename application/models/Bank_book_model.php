<?php

class Bank_book_model extends CI_Model{
    
    private $return_size = 300;
    private $bank_book_information = array();
    
    function __construct() {
        parent::__construct();
        
        $post = (array)json_decode($this->security->xss_clean($this->input->raw_input_stream));      
        
        if(key_exists('account_id',$post)){
            $this->bank_book_information['account_id'] = $post['account_id'];
        }
        if(key_exists('debit_credit',$post)){         //Values DEBIT, CREDIT
            $this->bank_book_information['debit_credit'] = $post['debit_credit'];
        }
        if(key_exists('date',$post)){
            $this->bank_book_information['date'] = $post['date'];
        }
        if(key_exists('party_id',$post)){             //Party table.
            $this->bank_book_information['party_id'] = $post['party_id'];
        }
        if(key_exists('narration',$post)){
            $this->bank_book_information['narration'] = $post['narration'];
        }
        if(key_exists('instrument_type_id',$post)){
            $this->bank_book_information['instrument_type_id'] = $post['instrument_type_id'];
        }
        if(key_exists('instrument_id',$post)){
            $this->bank_book_information['instrument_id'] = $post['instrument_id'];
        }
        if(key_exists('instrument_date',$post)){
            $this->bank_book_information['instrument_date'] = $post['instrument_date'];
        }
        if(key_exists('bank_id',$post)){
            $this->bank_book_information['bank_id'] = $post['bank_id'];
        }
        if(key_exists('transaction_amount',$post)){
            $this->bank_book_information['transaction_amount'] = $post['transaction_amount'];
        }
        if(key_exists('clearance_status',$post)){         // Values YES or NO
            $this->bank_book_information['clearance_status'] = $post['clearance_status'];
        }
        if(key_exists('clearance_date',$post)){
            $this->bank_book_information['clearance_date'] = $post['clearance_date'];
        }        
        if(key_exists('bill_recieved',$post)){        // Values YES or NO
            $this->bank_book_information['bill_recieved'] = $post['bill_recieved'];
        }
        if(key_exists('notes',$post)){
            $this->bank_book_information['notes'] = $post['notes'];
        }
        if(key_exists('project_id',$post)){
            $this->bank_book_information['project_id'] = $post['project_id'];
        }
        $this->bank_book_information['insert_date_time'] = 'Time here';
        $this->bank_book_information['user_id'] = 'User ID here';
    }
    
    function add_bank_book(){
        $this->db->insert('bank_book', $this->bank_book_information);        
        return $this->db->insert_id();
    }
    
    function update_bank_book(){
        $transaction_id = -1;                  // Non existent transaction id.
        $backup_information = array();
        //Checking for the existance of key paramter needed for the update.
        //Also getting the old record to create a edit log.
        if(key_exists('transaction_id', $this->bank_book_information)){
            $transaction_id = $post['transaction_id'];
            //Get the previous record.
            $this->db->select('*')
                    ->from('bank_book')
                    ->where('transaction_id', $transaction_id);
            $query = $this->db->get();            
            $backup_information['trail'] = $query->result();            
            //Check for the existence of previous record.
            if(sizeof($backup_information) == 0){
                return -3;                      //Record does not exist, probably illegal access.
            }
            $backup_information['trail'] = jason_encode($backup_information['trail'][0]);
            $backup_information['table_name'] = 'bank_book';
        }else{
            return -2;                          // Flag indicating that a key parameter for the where condition is not set. In this case the bank_account_id.
        }
        
        $this->db->trans_start();
        $this->db->where('bank_book', $this->bank_book_information);
        $this->db->insert('edit_log', $backup_information);
        $this->db->trans_complete();
        
        if($this->db->trans_status === FALSE){
            return -1;          // Flag indicating that there was a database error.
        }else{
            $this->db->select('*')
                    ->from('bank_book')
                    ->where('transaction_id', $transaction_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
    }    
    
    function get_bank_books(){
        if(key_exists('transaction_id', $this->bank_book_information)){
            $transaction_id = $this->bank_book_information['transaction_id'];            
            $this->db->select('*')
                    ->from('bank_book')
                    ->where('transaction_id', $transaction_id);
            $query = $this->db->get();           
            $result = $query->result();  
            //Check for the existence of record.
            if(sizeof($result) == 0){
                return -3;                      //Record does not exist, probably illegal access.
            }else{
                return $result;
            }            
        }        
        $this->db->select('*')
                ->from('bank_book')
                ->where($this->bank_book_information)
                ->limit("$this->return_size");
        $query = $this->db->get();
        
        $result = $query->result();
        return $result;
    }
}

?>

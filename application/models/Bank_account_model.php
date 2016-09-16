<?php


class Bank_account_model extends CI_Model {
    
    private $return_size = 300;
    private $bank_account_information = array();
    
    function __construct() {
        parent::__construct();
        $post = (array)json_decode($this->security->xss_clean($this->input->raw_input_stream));
        
        if(key_exists('account_name', $post)){
            $this->bank_account_information['account_name'] = $post['account_name'];
        }
        if(key_exists('account_id', $post)){
            $this->bank_account_information['account_id'] = key_exists('account_id', $post);
        }
        if(key_exists('bank_id', $post)){
            $this->bank_account_information['bank_id'] = $post['bank_id'];
        }
        if(key_exists('account_number', $post)){
            $this->bank_account_information['account_number'] = $post['account_number'];
        }
        if(key_exists('branch', $post)){
            $this->bank_account_information['branch'] = $post['branch'];
        }
        if(key_exists('location', $post)){
            $this->bank_account_information['location'] = $post['location'];
        }
        if(key_exists('ifsc_code', $post)){
            $this->bank_account_information['ifsc_code'] = $post['ifsc_code'];
        }
        if(key_exists('micr_code', $post)){
            $this->bank_account_information['micr_code'] = $post['micr_code'];
        }
        if(key_exists('swift_code', $post)){               // This is required for international payments
            $this->bank_account_information['swift_code'] = $post['swift_code'];
        }
        if(key_exists('party_id', $post)){
            $this->bank_account_information['party_id'] = $post['party_id'];
        }        
        
        $this->bank_account_information['insert_date_time'] = 'Time here';
        $this->bank_account_information['user_id'] = 'User ID here';        
    }
    
    function add_bank_account(){
        $this->db->insert('bank_account', $this->bank_account_information);        
        return $this->db->insert_id();         
    }
    /*
    
    function update_bank_account(){        
        $bank_account_id = -1;                  // Non existent bank account id.
        $backup_information = array();
        //Checking for the existance of key paramter needed for the update.
        //Also getting the old record to create a edit log.
        if(key_exists('bank_account_id', $this->bank_account_information)){
            $bank_account_id = $post['bank_account_id'];
            //Get the previous record.
            $this->db->select('*')
                    ->from('bank_account')
                    ->where('bank_account_id', $bank_account_id);
            $query = $this->db->get();            
            $backup_information['trail'] = $query->result();            
            //Check for the existence of previous record.
            if(sizeof($backup_information) == 0){
                return -3;                      //Record does not exist, probably illegal access.
            }
            $backup_information['trail'] = jason_encode($backup_information['trail'][0]);
            $backup_information['table_name'] = 'bank_account';
        }else{
            return -2;                          // Flag indicating that a key parameter for the where condition is not set. In this case the bank_account_id.
        }        
        
        $this->db->trans_start();
        $this->db->where('bank_account_id', $bank_account_id);
        $this->db->
        $this->db->insert('edit_log', $backup_information);
        $this->db->trans_complete();
        
        if($this->db->trans_status === FALSE){
            return -1;          // Flag indicating that there was a database error.
        }else{
            $this->db->select('*')
                    ->from('bank_account')
                    ->where('bank_account_id', $bank_account_id);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
    }
    */
    
    function get_bank_accounts(){
        if(key_exists('bank_account_id', $this->bank_account_information)){
            $bank_account_id = $this->bank_account_information['bank_account_id'];
            
            $this->db->select('*')
                    ->from('bank_account')
                    ->where('bank_account_id', $bank_account_id);
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
                ->from('bank_account')
        //        ->where($this->bank_account_information)
                ->limit("$this->return_size");
        $query = $this->db->get();
        
        $result = $query->result();
 
        return $result;
    }
    
}

?>
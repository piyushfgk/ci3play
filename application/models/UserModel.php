<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    
    protected $table = 'users';

    public function __construct(){
        parent::__construct();
        
        $this->load->database();
        $this->load->dbutil();
        $this->load->dbforge();
        
        $this->createDatabase();
    }

    public function createDatabase(){
        
        if($this->dbutil->database_exists($this->db->database)){
            if(!$this->db->table_exists($this->table)){
                $this->createTable();
            }
        }else{
            /**This code is for test purpose only. 
             * Above code will always executes, if connection to database established */
            if($this->dbforge->create_database($this->db->database)){
                $this->createTable();
            }
        }
       
    }

    public function createTable(){

        $fields = array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
            ),
            "password" => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
            ),
            'added_on' => array(
                'type' => 'DATETIME',
            ),
            'updated_on' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                "default" => 'R',
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('user_id', TRUE); // gives PRIMARY KEY (user_id)
                
        
        if($this->dbforge->create_table($this->table, TRUE)){
            $this->session->set_flashdata('db_status', (object) array(
                "status"  => "success",
                "message" => "Table <strong>{$this->table}</strong> created successfully" ,
                "icon"    => "check" ,
            ));
        }else{
            $this->session->set_flashdata('db_status', (object) array(
                "status"  => "danger",
                "message" => "Error creating table <strong>{$this->table}</strong>",
                "icon"    => "times",
            ));
        }
         
    }

    public function get($email = NULL){
       
        if(!empty($email)){
            $query = $this->db->get_where($this->table, array("email" => $email, "status" => 'A'));
            $result = $query->row();
        }else{
            $query = $this->db->get_where($this->table);
            $result = $query->result();
        }

        return $result;
    }

    public function register(){

        $this->name = ucwords(strtolower($this->input->post('name')));
        $this->email = strtolower($this->input->post('email'));
        $this->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $this->status = 'A'; // Default user status will be activated, will change after email verification added
        $this->added_on = date('Y-m-d H:i:s');

        return $this->db->insert($this->table, $this);
    }

}
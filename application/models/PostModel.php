<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostModel extends CI_Model {
    
    protected $table = 'posts';

    public function __construct(){
        parent::__construct();
        
        $this->load->database();
        $this->load->dbutil();
        $this->load->dbforge();
        
        $this->createDatabase();

        $this->latest_by = date('Y-m-d H:i:s');
        $this->created_by = $this->session->userdata('user_tabid');
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
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'added_on' => array(
                'type' => 'DATETIME',
            ),
            'updated_on' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'latest_by' => array(
                'type' => 'DATETIME',
            ),
            'created_by' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'status' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                "default" => 'A',
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE); // gives PRIMARY KEY (id)
                
        
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

    public function get($id = NULL){
        
        if(!empty($id)){
            $query = $this->db->get_where($this->table, array("id" => $id, "status !=" => 'D'));

            $result = $query->row();
        }else{
            $this->db->order_by('latest_by DESC');
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('users', 'users.user_id = '.$this->table.'.created_by');
            $query = $this->db->get();

            $result = $query->result();
        }

        return $result;
    }
    
    public function add(){

        $this->title = $this->input->post('title');
        $this->description = $this->input->post('description');
        $this->added_on = date('Y-m-d H:i:s');

        return $this->db->insert($this->table, $this);
    }

    public function delete($id, $hard_delete = FALSE){
       
        if($hard_delete){
            
            return $this->db->delete($this->table, array("id" => $id));

        }else{
            $this->updated_on = date('Y-m-d H:i:s');
            $this->status = 'D';
    
            return $this->db->update($this->table, $this, array("id" => $id));
        }
        
    }
 
    public function update($id){

        $this->title = $this->input->post('title');
        $this->description = $this->input->post('description');
        $this->updated_on = date('Y-m-d H:i:s');
        $this->status = 'U';

        return $this->db->update($this->table, $this, array("id" => $id));
    }
}
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
    }

    public function createDatabase(){
        
        if($this->dbutil->database_exists($this->db->database)){
            if(!$this->db->table_exists($this->table)){
                $this->createTable();
            }
        }else{
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
            'status' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                "default" => 'A',
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE); // gives PRIMARY KEY (id)
                
        if($this->dbforge->create_table($this->table, TRUE)) echo "Table created {$this->table}";
    }

    public function get($id = NULL){
        
        if(!empty($id)){
            $query = $this->db->get_where($this->table, array("id" => $id, "status !=" => 'D'));
            $result = $query->result_array()[0];
        }else{
            $this->db->order_by('updated_on DESC, added_on DESC');
            $query = $this->db->get_where($this->table, array("status !=" => 'D'));
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CaptchaModel extends CI_Model
{
    protected $table = 'captcha';

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->dbutil();
        $this->load->dbforge();

        $this->createDatabase();

        //Remove old captachas
        $this->houseKeepCatchas();
    }

    private function createDatabase()
    {
        if ($this->dbutil->database_exists($this->db->database)) {
            if (!$this->db->table_exists($this->table)) {
                $this->createTable();
            }
        } else {
            /**This code is for test purpose only.
             * Above code will always executes, if connection to database established */
            if ($this->dbforge->create_database($this->db->database)) {

                $this->createTable();

            }
        }
    }

    private function createTable()
    {

        $fields = array(
            'captcha_id' => array(
                'type' => 'BIGINT',
                'constraint' => 13,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'captcha_time' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => 45,
            ),
            "word" => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('captcha_id', TRUE); // gives PRIMARY KEY (captcha_id)
        $this->dbforge->add_key('word'); // gives KEY (word)

        if ($this->dbforge->create_table($this->table, TRUE)) {
            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => "success",
                    "message" => "Table <strong>{$this->table}</strong> created successfully" ,
                    "icon"    => "check" ,
                )
            );
        } else {
            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => "danger",
                    "message" => "Error creating table <strong>{$this->table}</strong>",
                    "icon"    => "times",
                )
            );
        }
    }

    public function createCaptcha()
    {
        $this->load->helper('captcha');

        $vals = array(
            'word'          => random_string('alnum', 6),
            'img_path'      => FCPATH . 'captcha/',
            'img_url'       => base_url('captcha'),
            'font_path'     => FCPATH . 'fonts/Oswald-VariableFont_wght.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);

        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );

        $query = $this->db->insert_string($this->table, $data);

        return $this->db->query($query) ? $cap : NULL;
    }

    private function houseKeepCatchas()
    {
        $expiration = time() - 7200; // Two hour limit
        $this->db->where('captcha_time < ', $expiration)
                ->delete($this->table);
    }
}
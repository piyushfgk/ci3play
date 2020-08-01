<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{

    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->dbutil();
        $this->load->dbforge();

        $this->createDatabase();

    }

    public function createDatabase()
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

    public function createTable()
    {

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
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => TRUE
            ),
            'status' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                "default" => 'R',
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('user_id', TRUE); // gives PRIMARY KEY (user_id)


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

    public function get($email = NULL)
    {

        $email = strtolower($email);

        if (!empty($email)) {

            $query = $this->db->get_where($this->table, array("email" => $email));
            $result = $query->row();

        } else {

            $query = $this->db->get_where($this->table);
            $result = $query->result();

        }

        return $result;

    }

    public function register()
    {

        $email_status = FALSE;

        $token = random_string('alnum', 50);
        $user_name  = ucwords(strtolower($this->input->post('name')));
        $user_email = strtolower($this->input->post('email'));
        $user_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $added_on = date('Y-m-d H:i:s');

        $user_data = array(
            "token"     => $token,
            "name"      => $user_name,
            "email"     => $user_email,
            "password"  => $user_password,
            "added_on"  => $added_on
        );

        $this->db->trans_begin(); # Starting transaction

        if ($this->db->insert($this->table, $user_data)) {
            /** Send email if registration is successfull */

            $verify_link = base_url('email_verify/' . $token);

            $subject = 'Please verify your email - ci3play.home.in';
            $message = '
                        <p>Hello, '.$user_name.'</p>
                        <p>Welcome to&nbsp;<a href="http://ci3play.home.in">
                        ci3play.home.in</a>&nbsp;, please click below button
                        link to verify your email.</p>
                        <p>&nbsp;</p>
                        <p style="padding-left: 50px;"><a href="' . $verify_link .
                        '" style="background-color: #b80c4d; border: #2e6da4;
                        font-family: Arial, Geneva, Arial, Helvetica,  sans-serif;
                        padding: 8px 12px; font-size: 21px; color: #fff;
                        border-radius: 4px; text-decoration: none;">Verify Email</a></p>
                        <p>&nbsp;</p>
                        <p><span style="color: #666699; font-size: 10px;">If above
                        link did not work use copy and paste below link in the
                        browser to verify your email</span>&nbsp;<br />&nbsp;'
                        . $verify_link . '</p>
                        <p>&nbsp;</p>
                        <p>Thanking You,</p>
                        <p><span style="color: #808080;"><strong>Yours Truly</strong>
                        </span><br /><span style="color: #808080;">
                        <strong>Piyush Sachan</strong></span></p>
                    ';

            $email_status = $this->send($user_email, $subject, $message);

        }

        if ($this->db->trans_status()  === FALSE || !$email_status) {

            $status = FALSE;
            $this->db->trans_rollback();

        } else {

            $status = TRUE;
            $this->db->trans_commit();

        }

        return $status;

    }

    public function check_token($token)
    {

        $query = $this->db->get_where($this->table, array("token" => $token));
        $result = $query->row();

        return $result;

    }

    public function user_activate($user_id)
    {

        $this->updated_on = date('Y-m-d H:i:s');
        $this->status = 'A';

        return $this->db->update($this->table, $this, array("user_id" => $user_id));

    }

    protected function send ($to, $subject, $message)
    {

        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();

    }

}
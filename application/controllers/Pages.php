<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        /** Load Models */
        $this->load->model('PostModel', 'PM');
        $this->load->model('UserModel', 'UM');
        // $this->load->model('CaptchaModel', 'CM');
    }

    public function index()
    {
        $this->data = array(
            "page"    => (object) ["title" => 'Home'],
            "heading" => "Hi, Welcome to CI3 playground !
                         <p class='h6 bg-info text-light py-2 mt-2
                         text-center'>Add a new post using
                         <a class=\"text-secondary\"href=\""
                         . base_url('post') . "\">Posts</a> menu !</p>",
            "posts"   => $this->PM->get()
        );

        if (!$this->session->userdata('user_id')) {
            redirect(base_url('pages/login'), 'refresh');
        } else {
            $this->body = 'home';
            $this->siteLayout();
        }
    }

    public function login($data = array())
    {
        if (empty($data)) {
            $this->data = array(
                "page"  => (object) ["title" => 'Login'],
                "form"  => (object) array(
                    "email" => (object) array("autofocus" => TRUE),
                    // "captcha" => (object) $this->CM->createCaptcha()
               )
           );

        //    $this->session->set_userdata('captcha', $this->data['form']->captcha->word);

        } else {
            $this->data = $data;
        }

        $this->body = 'login';
        $this->siteLayout();
    }

    public function doLogin()
    {
        $this->load->library('form_validation');

        /** You can not use space between pipes |
         * Rules must be adjacent to one another seperated by pipes only
         * */

        $user_list = array();

        foreach ($this->UM->get() as $user) {
            $user_list[] = $user->email;
        }

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|min_length[8]|max_length[100]|in_list[' . implode(",",$user_list) . ']',
            array(
                "min_length" => "%s must be at least 8 characters long",
                "max_length" => "%s can not be more than 100 characters",
                "in_list" => "%s is not registered with us, please <strong>Sign Up!</strong>"
            )
        );

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        // $this->form_validation->set_rules(
        //     'captcha',
        //     'Captcha',
        //     'trim|required|in_list[' . $this->session->userdata('captcha') . ']',
        //     array(
        //         "in_list" => "%s does not matched. Try again !"
        //     )
        // );

        if ($this->form_validation->run() == FALSE) {
            $this->login();
        } else {
            $result = $this->UM->get($this->input->post('email'));

            if ($result->status == 'R') {
                $status  = "info";
                $message = "You have been registered on ". indate($result->added_on) .
                           " Hrs. Please verify your email to login !";
                $icon    = "exclamation-triangle";
            } elseif ($result->status == 'A' && password_verify(
                $this->input->post('password'), $result->password)) {

                $this->session->set_userdata('user_tabid', $result->user_id);
                $this->session->set_userdata('user_id', $result->email);
                $this->session->set_userdata('user_name', $result->name);

                redirect(base_url());
            } else {
                $status = "danger";
                $message = "Incorrect login credentials !";
                $icon = "times";
            }

            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => $status,
                    "message" => $message,
                    "icon"    => $icon,
                )
            );

            $this->login(
                array(
                    "page" => (object) ["title" => 'Login'],
                    "form" => (object) array(
                                "password" => (object) array("autofocus" => TRUE),
                                // "captcha" => (object) $this->CM->createCaptcha()
                            )
                )
            );

        }
    }

    public function registration()
    {
        $this->data = array(
            "page"  => (object) ["title" => 'Registration'],
        );

        $this->body = 'registration';
        $this->siteLayout();
    }

    public function doRegister()
    {
        $this->load->library('form_validation');

        /** You can not use space between pipes |
         * Rules must be adjacent to one another seperated by pipes only
         * */
        $this->form_validation->set_rules(
            'name',
            'Name',
            'trim|required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]{2,}$/]',
            array(
                "min_length"   => "%s must be at least 2 characters long",
                "max_length"   => "%s can not be greater than 50 characters",
                "regex_match"  => "%s is not valid !"
            )
        );

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|min_length[10]|max_length[50]|is_unique[users.email]',
            array(
                "min_length" => "%s must be at least 10 characters long",
                "max_length" => "%s can not be more than 100 characters",
                "is_unique"  => "%s email ID is already registered, Please login !")
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|min_length[8]|max_length[20]|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\'_]).{8,20}$/]',
            array(
                "regex_match" => "%s must contain at least one small and capital letter, number
                                  & symbol #?!@$%^&*_'"
            )
        );

        $this->form_validation->set_rules(
            'confirm_password',
            'Confirm Password',
            'trim|required|matches[password]'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->registration();
        } else {
            $status = $this->UM->register();

            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => $status === FALSE ? "danger" : "success",
                    "message" => $status === FALSE ? "Registration error" :
                                    "Registration successfull! Please check your
                                    email to verify &amp; activate your login !",
                    "icon"    => $status === FALSE ? "times" : "check" ,
                )
            );

            redirect(base_url('pages/login'), 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect(base_url(), 'refresh');
    }

    public function changePassword()
    {
        $this->data = array(
            "page"  => (object) ["title" => 'Change Password'],
        );

        $this->body = 'password';

        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required|min_length[8]|max_length[20]|regex_match[/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\'_]).{8,20}$/]',
            array(
                "regex_match" => "%s must contain at least one small and capital letter, number
                                  & symbol #?!@$%^&*_'"
            )
        );

        $this->form_validation->set_rules(
            'confirm_password',
            'Confirm Password',
            'trim|required|matches[password]'
        );

        if ($this->form_validation->run() === TRUE) {
            $status = $this->UM->changePassword();

            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => $status === FALSE ? "danger" : "success",
                    "message" => $status === FALSE ? "Password change error" :
                                    "Your password has been change succesfully!
                                    Please <a href=\"". base_url() ."\">Sign In</b>",
                    "icon"    => $status === FALSE ? "times" : "check" ,
                )
            );

            if ($status) {
                $this->body = 'blank_page';
                $this->session->sess_destroy();
            }
        }

        $this->siteLayout();
    }

    public function emailVerify($token)
    {
        // If user already logged in then destroy current session
        if ($this->session->userdata('user_id')) {
            $this->session->sess_destroy();
        }

        $result = $this->UM->check_token($token);

        if (!empty($result->token)) {
            if ($result->status == 'R') {
                $status = $this->UM->user_activate($result->user_id);

                if ($status) {
                    $status = "success";
                    $message = 'Email successfully verified, Please login !';
                    $icon = "check";
                } else {
                    $status = "danger";
                    $message = "There is some problem verifying your email please try again later !";
                    $icon = "exclamation-triangle";
                }
            } else {
                $status = "info";
                $message = "Email already verified. Please login !";
                $icon = "exclamation-triangle";
            }

            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => $status,
                    "message" => $message,
                    "icon"    => $icon,
                )
            );

            $this->login();
        } else {
            $this->session->set_flashdata(
                'db_status',
                (object) array(
                    "status"  => 'danger',
                    "message" => 'Invalid Token Error! Email verification failed,
                                 Please check your link.',
                    "icon"    => 'exclamation-triangle',
                )
            );

            $this->data = array(
                "page"  => (object) ["title" => 'Email Verify'],
            );

            $this->body = 'blank_page';
            $this->siteLayout();
        }
    }
}
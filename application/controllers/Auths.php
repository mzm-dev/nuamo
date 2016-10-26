<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends CI_Controller
{

    protected $defaultPassword;
    protected $badPasswords;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->load->library('parser');
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
        $this->defaultPassword = $this->config->item('default_password');
        $this->badPasswords = $this->config->item('bad_password');
    }

    /**
     * login method
     * @return void
     */
    public function login()
    {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
            array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'users/login'; //set view
            $this->load->view('layouts/default_login', $data); //set layout
        } else {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );
            $result = $this->AuthModel->login($data); //load model
            $user = $this->AuthModel->exists(1, 'token_reset'); //load model
            if ($result && !$user) {
                redirect('welcome');
            } else if ($result && $user) { //check if used default password, redirect to false change own password
                redirect('users/change_password');
            } else {
                $this->session->set_flashdata('item', array('message' => 'Wrong Authname/Password. Please try again.', 'class' => 'danger')); //danger or success
                redirect('auths/login'); // back to the login
            }
        }
    }

    public function logout()
    {
        if (($this->session->userdata('user_session') == FALSE)) {
            $this->session->set_flashdata('item', array('message' => 'You are not authorized. Please login!', 'class' => 'danger')); //danger or success
            redirect('auths/login');
        } else {
            $this->session->unset_userdata('user_session');
            $this->session->sess_destroy();
        }
        redirect('auths/login', 'refresh');

    }

    public function forgot()
    {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required')
        ));
        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'users/forgot'; //set view
            $this->load->view('layouts/default_login', $data); //set layout
        } else {
            if ($user = $this->AuthModel->exists($this->input->post('email'), 'email')) {
                $token_key = $this->AuthModel->generate_salt();
                $token_exp = $tomorrow = date("Y-m-d H:i:s", strtotime("+1 day"));
                $data = array(
                    'id' => $user['id'],
                    'token_key' => $token_key,
                    'token_exp' => $token_exp,
                    'token_reset' => 1
                );
                $this->UserModel->modified($data); //load model
                $this->send_email_forgot($user, $token_key, $token_exp);
                $this->session->set_flashdata('item', array('message' => 'Request new password success. Please check your email for Reset password instructions', 'class' => 'success')); //danger or success
                redirect('auths/login'); // back to the login
            }
        }
    }

    public function reset_password($token_key = null)
    {
        if ($token_key) {
            if ($user = $this->AuthModel->exists($token_key, 'token_key')) {
                $new_password = $this->AuthModel->generate_password(6);
                $data = array(
                    'id' => $user['id'],
                    'password' => $this->AuthModel->pwd_hash($new_password),
                    'token_key' => null,
                    'token_exp' => '0000-00-00 00:00:00'
                );
                $this->UserModel->modified($data); //load model
                $this->send_email_password($user, $new_password); //load model
                $this->session->set_flashdata('item', array('message' => 'Password has been reset, please check email. : ' . $new_password, 'class' => 'success')); //danger or success
            } else {
                $this->session->set_flashdata('item', array('message' => 'Token is expired', 'class' => 'danger')); //danger or success
            }
        } else {
            $this->session->set_flashdata('item', array('message' => 'Invalid Request', 'class' => 'danger')); //danger or success
        }
        redirect('auths/login'); // back to the login
    }

    /*
    | -------------------------------------------------------------------
    |  Email Template & Configutation
    | -------------------------------------------------------------------
     */
    private function config()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; //change this
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'aplikasiecakna@gmail.com'; //change this
        $config['smtp_pass'] = 'mZ#cd256'; //change this
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard
        $this->email->initialize($config);
    }

    private function send_email_password($user, $new_password)
    {
        $this->config();
        $this->email->from('admin@nuamo.com', 'Persatuan NUAMO');
        $this->email->to($user['email']);
        $this->email->reply_to('no-replay@nuamo.com', 'No-Reply Persatuan NUAMO');
        $this->email->subject('Password successfully changed');
        $data = array(
            'name' => $user['name'],
            'new_password' => $new_password
        );

        $htmlBody = $this->parser->parse('emails_template/send_email_password', $data);
        $this->email->message($htmlBody);
        $this->email->send();
    }

    private function send_email_forgot($user, $token_key, $token_exp)
    {
        $this->config();
        $this->email->from('admin@nuamo.com', 'Persatuan NUAMO');
        $this->email->to($user['email']);
        $this->email->reply_to('no-replay@nuamo.com', 'No-Reply Persatuan NUAMO');
        $this->email->subject('Reset password instructions');
        $data = array(
            'name' => $user['name'],
            'token_key' => $token_key,
            'token_exp' => $token_exp
        );

        $htmlBody = $this->parser->parse('emails_template/send_email_forgot', $data);
        $this->email->message($htmlBody);
        $this->email->send();
    }
}

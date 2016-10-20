<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends CI_Controller
{

    protected $defaultPassword;
    protected $badPasswords;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
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
            if ($result) {
                redirect('welcome'); // back to the login
            } else {
                $this->session->set_flashdata('item', array('message' => 'Wrong Authname/Password. Please try again.', 'class' => 'danger')); //danger or success
                redirect('users/login'); // back to the login
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
        $data['main'] = '/users/forgot';
        $this->load->view('layouts/default_login', $data);
    }

}

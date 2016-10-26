<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    protected $defaultPassword;
    protected $badPasswords;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('UserModel');
        $this->defaultPassword = $this->config->item('default_password');
        $this->badPasswords = $this->config->item('bad_password');
        $this->isRegistered();
    }

    /**
     * isRegistered method
     * @return void
     */
    public function isRegistered()
    {
        if (($this->session->userdata('user_session') == FALSE)) {
            $this->session->set_flashdata('item', array('message' => 'You are not authorized. Please login!', 'class' => 'danger')); //danger or success
            redirect('auths/login');
        }
    }

    public function index($offset = 0)
    {
        $limit = 10;
        $result = $this->UserModel->all($limit, $offset);
        $data['users'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("users/index");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;
        //which uri segment indicates pagination number
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        //max links on a page will be shown
        $config['num_links'] = 5;
        //various pagination configuration
        //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['role'] = array('' => 'Tiada Maklumat', '100' => 'User', '200' => 'User');
        $data['main'] = '/users/index';
        $this->load->view('layouts/default', $data);
    }

    public function add()
    {
        $data['active'] = array('' => '--Pilih--', '0' => 'Tidak Aktif', '1' => 'Aktif');

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'is_active', 'label' => 'Status', 'rules' => 'required')
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'users/add'; //set view
            $this->load->view('layouts/default', $data); //set layout
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->AuthModel->pwd_hash($this->defaultPassword),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'is_active' => $this->input->post('is_active'),
            );
            $this->UserModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success
            redirect('users/index'); // back to the index
        }

    }

    public function edit($id = null)
    {
        if (!empty($id) && !$this->UserModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('users/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch user record for the given employee no
        $data['user'] = $this->UserModel->read($id);

        $data['role'] = array('' => '--Pilih--', '100' => 'Admin', '200' => 'User');
        $data['active'] = array('' => '--Pilih--', '0' => 'Tidak Aktif', '1' => 'Aktif');

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'is_active', 'label' => 'Status', 'rules' => 'required')
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/users/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'username' => $this->input->post('username'),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'is_active' => $this->input->post('is_active'),
            );
            $this->UserModel->modified($data); //load model

            //set flash message
            $this->session->set_flashdata('item', array('message' => 'The usereter has been saved', 'class' => 'success')); //danger or success
            redirect('users/index'); // back to the index
        }

    }

    public function change_password()
    {
        $authUser = $this->session->userdata('user_session');
        $id = $authUser['id'];
        if (!empty($id) && !$this->UserModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('/'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch user record for the given employee no
        $data['user'] = $this->UserModel->read($id);

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'current_password', 'label' => 'Password', 'rules' => 'trim|required'),
            array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required|min_length[5]|callback_password_check|matches[new_password2]'),
            array('field' => 'new_password2', 'label' => 'Verify New Password', 'rules' => 'trim|required')
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/users/change_password';
            $this->load->view('layouts/default', $data);
        } else {
            $macthing = array(
                'id' => $id,
                'current_password' => $this->input->post('current_password'),
            );
            $password_match = $this->AuthModel->check_current_password($macthing);
            if ($password_match) {
                $data = array(
                    'id' => $this->input->post('id'),
                    'password' => $this->AuthModel->pwd_hash($this->input->post('new_password')),
                    'token_reset' => 0
                );
                $this->UserModel->modified($data); //load model
                //set flash message
                $this->session->set_flashdata('item', array('message' => 'The user has been saved', 'class' => 'success')); //danger or success
                redirect('/'); // back to the index
            } else {
                $this->session->set_flashdata('item', array('message' => 'Current Password not match', 'class' => 'danger')); //danger or success
                redirect('users/change_password'); // back to the index
            }

        }
    }

    public
    function delete($id)
    {
        //Cheching data is not empty
        if (!$this->UserModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('users/index'); // back to the index
        }
        if ($this->UserModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'User deleted', 'class' => 'success')); //danger or success
            redirect('users/index'); // back to the index
        }

    }

    public
    function reset($id = null)
    {
        if (!empty($id) && !$this->UserModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('users/index'); // back to the index
        }
        $data = array(
            'id' => $this->input->post('id'),
            'password' => $this->AuthModel->pwd_hash($this->defaultPassword),
        );
        $this->UserModel->modified($data); //load model

        //set flash message
        $this->session->set_flashdata('item', array('message' => 'Reset password has been renew', 'class' => 'success')); //danger or success
        redirect('users/index'); // back to the index
    }

    ###Validation callback###
    /**
     * validation callback
     * @return void
     */
    public function password_check($str) {
        $string = strtolower($str);
        $badPasswords = $this->badPasswords;
        foreach ($badPasswords as $key => $val) {
            if (strlen(strstr($string, "$val")) > 0) {
                $this->form_validation->set_message('password_check', 'Your password is too similar to your name or email address or other common/simple passwords.');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
}

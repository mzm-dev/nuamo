<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funds extends CI_Controller
{

    /**
     * __construct method
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('FundModel');
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
        $result = $this->FundModel->all($limit, $offset);
        $data['funds'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("funds/index");
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

        $data['main'] = '/funds/index';
        $this->load->view('layouts/default', $data);
    }

    public function add()
    {
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'rank', 'label' => 'Turutan', 'rules' => 'is_unique[funds.rank]'),
            array('field' => 'name', 'label' => 'Nama Tuntutan', 'rules' => 'required'),
            array('field' => 'amount', 'label' => 'Nilai', 'rules' => 'required'),
            array('field' => 'is_active', 'label' => 'Status', 'rules' => 'required')
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/funds/add';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'rank' => $this->input->post('rank'),
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'is_active' => $this->input->post('is_active')
            );
            $this->FundModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success
            redirect('funds/index'); // back to the index
        }

    }

    public function edit($id = null)
    {
        if (!empty($id) && !$this->FundModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('funds/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch fund record for the given employee no
        $data['fund'] = $this->FundModel->read($id);
        
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'rank', 'label' => 'Turutan', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Nama Tuntutan', 'rules' => 'required'),
            array('field' => 'amount', 'label' => 'Nilai', 'rules' => 'required'),
            array('field' => 'is_active', 'label' => 'Status', 'rules' => 'required')
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/funds/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'rank' => $this->input->post('rank'),
                'name' => $this->input->post('name'),
                'amount' => $this->input->post('amount'),
                'is_active' => $this->input->post('is_active')
            );
            $this->FundModel->modified($data); //load model

            //set flash message
            $this->session->set_flashdata('item', array('message' => 'The fundeter has been saved', 'class' => 'success')); //danger or success
            redirect('funds/index'); // back to the index
        }

    }

    /**
     * delete method
     * @fund string fund_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->FundModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('funds/index'); // back to the index
        }
        if ($this->FundModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Fund deleted', 'class' => 'success')); //danger or success
            redirect('funds/index'); // back to the index
        }

    }

}

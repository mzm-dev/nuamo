<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Claims extends CI_Controller
{

    /**
     * __construct method
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ClaimModel');
        $this->load->model('FundModel');
        $this->load->model('ParamModel');
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
        $limit = 5;
        $result = $this->ClaimModel->all($limit, $offset);
        $data['claims'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("claims/index");
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

        $data['main'] = '/claims/index';
        $this->load->view('layouts/default', $data);
    }

    public function add()
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $count = $post['count'];
            $data = array();
            foreach ($count as $k => $v) {
                $data[$k]['id'] = $post['id-' . $v];
                $data[$k]['amount'] = $post['amount-' . $v];
            }
            var_dump($data);
        }
        $data['funds'] = $this->FundModel->listing();
        //Get Status Name with prefix code '30'%
        $data['bank'] = $this->ParamModel->read_pre('30', false);


        //set form validation
//        $this->form_validation->set_rules(array(
//            array('field' => 'nric', 'label' => 'No Kad Pengenalan', 'rules' => 'required'),
//            array('field' => 'name', 'label' => 'Nama Penuh', 'rules' => 'required'),
//            array('field' => 'branch', 'label' => 'Cangan', 'rules' => 'required'),
//            array('field' => 'status', 'label' => 'Status', 'rules' => 'required')
//        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'claims/add';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'status' => 1,
            );
            $this->UserModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success
            redirect('claims/index'); // back to the index
        }

    }

    public function edit($id = null)
    {
        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('claims/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch claim record for the given employee no
        $data['claim'] = $this->ClaimModel->read($id);

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Claimeter Name', 'rules' => 'required'),
            array('field' => 'code', 'label' => 'Kod', 'rules' => 'required'),
            array('field' => 'status', 'label' => 'status', 'rules' => 'required')
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/claims/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'status' => $this->input->post('status')
            );
            $this->ClaimModel->modified($data); //load model

            //set flash message
            $this->session->set_flashdata('item', array('message' => 'The claimeter has been saved', 'class' => 'success')); //danger or success
            redirect('claims/index'); // back to the index
        }

    }

    /**
     * delete method
     * @claim string user_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('claims/index'); // back to the index
        }
        if ($this->ClaimModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'User deleted', 'class' => 'success')); //danger or success
            redirect('claims/index'); // back to the index
        }

    }

}

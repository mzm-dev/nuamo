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
        $this->load->model('ItemModel');
        $this->load->model('FundModel');
        $this->load->model('ParamModel');
        $this->load->model('MemberModel');
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

    /**
     * @param int $offset
     */
    public function index($offset = 0)
    {
        $limit = 5;
        $result = $this->ClaimModel->all($limit, $offset);
        $data['claims'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        //pagination configuration
        $config = array();
        $config['base_url'] = site_url("claims/index");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;

        //various pagination configuration
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        //Get Status Name with prefix code '100'%
        $data['status_name'] = $this->ParamModel->read_pre('100', false);

        $data['main'] = '/claims/index';
        $this->load->view('layouts/default', $data);
    }

    /**
     *
     */
    public function add()
    {

        $data['funds'] = $this->FundModel->listing();
        //Get Status Name with prefix code '30'%
        $data['bank'] = $this->ParamModel->read_pre('30', false);


        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'nric', 'label' => 'No Kad Pengenalan', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Nama Penuh', 'rules' => 'required'),
            array('field' => 'branch', 'label' => 'Cawangan', 'rules' => 'required'),
            array('field' => 'num_account', 'label' => 'No Akaun', 'rules' => 'required')
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'claims/add';
            $this->load->view('layouts/default', $data);
        } else {
            $post = $this->input->post();
            $count = $this->input->post('count') - 1;

            $data = array(
                'nric' => $this->input->post('nric'),
                'branch' => $this->input->post('branch'),
                'bank_account' => $this->input->post('bank_account'),
                'num_account' => $this->input->post('num_account'),
                'sum' => $this->input->post('sum'),

            );
            $insert_id = $this->ClaimModel->create($data); //load model

            $data = array();
            for ($x = 0; $x <= $count; $x++) {
                if ($post['qty-' . $x] != 0) {
                    $data[$x]['claim_id'] = $insert_id;
                    $data[$x]['fund_id'] = $post['id-' . $x];
                    $data[$x]['qty'] = $post['qty-' . $x];
                    $data[$x]['amount'] = $post['amount-' . $x];
                }
            }

            $this->ItemModel->create($data);
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success
            redirect('claims/index'); // back to the index
        }

    }

    /**
     * @param null $id
     */
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

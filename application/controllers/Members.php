<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller
{

    /**
     * __construct method
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
        $limit = 10;
        
        if($this->input->method()){
            $result = $this->MemberModel->all($limit, $offset);
        }else{
            $result = $this->MemberModel->all_search($this->input->post('query'), $limit, $offset);
        }

        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("members/index");
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

        $data['main'] = '/members/index';
        $this->load->view('layouts/default', $data);
    }

    /**
     * @param int $offset
     */
    public function in_active($offset = 0)
    {
        $limit = 10;
        $is_active = 0;
        $result = $this->MemberModel->all($is_active, $limit, $offset);
        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("members/in_active");
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

        $data['main'] = '/members/in_active';
        $this->load->view('layouts/default', $data);
    }

    /**
     * @param int $offset
     */
    public function newer($offset = 0)
    {
        $limit = 10;
        $result = $this->MemberModel->all_newer($limit, $offset);
        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("members/newer");
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

        //Get Status Name with prefix code '100'%
        $data['status_name'] = $this->ParamModel->read_pre('100', false);

        $data['main'] = '/members/newer';
        $this->load->view('layouts/default', $data);
    }


    /**
     *
     */
    public function add()
    {
        $data['status'] = $this->ParamModel->read_pre('100');

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'date', 'label' => 'Tarikh Permohonan', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Nama', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'phone', 'label' => 'No Telefon', 'rules' => 'required'),
            array('field' => 'telephone', 'label' => 'No Telefon Bimbit', 'rules' => 'required'),
            array('field' => 'nric', 'label' => 'No K/P', 'rules' => 'required|numeric'),
            array('field' => 'age', 'label' => 'Umur', 'rules' => 'required|numeric'),
            array('field' => 'year', 'label' => 'Tahun', 'rules' => 'required|numeric'),
            array('field' => 'dob', 'label' => 'Tarikh Lahir', 'rules' => 'required'),
            array('field' => 'dop', 'label' => 'Tarikh Lantikan', 'rules' => 'required'),
            array('field' => 'add_office', 'label' => 'Alamat Pejabat', 'rules' => 'required'),
            array('field' => 'address', 'label' => 'Alamat Rumah', 'rules' => 'required'),
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/members/add';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'date_register' => date("Y-m-d", strtotime($this->input->post('date'))),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'telephone' => $this->input->post('telephone'),
                'nric' => $this->input->post('nric'),
                'age' => $this->input->post('age'),
                'year' => $this->input->post('year'),
                'dob' => date("Y-m-d", strtotime($this->input->post('dob'))),
                'dop' => date("Y-m-d", strtotime($this->input->post('dop'))),
                'add_office' => $this->input->post('add_office'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status'),
                'is_active' => $this->input->post('is_active'),
            );
            $this->MemberModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Registration Successful', 'class' => 'success')); //danger or success
            redirect('members/index'); // back to the index
        }
    }

    /**
     * @param null $id
     */
    public function edit($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch member record for the given employee no
        $data['member'] = $this->MemberModel->read($id);
        $data['status'] = $this->ParamModel->read_pre('100');

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'date', 'label' => 'Tarikh Permohonan', 'rules' => 'required'),
            array('field' => 'name', 'label' => 'Nama', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email'),
            array('field' => 'phone', 'label' => 'No Telefon', 'rules' => 'required'),
            array('field' => 'telephone', 'label' => 'No Telefon Bimbit', 'rules' => 'required'),
            array('field' => 'nric', 'label' => 'No K/P', 'rules' => 'required|numeric'),
            array('field' => 'age', 'label' => 'Umur', 'rules' => 'required|numeric'),
            array('field' => 'year', 'label' => 'Tahun', 'rules' => 'required|numeric'),
            array('field' => 'dob', 'label' => 'Tarikh Lahir', 'rules' => 'required'),
            array('field' => 'dop', 'label' => 'Tarikh Lantikan', 'rules' => 'required'),
            array('field' => 'add_office', 'label' => 'Alamat Pejabat', 'rules' => 'required'),
            array('field' => 'address', 'label' => 'Alamat Rumah', 'rules' => 'required'),
            array('field' => 'status', 'label' => 'Status Pendafataran', 'rules' => 'required'),
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/members/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'date_register' => date("Y-m-d", strtotime($this->input->post('date'))),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'telephone' => $this->input->post('telephone'),
                'nric' => $this->input->post('nric'),
                'age' => $this->input->post('age'),
                'year' => $this->input->post('year'),
                'dob' => date("Y-m-d", strtotime($this->input->post('dob'))),
                'dop' => date("Y-m-d", strtotime($this->input->post('dop'))),
                'add_office' => $this->input->post('add_office'),
                'address' => $this->input->post('address'),
                'status' => $this->input->post('status'),
                'is_active' => $this->input->post('is_active'),
            );
            $this->MemberModel->modified($data); //load model

            //set flash message
            $this->session->set_flashdata('item', array('message' => 'The membereter has been saved', 'class' => 'success')); //danger or success
            redirect('members/index'); // back to the index
        }

    }

    /**
     * @param null $id
     */
    public function view($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        $data['status'] = array('' => '--Tiada Maklumat--', '0' => 'Tidak Aktif', '1' => 'Aktif');
        $data['status_name'] = $this->ParamModel->read_pre('100');
        $data['member'] = $this->MemberModel->read($id);
        $data['main'] = '/members/view';
        $this->load->view('layouts/default', $data);
    }

    /**
     * delete method
     * @member string user_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }
        if ($this->MemberModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'User deleted', 'class' => 'success')); //danger or success
            redirect('members/index'); // back to the index
        }

    }

    /**
     * 
     */
    public function ajax_member()
    {
        if ($this->input->is_ajax_request()) {
            $key = $this->input->post('key');
            $val = $this->input->post('val');
            $data['data'] = $this->MemberModel->read_by($key, $val); //load model
            if (!empty($data['data'])) {
                $data['result'] = true;
            } else {
                $data['result'] = false;
            }
            echo json_encode($data);
        } else {
            exit('No direct script access allowed');

        }
    }

}

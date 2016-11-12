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
        $this->load->model('StateModel');
        $this->isRegistered();
    }

    /**
     * isRegistered method
     * @return void
     */
    public function isRegistered()
    {
        if (($this->session->userdata('user_session') == FALSE)) {
            $this->session->set_flashdata('item', array('message' => 'Capaian halaman tidak dibenarkan. Sila Log Masuk!', 'class' => 'danger')); //danger or success
            redirect('auths/login');
        }
    }

    /**
     * @param int $offset
     */
    public function index($offset = 0)
    {
        $query = null;
        $limit = 20;
        $is_active = 1;

        $search = ($this->input->method() ? $this->input->post('query') : null);
        $result = $this->MemberModel->all($search, $is_active, $limit, $offset);

        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        //pagination configuration
        $config = array();
        $config['base_url'] = site_url("members/index");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;

        //various pagination configuration
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

        $query = null;
        $limit = 10;
        $is_active = 0;

        $search = ($this->input->method() ? $this->input->post('query') : null);
        $result = $this->MemberModel->all($search, $is_active, $limit, $offset);

        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        //pagination configuration
        $config = array();
        $config['base_url'] = site_url("members/in_active");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;

        //various pagination configuration
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

        $query = null;
        $limit = 20;
        $is_active = 0;

        $search = ($this->input->method() ? $this->input->post('query') : null);
        $result = $this->MemberModel->all_newer($search, $is_active, $limit, $offset);

        $data['members'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        //pagination configuration
        $config = array();
        $config['base_url'] = site_url("members/newer");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;

        //various pagination configuration
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
        $data['states'] = $this->StateModel->read_pre();


        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'date_register', 'label' => 'Tarikh Permohonan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'name', 'label' => 'Nama', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'valid_email' => '{field} tidak sah.',
                )),
            array('field' => 'phone', 'label' => 'No Telefon', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'telephone', 'label' => 'No Telefon Bimbit', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'nric', 'label' => 'No K/P', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'age', 'label' => 'Umur', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'year', 'label' => 'Tahun', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'dob', 'label' => 'Tarikh Lahir', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'dop', 'label' => 'Tarikh Lantikan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'add_office', 'label' => 'Alamat Pejabat', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'address', 'label' => 'Alamat Rumah', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/members/add';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'date_register' => date("Y-m-d", strtotime($this->input->post('date_register'))),
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
            $this->session->set_flashdata('item', array('message' => 'Makumat berjaya disimpan.', 'class' => 'success')); //danger or success
            redirect('members/index'); // back to the index
        }
    }

    /**
     * @param null $id
     */
    public function edit($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);

        $data['member'] = $this->MemberModel->read($id);
        $data['status'] = $this->ParamModel->read_pre('100');
        $data['states'] = $this->StateModel->read_pre();

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'date_register', 'label' => 'Tarikh Permohonan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'name', 'label' => 'Nama', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'valid_email' => '{field} tidak sah.',
                )),
            array('field' => 'phone', 'label' => 'No Telefon', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'telephone', 'label' => 'No Telefon Bimbit', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'nric', 'label' => 'No K/P', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'age', 'label' => 'Umur', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'year', 'label' => 'Tahun', 'rules' => 'required|numeric',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                )),
            array('field' => 'dob', 'label' => 'Tarikh Lahir', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'dop', 'label' => 'Tarikh Lantikan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'add_office', 'label' => 'Alamat Pejabat', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'address', 'label' => 'Alamat Rumah', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'status', 'label' => 'Status Pendafataran', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/members/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'date_register' => date("Y-m-d", strtotime($this->input->post('date_register'))),
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
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dikemaskini', 'class' => 'success')); //danger or success
            if ($this->input->post('status') == 1004) {
                redirect('members/index'); // back to the index
            } else {
                redirect('members/newer'); // back to the newer
            }
        }

    }

    /**
     * @param null $id
     */
    public function view($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        $data['status'] = array('' => '--Tiada Maklumat--', '0' => 'Tidak Aktif', '1' => 'Aktif');
        $data['member'] = $this->MemberModel->read($id);
        $data['main'] = '/members/view';
        $this->load->view('layouts/default', $data);
    }

    /**
     * @param null $id
     */
    public function cetak($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        $data['status'] = array('' => '--Tiada Maklumat--', '0' => 'Tidak Aktif', '1' => 'Aktif');
        $data['member'] = $this->MemberModel->read($id);
        $data['main'] = '/members/cetak';
        $this->load->view('layouts/default_print', $data);
    }

    /**
     * delete method
     * @member string user_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }
        if ($this->MemberModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dihapuskan', 'class' => 'success')); //danger or success
            redirect('members/index'); // back to the index
        }

    }

}

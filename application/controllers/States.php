<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class States extends CI_Controller
{

    /**
     * __construct method
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
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
            $this->session->set_flashdata('item', array('message' => 'Capaian halaman tidak dibenarkan. Sila Log Masuk', 'class' => 'danger')); //danger or success
            redirect('auths/login');
        }
    }

    /**
     * Basic example dari CI Document
     * $this->load->library('pagination');
     * $config['base_url'] = 'http://example.com/index.php/test/page/';
     * $config['total_rows'] = 200;
     * $config['per_page'] = 20;
     *
     */
    public function index($offset = 0)
    {

        $limit = 20; //Limit untuk paparan senarai
        $result = $this->StateModel->all($limit, $offset);
        $data['states'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        $config = array();
        $config['base_url'] = site_url("states/index");
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

        $data['main'] = '/states/index';
        $this->load->view('layouts/default', $data);
    }

    public function add()
    {
        //fetch state status record for the given prefix code
        $data['statuses'] = $this->StateModel->is_active();

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Stateeter Name', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'code', 'label' => 'Kod', 'rules' => 'required|is_unique[states.code]',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'is_unique' => '{field} telah wujud.',
                )),
            array('field' => 'status', 'label' => 'Status', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                ))
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/states/add';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'status' => 1,
            );
            $this->UserModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya disimpan.', 'class' => 'success')); //danger or success
            redirect('users/index'); // back to the index
        }

    }

    public function edit($id = null)
    {
        if (!empty($id) && !$this->StateModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('states/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        //fetch state record for the given employee no
        $data['state'] = $this->StateModel->read($id);
        
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Stateeter Name', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'code', 'label' => 'Kod', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'status', 'label' => 'status', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                ))
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/states/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'status' => $this->input->post('status')
            );
            $this->StateModel->modified($data); //load model

            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dikemaskini.', 'class' => 'success')); //danger or success
            redirect('states/index'); // back to the index
        }

    }

    /**
     * delete method
     * @state string user_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->StateModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('states/index'); // back to the index
        }
        if ($this->StateModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dihapuskan.', 'class' => 'success')); //danger or success
            redirect('states/index'); // back to the index
        }

    }

}

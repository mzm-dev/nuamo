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
        $this->load->model('AttachmentModel');
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
        $status = array('1004');
        $result = $this->ClaimModel->all($status, $limit, $offset);
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
     * @param int $offset
     */
    public function newer($offset = 0)
    {
        $limit = 5;
        $status = array('1001', '1002', '1005');
        $result = $this->ClaimModel->all($status, $limit, $offset);
        $data['claims'] = $result['rows'];
        $data['num_results'] = $result['num_rows'];

        //pagination configuration
        $config = array();
        $config['base_url'] = site_url("claims/newer");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $limit;

        //various pagination configuration
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        //Get Status Name with prefix code '100'%
        $data['status_name'] = $this->ParamModel->read_pre('100', false);

        $data['main'] = '/claims/newer';
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
            redirect('claims/upload/' . $insert_id); // back to the index
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

    /**
     * @param null $id
     */
    public function upload($id = null)
    {
        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Invalid or Data not found!', 'class' => 'danger')); //danger or success
            redirect('claims/newer'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        
        $data['attaches'] = $this->AttachmentModel->listing($id);
        $data['items'] = $this->ItemModel->listing($id);
        $data['claim'] = $this->ClaimModel->read($id);
        $data['bank'] = $this->ParamModel->read_pre(30);

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'title', 'label' => 'Tajuk Fail', 'rules' => 'required')
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/claims/upload';
            $this->load->view('layouts/default', $data);
        } else {
            $fileName = $fileSize = '';
            //var_dump($_FILES);
            $fileName = microtime(true) . '.' . $id; //1478046270.93.1.jpg
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpeg|jpg|png|zip|rar';
            $config['file_name'] = $fileName . "." . explode('.', $_FILES['document']['name'])[1];
            $config['file_size'] = $_FILES['document']['size'];
            $config['max_size'] = 2048; //2MB
            $this->upload->initialize($config);
            $error = $_FILES['document']['error'];

            if ($this->upload->do_upload('document')) {
                $uploadData = $this->upload->data();
                $fileSize = $uploadData['file_size'];

                $data = array(
                    'claim_id' => $this->input->post('id'),
                    'title' => $this->input->post('title'),
                    'file_name' => $fileName,
                    'file_size' => $fileSize,
                );
                $this->AttachmentModel->create($data);
                $this->session->set_flashdata('item', array('message' => 'The Upload has been saved', 'class' => 'success')); //danger or success
            } else {
                $this->session->set_flashdata('item', array('message' => 'The Upload not success, please try again. ' . $this->ralat($error), 'class' => 'danger')); //danger or success
            }
            redirect('claims/upload/' . $id); // back to the index
        }
    }

    /**
     * @param $code
     * @return mixed
     */
    private function ralat($code)
    {
        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        );
        if ($code != 0) {
            return $phpFileUploadErrors[$code];
        }
    }

}

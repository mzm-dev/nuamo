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
            $this->session->set_flashdata('item', array('message' => 'Capaian halaman tidak dibenarkan. Sila Log Masuk', 'class' => 'danger')); //danger or success
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
        //$data['status_name'] = $this->ParamModel->read_pre('100', false);

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
            array('field' => 'nric', 'label' => 'No Kad Pengenalan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'name', 'label' => 'Nama Penuh', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'branch', 'label' => 'Cawangan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'num_account', 'label' => 'No Akaun', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                ))
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
                'catatan' => $this->input->post('catatan'),
                'status' => $this->input->post('status'),

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
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya disimpan.', 'class' => 'success')); //danger or success
            redirect('claims/upload/' . $insert_id); // back to the index
        }

    }

    /**
     * @param null $id
     */
    public function edit($view, $id = null)
    {

        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('claims/index'); // back to the index
        }

        //check if $id is missing, use post(id) as replace segment id
        $id = ($this->input->post() ? $this->input->post('id') : $id);
        $data['claim'] = $this->ClaimModel->read($id);
        $data['funds'] = $this->ItemModel->listing_join($id);
        $data['bank'] = $this->ParamModel->read_pre('30', false);
        $data['status'] = $this->ParamModel->read_pre('100');

        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'nric', 'label' => 'No Kad Pengenalan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'name', 'label' => 'Nama Penuh', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'branch', 'label' => 'Cawangan', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'num_account', 'label' => 'No Akaun', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                ))
        ));
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = 'claims/edit';
            $this->load->view('layouts/default', $data);
        } else {
            $post = $this->input->post();
            $count = $this->input->post('count') - 1;


            $data = array(
                'id' => $this->input->post('id'),
                'nric' => $this->input->post('nric'),
                'branch' => $this->input->post('branch'),
                'bank_account' => $this->input->post('bank_account'),
                'num_account' => $this->input->post('num_account'),
                'sum' => $this->input->post('sum'),
                'catatan' => $this->input->post('catatan'),
                'status' => $this->input->post('status'),

            );

            $this->ClaimModel->modified($data); //load model

            $data = array();
            for ($x = 0; $x <= $count; $x++) {
                if ($post['qty-' . $x] != 0) {
                    $data[$x]['claim_id'] = $id;
                    $data[$x]['fund_id'] = $post['fund-' . $x];
                    $data[$x]['qty'] = $post['qty-' . $x];
                    $data[$x]['amount'] = $post['amount-' . $x];
                }
            }

            $this->ItemModel->clear($id);
            $this->ItemModel->create($data);
            $redirect = $this->input->post('redirect');
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya kemaskini.', 'class' => 'success')); //danger or success
            redirect("claims/$redirect"); // back to the index
        }
    }

    /**
     * @param null $id
     */
    public function view($view, $id = null)
    {
        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }
        $data['funds'] = $this->ItemModel->listing_join($id);
        $data['claim'] = $this->ClaimModel->read($id);
        $data['attaches'] = $this->AttachmentModel->listing($id);
        $data['main'] = '/claims/view';
        $this->load->view('layouts/default', $data);
    }

    /**
     * @param null $id
     */
    public function cetak($id = null)
    {
        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }
        $data['funds'] = $this->ItemModel->listing_join($id);
        $data['claim'] = $this->ClaimModel->read($id);
        $data['attaches'] = $this->AttachmentModel->listing($id);
        $data['main'] = '/claims/cetak';
        $this->load->view('layouts/default_print', $data);
    }


    /**
     * delete method
     * @claim string user_id
     */
    public function delete($id)
    {
        //Cheching data is not empty
        if (!$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('claims/index'); // back to the index
        }
        if ($this->ClaimModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dihapuskan.', 'class' => 'success')); //danger or success
            redirect('claims/index'); // back to the index
        }

    }

    /**
     * @param null $id
     */
    public function upload($id = null)
    {
        if (!empty($id) && !$this->ClaimModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
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
            array('field' => 'title', 'label' => 'Tajuk Fail', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'document', 'label' => 'Dokumen', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                ),)
        ));

        //if validation not run, just show form
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/claims/upload';
            $this->load->view('layouts/default', $data);
        } else {

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
                $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya disimpan.', 'class' => 'success')); //danger or success
            } else {
                $this->session->set_flashdata('item', array('message' => 'Maklumat gagal disimpan. Sila cuba lagi. ' . $this->ralat($error), 'class' => 'danger')); //danger or success
            }
            redirect('claims/upload/' . $id); // back to the index
        }
    }

    /**
     * @param $id
     */
    public function del_file($id)
    {
        //Cheching data is not empty
        $attachment = $this->AttachmentModel->read($id);
        if (!$attachment) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('claims/index'); // back to the index
        }
        if ($this->AttachmentModel->delete($id)) {
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Maklumat berjaya dihapuskan.', 'class' => 'success')); //danger or success
            redirect('claims/upload/' . $attachment['claim_id']); // back to the index
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


    /**
     *
     */
    public function ajax_member()
    {
        if ($this->input->is_ajax_request()) {
            $key = $this->input->post('key');
            $val = $this->input->post('val');
            $member = $this->MemberModel->read_by($key, $val); //load model
            if (!empty($member)) {
                $already = $this->ClaimModel->already($member['nric']); //load model
                if ($already) {
                    $data['data'] = $member;
                    $data['result'] = true;
                } else {
                    $data['data'] = 'Permohonan terdahulu masih wujud dan belum di luluskan.\nSila semak status permohonan dengan menggunakan No Kad Pengenalan';
                    $data['result'] = false;
                }
            } else {
                $data['data'] = 'Maklumat tidak wujud.';
                $data['result'] = false;
            }
            echo json_encode($data);
        } else {
            exit('No direct script access allowed');

        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guests extends CI_Controller
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
    }

    /**
     *
     */
    public function index()
    {
        $data['main'] = '/guests/index';
        $this->load->view('layouts/default_guest', $data);
    }

    /**
     *
     */
    public function ahli_daftar()
    {
//        var_dump('<pre>');
//        var_dump($this->input->post());
        $data['status'] = $this->ParamModel->read_pre('100');
        $data['states'] = $this->StateModel->read_pre();
        //set form validation
        $this->form_validation->set_rules(array(
            array('field' => 'name', 'label' => 'Nama', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|is_unique[members.email]',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'valid_email' => '{field} tidak sah.',
                    'is_unique' => 'Maklumat {field} telah digunakan.'
                )),
            array('field' => 'phone', 'label' => 'No Telefon', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'telephone', 'label' => 'No Telefon Bimbit', 'rules' => 'required',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                )),
            array('field' => 'nric', 'label' => 'No K/P', 'rules' => 'required|numeric|is_unique[members.nric]',
                'errors' => array(
                    'required' => 'Medan {field} wajib diisi.',
                    'numeric' => '{field} tidak sah.',
                    'is_unique' => 'Maklumat {field} telah wujud.'
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
            $data['main'] = '/guests/ahli_daftar';
            $this->load->view('layouts/default_guest', $data);
        } else {
            $data = array(
                'date_register' => date("Y-m-d"),
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'telephone' => $this->input->post('telephone'),
                'nric' => $this->input->post('nric'),
                'age' => $this->input->post('age'),
                'year' => $this->input->post('year'),
                'dob' => date("Y-m-d", strtotime($this->input->post('dob'))),
                'dop' => date("Y-m-d", strtotime($this->input->post('dop'))),
                'state_id' => $this->input->post('state_id'),
                'add_office' => $this->input->post('add_office'),
                'address' => $this->input->post('address'),
                'status' => 1001,
                'is_active' => 0,
            );
            $this->MemberModel->create($data); //load model
            //set flash message
            $this->session->set_flashdata('item', array('message' => 'Makumat berjaya dihantar.', 'class' => 'success')); //danger or success
            redirect('/guests/ahli_semak/'); // back to the index
        }
    }

    /**
     * @param null $id
     */
    public function ahli_papar($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        $data['status'] = array('' => '--Tiada Maklumat--', '0' => 'Tidak Aktif', '1' => 'Aktif');
        $data['member'] = $this->MemberModel->read($id);
        $data['main'] = '/guests/ahli_papar';
        $this->load->view('layouts/default_guest', $data);
    }

    /**
     * @param null $id
     */
    public function ahli_cetak($id = null)
    {
        if (!empty($id) && !$this->MemberModel->exists($id)) {
            $this->session->set_flashdata('item', array('message' => 'Maklumat tidak sah atau tidak wujud.', 'class' => 'danger')); //danger or success
            redirect('members/index'); // back to the index
        }

        $data['status'] = array('' => '--Tiada Maklumat--', '0' => 'Tidak Aktif', '1' => 'Aktif');
        $data['member'] = $this->MemberModel->read($id);
        $data['main'] = '/guests/ahli_cetak';
        $this->load->view('layouts/default_print', $data);
    }

    public function ahli_semak()
    {
        $is_exists = false;
        $this->form_validation->set_rules(
            'nric', 'No K/P',
            'required|numeric|min_length[12]|max_length[12]|callback_check_nric',
            array(
                'required' => 'Medan {field} wajib diisi.',
                'numeric' => '{field} tidak sah.'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $data['main'] = '/guests/ahli_semak';
            $this->load->view('layouts/default_guest', $data);
        } else {

            $result = $this->MemberModel->status($this->input->post('nric'));
            //var_dump($result['status']);
            if (in_array($result['status'], array(1001, 1002, 1005, 1006))) {
                $data['member'] = $result;
                $data['main'] = '/guests/pemohon_papar';
            } elseif ($result['is_active']) {
                $data['member'] = $result;
                $data['main'] = '/guests/ahli_papar';
            } else {
                $data['main'] = '/guests/pesara_papar';
            }

            $this->load->view('layouts/default_guest', $data);
        }
    }

    public function check_nric($str)
    {
        $result = $this->MemberModel->status($str);
        if (!$result) {
            $this->form_validation->set_message('check_nric', 'Maklumat tidak sah/ Maklumat tidak dijumpai');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function bantuan_daftar()
    {
        $data['main'] = '/guests/bantuan_daftar';
        $this->load->view('layouts/default_guest', $data);
    }

    public function bantuan_semak()
    {
        $data['main'] = '/guests/bantuan_semak';
        $this->load->view('layouts/default_guest', $data);
    }
}

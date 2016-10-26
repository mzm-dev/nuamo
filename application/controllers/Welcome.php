<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
            redirect('auths/login');
        }
    }

    public function index()
    {

        //Count Member
        $data['countMember'] = $this->MemberModel->count_all();
        //Count Ex Member
        $data['countEx'] = $this->MemberModel->count_all(0);
        //Count New Applied
        $pending = array('1001', '1002', '1005');
        $data['countNew'] = $this->MemberModel->count_all(0, $pending);

        $data['main'] = 'welcome_message';
        $this->load->view('layouts/default', $data);
    }
}

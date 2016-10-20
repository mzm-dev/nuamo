<?php

class AuthModel extends CI_Model {
    protected $Table;
    protected $username;
    public function __construct() {
        $this->Table = 'users';
        $this->load->database();
        $this->username = 'email';
    }

    /**
     * exists user
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function exists($username) {
        $this->db->where($this->username, $username);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }

    /**
     * check_password
     * @return void    
     * @desc get userdata before check password hash match
     */
    public function check_password($data) {
        $result = $this->exists($data[$this->username]);

        if ($this->pwd_verify($data['password'], $result['password'])) {
            return TRUE;
        }
    }

    /**
     * check_Current_password
     * @return void    
     * @desc get userdata before check password hash match
     */
    public function check_current_password($data) {
        $result = $this->exists($data[$this->username]);

        if ($this->pwd_verify($data['current_password'], $result['password'])) {
            return TRUE;
        }
    }

    /**
     * check_password
     * @return void    
     * @desc get userdata before check password hash match
     */
    public function login($data) {
        if ($this->check_password($data)) {
            $this->session->set_userdata('user_session', $this->exists($data[$this->username]));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * pwd_hash
     * @return void
     * @API password_hash()
     */
    public function pwd_hash($password) {
        $hash = $this->generate_salt(23);
        $options = [
            'salt' => $hash, //write your own code to generate a suitable salt
            'cost' => 11 // the default cost is 10
        ];
        //return $result = ['salt' => $hash, 'password' => password_hash($password, PASSWORD_DEFAULT, $options)];
        return $result = password_hash($password, PASSWORD_DEFAULT, $options);
    }

    /**
     * pwd_verify
     * @return void
     * @API password_verify()
     */
    public function pwd_verify($password, $hash) {

        if (password_verify($password, $hash)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * generate_salt
     * @return void
     */
    private function generate_salt($length = 22) {
        $chars = "@#$&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

}

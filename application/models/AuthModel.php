<?php

class AuthModel extends CI_Model
{
    protected $Table;
    protected $username;
    protected $sessionLogin;

    public function __construct()
    {

        $this->Table = 'users';
        $this->load->database();
        $this->username = 'email';
        $this->sessionLogin = $this->config->item('session_login');
    }

    /**
     * exists user
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function exists($val, $key = null)
    {
        $param = ($key ? $key : $this->username); //If key empty, use default param in construct
        $this->db->where($param, $val);
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
    public function check_password($data)
    {
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
    public function check_current_password($data)
    {
        $result = $this->exists($data['id'],'id');
        var_dump($result);

        if ($this->pwd_verify($data['current_password'], $result['password'])) {
            return TRUE;
        }
    }

    /**
     * check_password
     * @return void
     * @desc get userdata before check password hash match
     */
    public function login($data)
    {

        $this->remove_token(true); //RUN to clear token expired

        if ($this->check_password($data)) {
            $this->session->set_userdata('user_session', $this->exists($data[$this->username]));
            $this->session->mark_as_temp('user_session', $this->sessionLogin);
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
    public function pwd_hash($password)
    {
        $hash = $this->generate_password(23);
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
    public function pwd_verify($password, $hash)
    {

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
    public function generate_salt($length = 22)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    /**
     * generate password
     * @return void
     */
    public function generate_password($length = 6)
    {
        $this->remove_token(true); //RUN to clear token expired
        
        $chars = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%&";
        $str = '';
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    /**
     * remove all token
     * @param $true
     */
    public function remove_token($true)
    {
        if($true){
            $this->db->set('token_exp', null);
            $this->db->set('token_key', null);
            $this->db->where('token_exp <', date('Y-m-d H:i:s'));
            $this->db->update($this->Table);
        }
    }
}

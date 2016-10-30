<?php

class UserModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'users';
        $this->load->database();
    }

    /**
     * exists data
     * @user $id
     * @return bool
     * @desc This function use for checking whether data exists or not
     */
    public function exists($val, $key = null)
    {
        $param = ($key ? $key : 'id');
        $this->db->where($param, $val);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * @user $limit
     * @user $offset
     * @return mixed
     */
    public function all($limit, $offset)
    {
        $offset = ($offset > 0 ? ($offset - 1) * $limit : $offset);
        
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    public function listing()
    {
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * insert new data
     * @user $data
     * @return void
     */
    public function create($data)
    {
        $this->db->set('created', date("Y-m-d H:i:s")); //set datetime for created
        $this->db->set('modified', date("Y-m-d H:i:s")); //set datetime for modified
        $this->db->insert($this->Table, $data);
    }

    /**
     * read exist data
     * @user int id
     * @return void
     */
    public function read($id)
    {
        $this->db->where('id', $id);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }
    /**
     * read exist data
     * @user int id
     * @return void
     */


    /**
     * modified exist data
     * @user data
     * @return void
     */
    public function modified($data)
    {
        $this->db->set('modified', date("Y-m-d H:i:s")); //set datetime for modified
        $this->db->where('id', $data['id']);
        $this->db->update($this->Table, $data);
    }

    /**
     * delete  exist data
     * @user $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
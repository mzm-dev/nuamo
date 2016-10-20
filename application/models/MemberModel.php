<?php

class MemberModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'members';
        $this->load->database();
    }

    /**
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function all($is_active, $limit, $offset)
    {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $codes = array('1004');
        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);

        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    /**
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function all_newer($limit, $offset)
    {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }

        $codes = array('1001', '1002', '1005');
        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', 0);
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);

        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', 0);
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    /**
     * exists data
     * @param $id
     * @return bool
     * @desc This function use for checking whether data exists or not
     */
    public function exists($id)
    {
        $this->db->where('id', $id);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * insert new data
     * @param $data
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
     * @param int id
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
     * @param int id
     * @return void
     */
    public function read_by($key, $val)
    {
        $this->db->select('id, name, nric,email');
        $this->db->where($key, $val);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }

    /**
     * modified exist data
     * @param data
     * @return void
     */
    public function modified($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->set('modified', date("Y-m-d H:i:s")); //set datetime for modified
        $this->db->update($this->Table, $data);
    }

    /**
     * delete  exist data
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
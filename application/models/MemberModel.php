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
    public function all($search, $is_active, $limit, $offset)
    {
        $codes = array('1004');
        $offset = ($offset > 0 ? ($offset - 1) * $limit : $offset);
        //Get all data

        if ($search) {
            $this->db->like('nric', $search);
            $this->db->or_like('name', $search);
        }
        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);

        //count all results
        if ($search) {
            $this->db->like('nric', $search);
            $this->db->or_like('name', $search);
        }
        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
        $result['num_rows'] = $this->db->count_all_results($this->Table);

        return $result;
    }

    /**
     * @param int $is_active
     * @param array $codes
     * @return mixed
     */
    public function count_all($is_active = 1, $codes = array('1004'))
    {
        $this->db->where_in('status', $codes);
        $this->db->where('is_active', $is_active);
        $this->db->from($this->Table);
        return $this->db->count_all_results(); // Produces an integer, like 17

    }

    /**
     * @return void
     * @desc This function use for checking whether data exists or not
     */
    public function all_newer($search, $is_active, $limit, $offset)
    {
        $codes = array('1001', '1002', '1005');
        $offset = ($offset > 0 ? ($offset - 1) * $limit : $offset);

        //Num Rows
        if ($search) {
            $this->db->like('nric', $search);
            $this->db->or_like('name', $search);
        }

        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);

        //Num All Rows
        if ($search) {
            $this->db->like('nric', $search);
            $this->db->or_like('name', $search);
        }
        $this->db->where_in('status', $codes);
        $this->db->where_in('is_active', $is_active);
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
        $Q = $this->db->get_where($this->Table, array('id' => $id));
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
        $array = array(
            'created' => date("Y-m-d H:i:s"), //set datetime for created
            'modified' => date("Y-m-d H:i:s") //set datetime for modified
        );
        $this->db->set($array);
        $this->db->insert($this->Table, $data);
    }

    /**
     * read exist data
     * @param int id
     * @return void
     */
    public function read($id)
    {
        $this->db->select($this->Table . '.*, params.name "status_name"');
        $this->db->from($this->Table);
        $this->db->where("$this->Table.id", $id);
        $this->db->join('params', "params.code = $this->Table.status");
        $Q = $this->db->get();
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
        $is_active = 1;
        $codes = '1004';
        $this->db->select('id, name, nric,email', 'is_active');
        $Q = $this->db->get_where($this->Table, array($key => $val, 'status' => $codes, 'is_active' => $is_active));
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
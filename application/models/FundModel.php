<?php

class FundModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'funds';
        $this->load->database();
    }

    /**
     * exists data
     * @fund $id
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
     * @fund $limit
     * @fund $offset
     * @return mixed
     */
    public function all($limit, $offset)
    {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by('rank', 'ASC');
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    public function listing() {
        $this->db->order_by('rank', 'ASC');
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }
    /**
     * insert new data
     * @fund $data
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
     * @fund int id
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
     * @fund int id
     * @return void
     */


    /**
     * modified exist data
     * @fund data
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
     * @fund $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
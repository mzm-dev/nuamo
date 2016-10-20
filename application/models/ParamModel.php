<?php

class ParamModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'params';
        $this->load->database();
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
     * @param $limit
     * @param $offset
     * @return mixed
     */
    public function all($limit, $offset)
    {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $result['rows'] = $this->db->get($this->Table, $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    /**
     * insert new data
     * @param $data
     * @return void
     */
    public function create($data)
    {
        $this->db->set('status', 1); //set status value
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


    /**
     * read exist data
     * @param int id
     * @return void
     */
    public function read_pre($pre, $pilih = true)
    {
        $data = array();
        // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        $this->db->like('code', $pre, 'after');
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            $params = $Q->result_array();
            foreach ($params as $param) {
                if($pilih){
                    $data[''] = '--Pilih--';
                }
                $data[$param['code']] = $param['name'];
            }
            return $data;
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
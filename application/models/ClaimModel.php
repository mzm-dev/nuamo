<?php

class ClaimModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'claims';
        $this->load->database();
    }

    /**
     * exists data
     * @claim $id
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
     * @claim $limit
     * @claim $offset
     * @return mixed
     */
    public function all($limit, $offset)
    {
        $offset = ($offset > 0 ? ($offset - 1) * $limit : $offset);

        $this->db->select($this->Table . '.*,members.id "member_id", members.name "member_name"');
        $this->db->from($this->Table);
        $this->db->join('members', "members.nric = $this->Table.nric");
        $this->db->limit($limit, $offset);

        $result['rows'] = $this->db->get();
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    /**
     * insert new data
     * @claim $data
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
        return $this->db->insert_id();
    }

    /**
     * read exist data
     * @claim int id
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
     * @claim int id
     * @return void
     */
    public function read_pre($pre, $pilih = true)
    {
        $data = array();
        // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        $this->db->like('code', $pre, 'after');
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            $claims = $Q->result_array();
            foreach ($claims as $claim) {
                if ($pilih) {
                    $data[''] = '--Pilih--';
                }
                $data[$claim['code']] = $claim['name'];
            }
            return $data;
        }

    }

    /**
     * modified exist data
     * @claim data
     * @return void
     */
    public function modified($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update($this->Table, $data);
    }

    /**
     * delete  exist data
     * @claim $id
     * @return bool
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
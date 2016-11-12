<?php

class AttachmentModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'attachments';
        $this->load->database();
    }

    public function read($id)
    {
        $this->db->where('id', $id);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->row_array();
        }
    }

    /**
     * @return mixed
     */
    public function listing($id = null)
    {
        $this->db->where('claim_id', $id);
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
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
        );
        $this->db->set($array);
        $this->db->insert($this->Table, $data);
        return $this->db->insert_id();
    }

    /**
     * delete  exist data
     * @claim $id
     * @return bool
     */
    public function delete($id)
    {
        $attach = $this->read($id);
        //Remove file while delete
        $path_to_file = './uploads/' . $attach['file_name'];
        unlink($path_to_file);

        //delete data 
        $this->db->where('id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
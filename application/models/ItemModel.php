<?php

class ItemModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'items';
        $this->load->database();
    }

    /**
     * insert new data
     * @claim $data
     * @return void
     */
    public function create($data)
    {
        $this->db->insert_batch($this->Table,$data);
    }

    /**
     * @return mixed
     */
    public function listing($id = null) {

        $this->db->select($this->Table . '.*, funds.id "funds_id", funds.name "funds_name", funds.amount "funds_amount"');
        $this->db->from($this->Table);
        $this->db->join('funds', "funds.id = $this->Table.fund_id");
        $this->db->where('claim_id', $id);
        $this->db->order_by('rank', 'ASC');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }
}
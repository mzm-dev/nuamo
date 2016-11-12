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
        $this->db->insert_batch($this->Table, $data);
    }

    public function modified($data)
    {
        $this->db->update_batch($this->Table, $data, 'id');
    }

    /**
     * @return mixed
     */
    public function listing($id = null)
    {

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

    /**
     * @return mixed
     */
    public function listing_join($id = null)
    {

        //SELECT funds.*, items.claim_id, items.fund_id, items.qty, items.amount FROM items
        //RIGHT JOIN funds ON funds.id = items.fund_id  AND items.claim_id = 5
        //ORDER BY `funds`.`rank` ASC
        $this->db->select("funds.*, $this->Table.id 'item_id', $this->Table.claim_id, $this->Table.fund_id, $this->Table.qty");
        $this->db->from($this->Table);
        $this->db->join('funds', "funds.id = $this->Table.fund_id AND $this->Table.claim_id = $id", 'right');
        $this->db->order_by('rank', 'ASC');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            return $Q->result_array();
        }
    }

    /**
     * clear exist data
     * @param $id
     * @return bool
     */
    public function clear($id)
    {
        $this->db->where('claim_id', $id);
        $this->db->delete($this->Table);
        return TRUE;
    }
}
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

}
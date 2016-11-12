<?php

class StateModel extends CI_Model
{
    protected $Table;

    public function __construct()
    {
        $this->Table = 'states';
        $this->load->database();
    }

    /**
     * untuk senarakan semua data
     * @state $limit
     * @state $offset
     * @return mixed
     */
    public function all($limit, $offset)
    {
        //Offset 0 hingga liimit yang ditetapkan
        //cth page1, 0,5
        //cth page2, 5,10
        $offset = ($offset > 0 ? ($offset - 1) * $limit : $offset);

        //hasil dapatkan data
        $result['rows'] = $this->db->get('states', $limit, $offset);

        //kira hasil dapatkan data
        $result['num_rows'] = $this->db->count_all_results($this->Table);
        return $result;
    }

    /**
     * read exist data and untuk hasilkan dropdown
     * @state int id
     * @return void
     */
    public function read_pre($pilih = true)
    {
        $data = array();
        // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        //$this->db->like('code', $pre, 'after');
        $Q = $this->db->get($this->Table);
        if ($Q->num_rows() > 0) {
            $states = $Q->result_array();
            foreach ($states as $state) {
                if($pilih){
                    $data[''] = '--Pilih--';
                }
                $data[$state['code']] = $state['name'];
            }
            return $data;
        }

    }

}
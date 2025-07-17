<?php
class M_Survey extends CI_Model {
    
    private $_table = 'survey';

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

	public function search($keyword)
	{
		if(!$keyword){
			return null;
		}
		// $this->db->like('nama_survey', $keyword);
		$this->db->like('token_survey', $keyword);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

    // public function get_survey_by_id($id_survey) {
    //     $this->db->select('*');
    //     $this->db->from('survey');
    //     $this->db->where('id_survey', $id_survey);
    //     $query = $this->db->get();
    //     return $query->row();
    // }
}
?>

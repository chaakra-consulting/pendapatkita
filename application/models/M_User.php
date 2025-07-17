<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_User extends CI_Model
{
	function login($data)
	{
		$this->db->select('surveyor.id_surveyor, surveyor.nama, surveyor.nis');
		$this->db->from('surveyor');
		//$this->db->join('kelas', 'surveyor.kelas=kelas.id_kelas');
		$this->db->where($data);
		return $this->db->get();
	}

	function ceknis($whr)
	{
		$this->db->select('nis, pertanyaan');
		return $this->db->get_where('surveyor', $whr);
	}
	function cekjawab($whr)
	{
		$this->db->select('nis, jawaban');
		return $this->db->get_where('surveyor', $whr);
	}
	function resetpasswd($table, $where, $data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function cekdefpass($id)
	{
		$this->db->select('password, pertanyaan, jawaban');
		return $this->db->get_where('surveyor', $id);
	}
	function cekpass($whr)
	{
		$this->db->select('password');
		return $this->db->get_where('surveyor', $whr);
	}

	function gantipass($data, $whr)
	{
		$this->db->where($whr);
		$this->db->update('surveyor', $data);
	}

	//Jadwal Ujian
	// function jadwal_ujian($where){
	// 	$this->db->select('ujian.*, kelas.id_kelas, kelas.kode_kelas, mapel.*');
	//        $this->db->from('ujian');
	//        $this->db->join('kelas', 'ujian.id_kelas=kelas.id_kelas');
	//        $this->db->join('mapel', 'ujian.id_mapel=mapel.id_mapel');
	//        $this->db->where($where);
	//        return $this->db->get();
	// }
	function jadwal_ujian($id_surveyor)
	{
		return $this->db->query("SELECT ujian.*, (SELECT count(id_tes) FROM ikut_ujian WHERE ikut_ujian.id_siswa=" . $id_surveyor . " AND ikut_ujian.id_ujian=
		ujian.id_ujian) AS sudah_ikut, (SELECT mapel FROM mapel WHERE mapel.id_mapel=ujian.id_mapel) AS mapel, 
		(SELECT status FROM ikut_ujian WHERE ikut_ujian.id_siswa=" . $id_surveyor . " AND ikut_ujian.id_ujian=ujian.id_ujian) AS status FROM ujian, 
		surveyor WHERE ujian.id_kelas=surveyor.kelas AND surveyor.id_surveyor=" . $id_surveyor . " ORDER BY sudah_ikut ASC");
	}

	function list_survey($id_surveyor = FALSE)
	{
		return $this->db->query("SELECT * FROM survey");
	}

	function list_survey_koordinator()
	{
		$idsurvyor = $this->session->id;

		$this->db->select('*');
		$this->db->from('surveyor');
		$this->db->join('koordinator', 'surveyor.koordinator=koordinator.id_koordinator');
		$this->db->join('survey', 'koordinator.survey_aktif=survey.id_survey');
		$this->db->where('id_surveyor', $idsurvyor);
		return $this->db->get();
	}


	//Ujian
	function ujian($whr)
	{
		$this->db->select('*');
		$this->db->from('ujian');
		$this->db->join('mapel', 'ujian.id_mapel=mapel.id_mapel');
		$this->db->where($whr);
		return $this->db->get();
	}
	function cek_selesai_ujian($whr)
	{
		return $this->db->get_where('ikut_ujian', $whr);
	}
	function cek_detil_tes($whr)
	{
		return $this->db->get_where('ujian', $whr);
	}
	function cek_detil_survey($whr)
	{
		return $this->db->get_where('survey', $whr);
	}


	function data_jawaban_survey($kode)
	{
		$this->db->select('*');
		$this->db->from('jawaban_survey');
		$this->db->where('js_kodesurvey', $kode);
		//		 $this->db->where('ps_status',0);
		/*
			if($id==TRUE){
				$this->db->where('id_seksi',$id);
			}
		*/
		return $this->db->get();
	}

	function list_pertanyaan_by_seksi($id)
	{
		$this->db->select('*');
		$this->db->from('pertanyaan_survey');
		$this->db->where('ps_id_seksi', $id);
		$this->db->where('ps_status', 0);
		/*
			if($id==TRUE){
				$this->db->where('id_seksi',$id);
			}
		*/
		return $this->db->get();
	}

	function pertanyaan_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('pertanyaan_survey');
		$this->db->where('ps_id', $id);
		$this->db->where('ps_status', 0);
		/*
			if($id==TRUE){
				$this->db->where('id_seksi',$id);
			}
		*/
		$query = $this->db->get();
		return $query->row(); 
	}

	function list_seksi_by_survey($id = FALSE)
	{
		$this->db->select('*');
		$this->db->from('seksi_survey');
		$this->db->join('survey', 'seksi_survey.ss_id_survey=survey.id_survey');
		$this->db->where('ss_status', 0);

		if ($id == TRUE) {
			$this->db->where('id_survey', $id);
		}

		return $this->db->get();
	}

	public function uploadImg($a)
	{
		$config['upload_path'] = './assets/validasi/';
		$config['allowed_types'] = 'jpg|png|jpeg|image/png|image/jpg|image/jpeg';
		$config['max_size'] = '40777';
		$config['file_name'] = round(microtime(true) * 1000);

		$this->load->library('upload', $config);
		if ($this->upload->do_upload($a)) {
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		} else {
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	public function hitung_survey_byid($id, $user)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=1');
	}

	public function hitung_survey_byid_pending($id, $user)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=0');
	}


	public function cekdata_survey($kodesurvey)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_kodesurvey=' . $kodesurvey);
	}

	public function cekdata_survey_temp($kodesurvey, $kdseksi)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query("SELECT count(*) as jumsurvey FROM temp_jawaban_survey WHERE tjs_gen_id='" . $kodesurvey . "' AND tjs_seksi='" . $kdseksi . "'");
	}

	public function data_survey_temp($kodesurvey, $kdseksi)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query("SELECT * FROM temp_jawaban_survey WHERE tjs_gen_id='" . $kodesurvey . "' AND tjs_seksi='" . $kdseksi . "'");
	}

	public function data_survey_temp_all($kodesurvey)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query("SELECT * FROM temp_jawaban_survey WHERE tjs_gen_id='" . $kodesurvey . "' AND tjs_status='0'");
	}

	function updateSurvey($where, $data)
	{
		$this->db->where($where);
		return $this->db->update('jawaban_survey', $data);
		//return TRUE;
	}

	function update_jawaban($data_jawaban, $kode_survey)
	{
		$this->db->where('js_kodesurvey', $kode_survey);
		return $this->db->update('jawaban_survey', $data_jawaban);
		//return TRUE;
	}
	function update_jawaban_temp_uploaded($data_jawaban, $kode_survey)
	{
		$this->db->where('tjs_gen_id', $kode_survey);
		return $this->db->update('temp_jawaban_survey', $data_jawaban);
		//return TRUE;
	}

	function update_jawaban_temp($data_tmbh_temp, $kode_survey, $kdseksi)
	{
		$this->db->where('tjs_gen_id', $kode_survey);
		$this->db->where('tjs_seksi', $kdseksi);
		return $this->db->update('temp_jawaban_survey', $data_tmbh_temp);
		//return TRUE;
	}

	public function list_hasil_survey($id, $user)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT * FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=1');
	}

	public function list_hasil_survey_pending($id, $user)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT * FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=0');
	}

	// function seksi_survey($id)
	// {
	// 	//return $this->db->get_where($mapel, $id_surveyor);
	// 	return $this->db->query('SELECT * FROM soal WHERE mapel=' . $mapel . ' AND kelas=' . $kelas);
	// }

	function cek_sdh_ujian($whr)
	{
		return $this->db->get_where('ikut_ujian', $whr);
	}
	function q_soal($mapel, $kelas)
	{
		//return $this->db->get_where($mapel, $id_surveyor);
		return $this->db->query('SELECT * FROM soal WHERE mapel=' . $mapel . ' AND kelas=' . $kelas);
	}
	function tambah_ujian($data)
	{
		$this->db->insert('ikut_ujian', $data);
	}
	function tambah_jawaban($data)
	{
		return $this->db->insert('jawaban_survey', $data);
	}
	function tambah_jawaban_temp($data)
	{
		return $this->db->insert('temp_jawaban_survey', $data);
	}
	function detil_soal($whr)
	{
		$this->db->select('ujian.*, guru.nama AS guru, mapel.mapel AS mapel, kelas.kode_kelas AS kelas');
		$this->db->from('ujian');
		$this->db->join('guru', 'ujian.id_guru=guru.id_guru');
		$this->db->join('mapel', 'ujian.id_mapel=mapel.id_mapel');
		$this->db->join('kelas', 'ujian.id_kelas=kelas.id_kelas');
		$this->db->where($whr);
		return $this->db->get();
	}
	function detil_tes($whr)
	{
		return $this->db->get_where('ikut_ujian', $whr);
	}

	// public function search($keyword)
	// {
	// 	if(!$keyword){
	// 		return null;
	// 	}
	// 	// $this->db->like('nama_survey', $keyword);
	// 	$this->db->like('token_survey', $keyword);
	// 	$query = $this->db->get($this->_table);
	// 	return $query->result();
	// }
}

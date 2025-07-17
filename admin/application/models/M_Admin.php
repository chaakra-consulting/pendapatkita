<?php

class M_Admin extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    //Login
    function login_admin($where)
    {
        return $this->db->get_where('admin', $where);
    }

    public function hitung_survey_byid2($id, $user)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        return $this->db->query('SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=1');
    }
    function cek_detil_survey($whr)
    {
        return $this->db->get_where('survey', $whr);
    }

    function cekdefpass($id)
    {
        $this->db->select('password, pertanyaan, jawaban');
        return $this->db->get_where('surveyor', $id);
    }
    public function list_hasil_survey($id, $user)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        return $this->db->query('SELECT * FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=1');
    }

    public function hitung_survey_byid_pending($id, $user)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        return $this->db->query('SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_survey_id=' . $id . ' AND js_surveyor=' . $user . ' AND js_valid=0');
    }

    function login_guru($where)
    {
        //return $this->db->get_where('guru', $where);
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'guru.mapel=mapel.id_mapel');
        $this->db->where($where);
        return $this->db->get();
    }

    function login_koordinator($where)
    {
        //return $this->db->get_where('guru', $where);
        $this->db->select('*');
        $this->db->from('koordinator');
        $this->db->where($where);
        return $this->db->get();
    }



    //Cek password admin
    function cek_passwd_admin($where)
    {
        $this->db->select('password');
        return $this->db->get_where('admin', $where);
    }
    //Cek Password Default Guru
    function cek_passwd_guru($where)
    {
        $this->db->select('guru.username, guru.password');
        return $this->db->get_where('guru', $where);
    }
    //Ganti Password Guru
    function update_passwd($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    //Halaman Utama


    //koordinator
    function list_koordinator()
    {
        //return $this->db->get('koordinator');
        $this->db->select('*');
        $this->db->from('koordinator');
        $this->db->join('survey', 'survey.id_survey=koordinator.survey_aktif');
        //$this->db->order_by('mapel.mapel', 'asc');
        $query = $this->db->get();
        return $query;
    }
    function insert_koordinator($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function update_koordinator($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_koordinator($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }



    //Surveyor

    function list_survey_by_koordinator($id)
    {
        return $this->db->query('select * from koordinator join survey on koordinator.survey_aktif=survey.id_survey WHERE id_koordinator=' . $id);
        //return $this->db->query('select * from survey WHERE');
    }
    function list_surveyor()
    {
        // return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
        return $this->db->query('SELECT a.*,c.nama_survey,c.kode_survey, b.*, b.nama AS namkod,a.nama AS namyor,a.password AS passyor FROM surveyor a LEFT JOIN koordinator b ON a.`koordinator`=b.`id_koordinator` LEFT JOIN survey c ON b.`survey_aktif`=c.`id_survey` ORDER BY nis');
    }
    function listsurveyor_by_koordinator($id)
    {
        // return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
        return $this->db->query('select surveyor.* from surveyor WHERE koordinator=' . $id . ' order by nis');
    }

    public function pertanyaan_survey($id)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        // return $this->db->query('SELECT * FROM pertanyaan_survey WHERE ps_id_survey=' . $id . ' AND ps_status=0 ORDER BY ps_id_seksi ASC');
        $query = "
            SELECT * FROM pertanyaan_survey 
            WHERE ps_id_survey = ? AND ps_status = 0 
            ORDER BY 
                ps_id_seksi ASC,
                CASE 
                    WHEN ps_kode IS NULL OR ps_kode = '' THEN ps_create
                    ELSE (
                        SELECT MIN(ps_create) 
                        FROM pertanyaan_survey sub 
                        WHERE sub.ps_id_survey = ? 
                        AND sub.ps_status = 0 
                        AND sub.ps_kode = pertanyaan_survey.ps_kode
                        LIMIT 1
                    )
                END ASC,
                CASE 
                    WHEN ps_kode IS NULL OR ps_kode = '' THEN 1 
                    ELSE 0 
                END ASC,
                ps_kode ASC
        ";

        return $this->db->query($query, array($id, $id));
    }
    public function hitung_survey_byid($id)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        return $this->db->query("SELECT count(*) as jumsurvey FROM jawaban_survey WHERE js_survey_id='" . $id . "' AND js_valid='1'");
    }
    public function data_survey_byid($id)
    {
        //return $this->db->get_where($mapel, $id_surveyor);
        return $this->db->query("SELECT * FROM jawaban_survey WHERE js_survey_id='" . $id . "' AND js_valid='1'");
    }

    function list_surveyor_kordinator()
    {
        // return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
        return $this->db->query('select surveyor.*,survey.nama_survey,survey.kode_survey, koordinator.*, koordinator.nama as namkod,surveyor.nama as namyor,surveyor.password as passyor from 
			surveyor join koordinator on surveyor.koordinator=koordinator.id_koordinator and
			koordinator join survey on koordinator.survey_aktif=survey.id_survey
			order by nis');
    }
    function insert_surveyor($table, $data)
    {
        $this->db->insert($table, $data);
    }
    function update_surveyor($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_surveyor($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //Tambah ujian
    function t_ujian($table, $data)
    {
        $this->db->insert($table, $data);
    }
    //Edit ujian
    function e_ujian($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Survey
    function list_survey($id = FALSE)
    {
        $this->db->select('survey.*');
        $this->db->from('survey');
        $this->db->where('is_del', 0);

        if ($this->session->status == 'koordinator') {
            $this->db->where('id_survey', $this->session->survey_aktif);
        }

        if ($id == TRUE) {
            $this->db->where('id_survey', $id);
        }

        return $this->db->get();
    }
    function list_seksi($id = FALSE)
    {
        $this->db->select('*');
        $this->db->from('seksi_survey');
        $this->db->join('survey', 'seksi_survey.ss_id_survey=survey.id_survey');
        $this->db->where('ss_status', 0);

        if ($id == TRUE) {
            $this->db->where('id_seksi', $id);
        }

        return $this->db->get();
    }
    function list_seksi_by_idsurvey($id = FALSE)
    {
        $this->db->select('*');
        $this->db->from('seksi_survey');
        $this->db->join('survey', 'seksi_survey.ss_id_survey=survey.id_survey');
        $this->db->where('ss_status', 0);

        if ($id == TRUE) {
            $this->db->where('ss_id_survey', $id);
        }

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
    function list_pertanyaan($id)
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
    function list_pertanyaan_by_survey($id)
    {
        $this->db->select('*');
        $this->db->from('pertanyaan_survey');
        $this->db->where('ps_id_survey', $id);
        $this->db->where('ps_status', 0);
        
        return $this->db->get();
    }
    //Tambah ujian
    function t_survey($table, $data)
    {
        $this->db->insert($table, $data);
    }

        //Duplikat
        function d_survey($where, $table, $data)
        {
            $this->db->where($where);
            $this->db->insert($table, $data);
        }

    //Edit ujian
    function e_survey($where, $table, $data)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_single_survey_data($id)
    {
        $this->db->where('js_id', $id);
        $this->db->delete('jawaban_survey');
        return $this->db->affected_rows() > 0;
    }

    function delete_multiple_survey_data($ids)
    {
        if (is_array($ids) && count($ids) > 0) {
            $this->db->where_in('js_id', $ids);
            $this->db->delete('jawaban_survey');
            return $this->db->affected_rows() > 0;
        }
        return false;
    }
}
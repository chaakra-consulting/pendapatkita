<?php

class M_Admin extends CI_Model{
    
    function __construct()
    {
        parent::__construct();

    }

    //Login
    function login_admin($where){
        return $this->db->get_where('admin', $where);
    }
    function login_guru($where){
        //return $this->db->get_where('guru', $where);
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->join('mapel', 'guru.mapel=mapel.id_mapel');
        $this->db->where($where);
        return $this->db->get();
    }

    function login_koordinator($where){
        //return $this->db->get_where('guru', $where);
        $this->db->select('*');
        $this->db->from('koordinator');
         $this->db->where($where);
        return $this->db->get();
    }



    //Cek password admin
    function cek_passwd_admin($where){
        $this->db->select('password');
        return $this->db->get_where('admin', $where);
    }
    //Cek Password Default Guru
    function cek_passwd_guru($where){
        $this->db->select('guru.username, guru.password');
        return $this->db->get_where('guru', $where);
    }
    //Ganti Password Guru
    function update_passwd($table, $data, $where){
        $this->db->where($where);
        $this->db->update($table, $data);
    }


    //Halaman Utama


    //koordinator
    function list_koordinator(){
        //return $this->db->get('koordinator');
        $this->db->select('*');
        $this->db->from('koordinator');
        $this->db->join('survey', 'survey.id_survey=koordinator.survey_aktif');
        //$this->db->order_by('mapel.mapel', 'asc');
        $query = $this->db->get();
        return $query;
    }
    function insert_koordinator($table, $data){
        $this->db->insert($table, $data);
    }
    function update_koordinator($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_koordinator($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }


    //Guru
    function list_guru(){
        //return $this->db->get('guru');
        $this->db->select('guru.*, mapel.*');
        $this->db->from('guru');
        $this->db->join('mapel', 'mapel.id_mapel=guru.mapel');
        $this->db->order_by('mapel.mapel', 'asc');
        $query = $this->db->get();
        return $query;
    }
    function insert_guru($table, $data){
        $this->db->insert($table, $data);
    }
    function update_guru($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_guru($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    //Mapel
    function list_mapel(){
        $this->db->order_by('mapel');
        return $this->db->get('mapel');
    }
    function insert_mapel($table, $data){
        $this->db->insert($table, $data);
    }
    function update_mapel($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_mapel($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }


    //Surveyor
    function list_surveyor(){
       // return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
        return $this->db->query('select surveyor.* from surveyor order by nis');
    }
    function list_surveyor_kordinator(){
       // return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
        return $this->db->query('select surveyor.*,survey.nama_survey,survey.kode_survey, koordinator.*, koordinator.nama as namkod,surveyor.nama as namyor from 
			surveyor join koordinator on surveyor.koordinator=koordinator.id_koordinator and
			koordinator join survey on koordinator.survey_aktif=survey.id_survey
			order by nis');
    }
    function insert_surveyor($table, $data){
        $this->db->insert($table, $data);
    }
    function update_surveyor($table, $data, $where){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_surveyor($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }


    //Siswa
    function list_siswa(){
        return $this->db->query('select surveyor.*, kelas.kode_kelas from surveyor join kelas on surveyor.kelas=kelas.id_kelas order by nis');
    }
    function insert_siswa($table, $data){
        $this->db->insert($table, $data);
    }
    function update_siswa($table, $data, $where){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_siswa($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    //Kelas
    function list_kelas(){
        //return $this->db->get('kelas');
        $this->db->select('kelas.*, jurusan.*');
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan=kelas.jurusan');
        $this->db->order_by('kode_kelas');
        $query = $this->db->get();
        return $query;
    }
    function insert_kelas($table, $data){
        $this->db->insert($table, $data);
    }
    function update_kelas($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_kelas($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function pilih_kelas($where){
        $this->db->where($where);
        return $this->db->get('kelas');
    }
    //Jurusan
    function list_jurusan(){
        return $this->db->get('jurusan');
    }
    function insert_jurusan($table, $data){
        $this->db->insert($table, $data);
    }
    function update_jurusan($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function delete_jurusan($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    // tampil hanya kelas
    function perkelas(){
        return $this->db->query('SELECT kelas FROM kelas GROUP BY kelas');
    }
    // tampil perkelas jurusan
    function perkelasjurusan($where){
        $this->db->select('id_kelas, kode_kelas');
        $this->db->from('kelas');
        $this->db->where($where);
        $this->db->order_by('kode_kelas', 'ASC');
        return $this->db->get();
    }

    // tampil perkelas  guru
    function perkelas_g($id){
        return $this->db->query('select kelas.* from soal, guru, kelas where guru.id_guru='.$id.' and soal.guru=guru.id_guru and soal.kelas=kelas.id_kelas group by kode_kelas');
    }
    // tampil perkelas jurusan - guru
    function perkelasjurusan_g($kelas, $idguru){
        return $this->db->query('select kelas.* from soal, guru, kelas where guru.id_guru='.$idguru.' and kelas.kelas='.$kelas.' and soal.guru=guru.id_guru and soal.kelas=kelas.id_kelas group by kode_kelas');
    }
   
    //Soal
    //Tampil Soal Admin
    function soal_admin($pjk, $mapel){
        //return $this->db->get_where('soal', $where);
        return $this->db->query('select soal.*, kelas.id_kelas, kelas.kode_kelas, guru.id_guru, guru.nama, guru.mapel from soal, kelas, guru where soal.kelas='.$pjk.' and soal.mapel='.$mapel.' and soal.kelas=kelas.id_kelas and soal.guru=guru.id_guru');
    }

    //Tampil Soal Guru
    function soal_guru($idguru, $pkj){
        //return $this->db->get_where('soal, guru, kelas', $where);
        return $this->db->query('select soal.*, guru.nama from soal, guru, kelas where guru.id_guru='.$idguru.' and kelas.id_kelas='.$pkj.' and soal.guru=guru.id_guru and soal.kelas=kelas.id_kelas');
    }

    //Tambah soal tanpa media
    function in_soal_nomedia($table, $data){
        $this->db->insert($table, $data);
    }

    //Tambah soal dengan media
    function in_soal_media($table, $data){
        $this->db->insert($table, $data);
    }

    //Update soal tanpa media
    function up_soal_nomedia($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    //Update soal dengan media
    function up_soal_media($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //get soal by id
    function get_soal_by_id($where){
        $this->db->join('kelas', 'soal.kelas=kelas.id_kelas');
        $this->db->join('guru', 'soal.guru=guru.id_guru');
        $this->db->join('mapel', 'soal.mapel=mapel.id_mapel');
        return $this->db->get_where('soal', $where);
    }


    //Tampil kelas
    function vkelas($where){
        return $this->db->get_where('kelas', $where);
    }

    //Ujian
    function list_ujian(){
        $this->db->select('ujian.*, kelas.id_kelas, kelas.kode_kelas, mapel.*, guru.id_guru, guru.nama');
        $this->db->from('ujian');
        $this->db->join('kelas', 'ujian.id_kelas=kelas.id_kelas');
        $this->db->join('mapel', 'ujian.id_mapel=mapel.id_mapel');
        $this->db->join('guru', 'ujian.id_guru=guru.id_guru');
        return $this->db->get();
    }
    //Tambah ujian
    function t_ujian($table, $data){
        $this->db->insert($table, $data);
    }
    //Edit ujian
    function e_ujian($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //Survey
    function list_survey($id=FALSE){
        $this->db->select('survey.*');
        $this->db->from('survey');
		$this->db->where('is_del',0);

			if($id==TRUE){
				$this->db->where('id_survey',$id);
			}
		
        return $this->db->get();
    }
    function list_seksi($id=FALSE){
        $this->db->select('*');
        $this->db->from('seksi_survey');
		$this->db->join('survey', 'seksi_survey.ss_id_survey=survey.id_survey');
		$this->db->where('ss_status',0);

			if($id==TRUE){
				$this->db->where('id_seksi',$id);
			}
		
        return $this->db->get();
    }
    function list_seksi_by_idsurvey($id=FALSE){
        $this->db->select('*');
        $this->db->from('seksi_survey');
		$this->db->join('survey', 'seksi_survey.ss_id_survey=survey.id_survey');
		$this->db->where('ss_status',0);

			if($id==TRUE){
				$this->db->where('ss_id_survey',$id);
			}
		
        return $this->db->get();
    }
    function list_pertanyaan($id){
        $this->db->select('*');
        $this->db->from('pertanyaan_survey');
		 $this->db->where('ps_id_seksi',$id);
		 $this->db->where('ps_status',0);
/*
			if($id==TRUE){
				$this->db->where('id_seksi',$id);
			}
		*/
        return $this->db->get();
    }
    //Tambah ujian
    function t_survey($table, $data){
        $this->db->insert($table, $data);
    }
    //Edit ujian
    function e_survey($where, $table, $data){
        $this->db->where($where);
        $this->db->update($table, $data);
    }

}
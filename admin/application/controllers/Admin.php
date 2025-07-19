<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class Admin extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->db->query('SET time_zone="+7:00"');
		if (!$this->session->status) {
			redirect('login');
		}
		$this->load->model('M_Admin', 'm_admin');
		$this->load->library('form_validation');
		$this->load->helper('string');
	}

	//Header
	private function header($data)
	{
		/*
		//admin
		if ($this->session->status == 'admin') {
			# code...
			$data['perkelas'] = $this->m_admin->perkelas()->result();
		}
		//Guru
		if ($this->session->status == 'guru') {
			# code...
			$guru = $this->session->id;
			$data['perkelas'] = $this->m_admin->perkelas_g($guru)->result();
		}
		//$data['perkelas'] = $this->m_admin->perkelas()->result();
			*/
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
	}

	//Logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	//Index
	public function index()
	{
		//Cek Password Guru
		/*if($this->session->status == 'koordinator'){
			$where = array(
				'id_guru' => $this->session->id
			);
			$data['passwdguru'] = $this->m_admin->cek_passwd_guru($where)->row_array();
		}
		/*
		$data['jmlmapel'] = $this->m_admin->list_mapel()->num_rows();
		$data['jmlsiswa'] = $this->m_admin->list_surveyor()->num_rows();
		$data['jmljurusan'] = $this->m_admin->list_jurusan()->num_rows();
		$data['jmlkelas'] = $this->m_admin->list_kelas()->num_rows();
		*/
		$data['title'] = 'Dashboard';
		if ($this->session->status == 'koordinator') {
			$idkor = $this->session->id;

			$dsurveyor = $this->m_admin->listsurveyor_by_koordinator($idkor)->result();
			$data['listsurvey'] = $this->m_admin->list_survey_by_koordinator($idkor)->result();
			$data['surveyor'] = $dsurveyor;
			$inCes = array();
			foreach ($dsurveyor as $dsurv) {
				$inCes[] = $dsurv->id_surveyor;
			}
			//print_r($inCes);
			$search = $inCes;
			$this->db->select('*');
			$this->db->from('jawaban_survey');
			$this->db->where('js_valid', 1);
			$this->db->where_in('js_surveyor', $search);
			$queryo = $this->db->get();

			$data['listhasilsurvey'] = $queryo->result();
		}

		$this->header($data);
		if ($this->session->status == 'koordinator') {



			$this->load->view('utama-koordinator');
		} elseif ($this->session->status == 'admin') {
			$this->load->view('utama');
		} else {
		}

		$this->load->view('template/footer');
	}

	public function coba()
	{
		echo $this->session->id;
	}
	public function datasurvey($ido, $user)
	{
		$id = ['id_surveyor' => $this->session->id];

		$whr_cek_detil_tes = ['id_survey' => $ido];
		$cek_detil_tes = $this->m_admin->cek_detil_survey($whr_cek_detil_tes)->row();
		$data['detil_survey'] = $cek_detil_tes;

		$data['titleoe'] = $cek_detil_tes->nama_survey;

		$data['ar'] = $this->m_admin->cekdefpass($id)->row_array();
		$data['title'] = 'Pendapat Kita';
		$data['judul'] = 'Data Survey Valid';
		$data['survey'] = $this->m_admin->list_hasil_survey($ido, $user)->result();

		$this->header($data);
		//          $this->load->view('utama');
		$this->load->view('data_survey');
		$this->load->view('template/footer');
	}

	// Guru
	public function koordinator()
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$data['title'] = 'koordinator';
		$data['koordinator'] = $this->m_admin->list_koordinator()->result();
		$data['listsurvey'] = $this->m_admin->list_survey()->result();
		//$data['lists'] = $this->m_admin->list_mapel()->result();

		$this->header($data);
		$this->load->view('koordinator');
		$this->load->view('template/footer');
	}
	public function tambah_koordinator()
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$nama = $this->input->post('nama');
		$survey = $this->input->post('survey');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'survey_aktif' => $survey,
			'password' => $password
		);
		$this->m_admin->insert_koordinator('koordinator', $data);
		redirect('koordinator');
	}
	public function edit_koordinator($id)
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$survey = $this->input->post('survey');
		$where = array('id_koordinator' => $id);
		$data = array(
			'nama' => $nama,
			'username' => $username,
			'survey_aktif' => $survey,
			'password' => $password
		);
		$this->m_admin->update_koordinator($where, 'koordinator', $data);
		redirect('koordinator');
	}
	public function hapus_koordinator($id)
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$where = array('id_koordinator' => $id);
		$this->m_admin->delete_koordinator($where, 'koordinator');
		redirect('koordinator');
	}


	//Surveyor
	public function surveyor()
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$data['title'] = 'surveyor';
		$data['surveyor'] = $this->m_admin->list_surveyor()->result();
		// $data['surveyor'] = $this->m_admin->list_surveyor_kordinator()->result();
		$data['koordinator'] = $this->m_admin->list_koordinator()->result();

		$this->header($data);
		$this->load->view('surveyor');
		$this->load->view('template/footer');
	}
	public function tambah_surveyor()
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$nama = $this->input->post('nama');
		$nis = $this->input->post('nis');
		$password = $this->input->post('nis');
		$nohp = $this->input->post('nohp');
		$koordinator = $this->input->post('koordinator');
		$kuota = $this->input->post('kuota');
		$data = array(
			'nama' => $nama,
			'nis' => $nis,
			'password' => $password,
			'koordinator' => $koordinator,
			'nohp' => $nohp,
			'jumlah_survey' => $kuota
		);
		$this->m_admin->insert_surveyor('surveyor', $data);
		redirect('surveyor');
	}
	public function edit_surveyor($id)
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$nama = $this->input->post('nama');
		$nis = $this->input->post('nis');
		$kelas = $this->input->post('kelas');
		$nohp = $this->input->post('nohp');
		$password = $this->input->post('password');
		$pertanyaan = $this->input->post('pertanyaan');
		$jawaban = $this->input->post('jawaban');
		$koordinator = $this->input->post('koordinator');
		$kuota = $this->input->post('kuota');
		$data = array(
			'nama' => $nama,
			'nis' => $nis,
			'password' => $password,
			'nohp' => $nohp,
			'pertanyaan' => $pertanyaan,
			'koordinator' => $koordinator,
			'jawaban' => $jawaban,
			'jumlah_survey' => $kuota
		);
		$where = array('id_surveyor' => $id);
		$this->m_admin->update_surveyor('surveyor', $data, $where);
		redirect('surveyor');
	}
	public function hapus_surveyor($id)
	{
		if ($this->session->status != 'admin') {
			redirect('');
		}
		$where = array('id_surveyor' => $id);
		$this->m_admin->delete_surveyor($where, 'surveyor');
		redirect('surveyor');
	}



	//Setting
	public function setting()
	{
		if ($this->session->status == 'admin') {
			$data['admin'] = $this->db->query('SELECT id_admin, nama, username FROM admin')->result();
		} else {
			$data['admin'] = [];
		}
		$data['title'] = 'Pengaturan';

		$this->header($data);
		$this->load->view('setting');
		$this->load->view('template/footer');
	}
	function ganti_passwd_admin()
	{
		$password = $this->input->post('password');
		$passwordbaru = $this->input->post('passwordbaru');

		$id = ['id_admin' => $this->session->id];
		$cek = $this->m_admin->cek_passwd_admin($id)->row();
		if (password_verify($password, $cek->password)) {
			# code...
			$pb = password_hash($passwordbaru, PASSWORD_DEFAULT);
			$data = ['password' => $pb];
			$this->m_admin->update_passwd('admin', $data, $id);
			$this->session->set_flashdata('passwd', 'Password berhasil diubah');
			redirect('setting');
		} else {
			$this->session->set_flashdata('error', 'Password lama salah !');
			redirect('setting');
		}
	}
	function ganti_passwd_guru()
	{
		$password = $this->input->post('password');
		$passwordbaru = $this->input->post('passwordbaru');
		$where = ['id_guru' => $this->session->id];
		$cek = $this->m_admin->cek_passwd_guru($where)->row();
		if ($password == $cek->password) {
			$data = ['password' => $passwordbaru];
			$this->m_admin->update_passwd('guru', $data, $where);
			$this->session->set_flashdata('passwd', 'Password berhasil diubah');
			redirect('setting');
		} else {
			$this->session->set_flashdata('error', 'Password lama salah !');
			redirect('setting');
		}
	}
	function ganti_user()
	{
		$id = $this->session->id;
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$data = ['nama' => $nama, 'username' => $username];
		if ($this->session->status == 'admin') {
			$where = ['id_admin' => $id];
			$this->m_admin->update_passwd('admin', $data, $where);

			$this->session->unset_userdata(['nama', 'username']);
			$this->session->set_userdata($data);

			$this->session->set_flashdata('passwd', 'Nama/Username berhasil diubah');
			redirect('setting');
		}
		if ($this->session->status == 'guru') {
			$where = ['id_guru' => $id];
			$this->m_admin->update_passwd('guru', $data, $where);

			$this->session->unset_userdata(['nama', 'username']);
			$this->session->set_userdata($data);

			$this->session->set_flashdata('passwd', 'Nama/Username berhasil diubah');
			redirect('setting');
		}
	}
	function tambah_admin()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$data = ['nama' => $nama, 'username' => $username, 'password' => $password];
		$this->db->insert('admin', $data);
		$this->session->set_flashdata('tambahadmin', $nama . ' berhasil ditambahkan sebagai admin');
		redirect('setting');
	}
	function hapus_admin($id)
	{
		$this->db->query('DELETE FROM admin WHERE id_admin=' . $id);
		redirect('setting');
	}

	//Survey
	public function hasilsurvey($page = FALSE, $id = FALSE, $id_surveyor = false)
	{

		$data['title'] = 'survey';

		$data['id'] = $id;
		$data['page'] = $page;
		$data['listsurvey'] = $this->m_admin->list_survey()->result();
		if ($page == TRUE && $id == TRUE && $id_surveyor == TRUE) {
			$data['hasilsurvey'] = $this->db->query("SELECT * FROM jawaban_survey WHERE js_survey_id='" . $id . "' AND js_valid='1' AND js_surveyor=$id_surveyor")->result();
		} elseif ($page == TRUE && $id == TRUE) {
			$data['hasilsurvey'] = $this->m_admin->data_survey_byid($id)->result();
		} else {
		}


		$this->header($data);
		if ($page == TRUE && $id == TRUE && $id_surveyor == TRUE) {
			$this->load->view('datahasilsurvey');
		} elseif ($page == TRUE && $id == TRUE) {
			$this->load->view('datahasilsurvey');
		} else {
			$this->load->view('hasilsurvey');
		}
		$this->load->view('template/footer-datepicker');
	}

	public function hasil($id = FALSE)
	{
		$data['title'] = 'Data Survey';
		// print_r($data['hasilsurvey']);exit;
		if ($id == TRUE) {
			$data['id'] = $id;
			$data['listsurvey'] = $this->m_admin->list_survey($id)->result();
			$data['listseksi'] = $this->db->query("SELECT * FROM seksi_survey WHERE ss_id_survey='$id' AND ss_status='0' ORDER BY id_seksi ASC")->result();

			if ($this->session->status == 'koordinator') {
				//$data['hasilsurvey'] = $this->m_admin->data_survey_byid($id)->result();
				//$this->load->view('hasil',$data);
				$idkor = $this->session->id;

				$dsurveyor = $this->m_admin->listsurveyor_by_koordinator($idkor)->result();
				$data['surveyor'] = $dsurveyor;
				$inCes = array();
				foreach ($dsurveyor as $dsurv) {
					$inCes[] = $dsurv->id_surveyor;
				}
				//print_r($inCes);
				$search = $inCes;
				$this->db->select('*');
				$this->db->from('jawaban_survey');
				$this->db->where('js_valid', 1);
				$this->db->where_in('js_surveyor', $search);
				$queryo = $this->db->get();

				// $data['hasilsurvey'] = $queryo->result();
				$data['hasilsurvey'] = $this->db->query("SELECT * FROM jawaban_survey WHERE js_survey_id='" . $id . "' AND js_valid='1'")->result();
				$this->load->view('hasil', $data);
			}
			
			if ($this->session->status == 'admin') {
				$data['hasilsurvey'] = $this->m_admin->data_survey_byid($id)->result();
				$original_questions = $this->m_admin->pertanyaan_survey($id)->result();

				$structured_questions = [];
				$seksi_col_count = [];

				foreach ($original_questions as $q) {
					if (!isset($seksi_col_count[$q->ps_id_seksi])) {
						$seksi_col_count[$q->ps_id_seksi] = 0;
					}

					$question_data = [
						'ps_id' => $q->ps_id,
						'ps_kode' => $q->ps_kode,
						'ps_id_seksi' => $q->ps_id_seksi,
						'is_checkbox' => $q->ps_tipe_pertanyaan == '2',
						'options' => [],
						'essay_option' => null, // 👈 Tambahkan properti ini
						'colspan' => 1
					];

					// Cek pilihan jawaban dan identifikasi opsi esai
					if (!empty($q->ps_pilihan_jawaban)) {
						$options_list = [];
						$pilihan = explode(';', rtrim($q->ps_pilihan_jawaban, ';'));

						foreach ($pilihan as $pil) {
							if (!empty($pil)) {
								$parts = explode(':', $pil); // [0] = Teks, [1] = Logic, [2] = Tipe (default/essai)
								$option_text = $parts[0];
								$options_list[] = $option_text;

								// Cek jika ini adalah opsi yang memicu esai
								if (isset($parts[2]) && $parts[2] == 'essai') {
									$question_data['essay_option'] = $option_text; // 👈 Simpan nama opsi esai
								}
							}
						}

						if ($question_data['is_checkbox']) {
							$question_data['options'] = $options_list;
							$question_data['colspan'] = count($options_list) > 0 ? count($options_list) : 1;
						}
					}

					$structured_questions[] = (object) $question_data;
					$seksi_col_count[$q->ps_id_seksi] += $question_data['colspan'];
				}

				$data['structured_questions'] = $structured_questions;
				$data['seksi_col_count'] = $seksi_col_count;

				$listseksi = $data['listseksi'];
				foreach ($listseksi as $seksi) {
					$seksi->jumlah = isset($seksi_col_count[$seksi->id_seksi]) ? $seksi_col_count[$seksi->id_seksi] : 0;
				}
				$data['listseksi'] = $listseksi;

				$this->load->view('hasil', $data);
			}
		}
	}

	public function survey($page = FALSE, $id = FALSE)
	{

		$data['title'] = 'survey';
		$data['listsurvey'] = $this->m_admin->list_survey()->result();

		if ($page == 'edit' && $id == TRUE) {
			$data['dtsurvey'] = $this->m_admin->list_survey($id)->result();
		}


		$data['id'] = $id;
		$data['page'] = $page;

		$this->header($data);
		$this->load->view('survey');
		$this->load->view('template/footer');

		/*
	$data['title'] = 'survey'; 
	$data['listsurvey'] = $this->m_admin->list_survey()->result();

	$this->header($data);
	$this->load->view('survey');
	$this->load->view('template/footer');*/
	}

	public function survey_detail($id)
	{
		$data['title'] = 'survey';
		$data['infosurvey'] = $this->m_admin->list_survey($id)->result();
		$data['listsurvey'] = $this->m_admin->list_seksi_by_idsurvey($id)->result();
		foreach ($data['listsurvey'] as $index => $seksi) {
			$data['listsurvey'][$index]->pertanyaan = $this->m_admin->list_pertanyaan_by_seksi($seksi->id_seksi)->result();
		}

		$this->header($data);
		$this->load->view('survey_detail');
		$this->load->view('template/footer');
	}

	// public function preview($id,$id_seksi)
	// {
	// 	$data['infosurvey'] = $this->m_admin->list_survey($id)->result();
	// 	$data['lu'] = $this->m_admin->list_seksi($id_seksi)->row();
	// 	// foreach ($data['lu'] as $index => $seksi) {
	// 		$data['lu']->pertanyaan = $this->m_admin->list_pertanyaan_by_seksi($id_seksi)->result();
	// 	// }

	// 	$this->load->view('preview-survey', $data);
	// }

	function tambah_survey()
	{
		$idSurv = $this->input->post('idSurvey');
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$tanggal = $this->input->post('tanggal');
		$tanggal_selesai = $this->input->post('tanggal_selesai');

		if ($idSurv != '') {
			$where = ['id_survey' => $idSurv];
			$data = [
				'nama_survey' => $survey,
				'kode_survey' => $kode,
				'tanggal' => JStoDB($tanggal),
				'tanggal_selesai' => JStoDB($tanggal_selesai),
			];

			$this->m_admin->e_survey($where, 'survey', $data);
			$this->session->set_flashdata('t_survey', '');
		} else {
			$data = [
				'nama_survey' => $survey,
				'kode_survey' => $kode,
				'tanggal' => JStoDB($tanggal),
				'tanggal_selesai' => JStoDB($tanggal_selesai),
				'tgl_create' => date("Y-m-d H:i:s"),
			];


			$this->m_admin->t_survey("survey", $data);
			$this->session->set_flashdata('t_survey', '');
		}

		redirect('survey');
	}
	function edit_survey($id_survey)
	{
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$tanggal = $this->input->post('tanggal');
		$tanggal_selesai = $this->input->post('tanggal_selesai');
		$where = ['id_survey' => $id_survey];
		$data = [
			'nama_survey' => $survey,
			'kode_survey' => $kode,
			'tanggal' => $tanggal,
			'tanggal_selesai' => $tanggal_selesai
		];

		$this->m_admin->e_survey($where, 'survey', $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('survey');
	}

	function tambah_survey_seksi()
	{
		$idUser = $this->session->id;
		$id_survey = $this->input->post('idSurvey');
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$ket = $this->input->post('ketSurvey');
		$data = [
			'ss_id_survey' => $id_survey,
			'ss_kode' => $kode,
			'ss_judul' => $survey,
			'ss_keterangan' => $ket,
			'ss_creator' => $idUser,
			'ss_tanggal' => date("Y-m-d H:i:s"),

		];

		$this->m_admin->t_survey("seksi_survey", $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/survey_detail/' . $id_survey);
	}

	
	function duplikat_survey_seksi($id_seksi)
	{
		// Mendapatkan nilai-nilai dari input
		$idUser = $this->session->id;
		$id_survey = $this->input->post('idSurvey');
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$ket = $this->input->post('ketSurvey');
		
		// Membuat array data untuk menyimpan informasi seksi baru
		$seksi_data = [
			'ss_id_survey' => $id_survey,
			'ss_kode' => $kode,
			'ss_judul' => $survey,
			'ss_keterangan' => $ket,
			'ss_creator' => $idUser,
			'ss_tanggal' => date("Y-m-d H:i:s"),
		];
	
		// Menyimpan data seksi baru ke dalam tabel 'seksi_survey'
		$this->m_admin->t_survey("seksi_survey", $seksi_data);
		$new_seksi_id = $this->db->insert_id(); // Mendapatkan ID seksi baru yang telah disimpan
	
		// Mendapatkan pertanyaan-pertanyaan dari seksi survey yang akan diduplikat
		$pertanyaan_data = $this->m_admin->list_pertanyaan($id_seksi)->result();
	
		// Menduplikat pertanyaan-pertanyaan ke dalam seksi baru
		foreach ($pertanyaan_data as $pertanyaan) {
			$pertanyaan_data_baru = [
				'ps_id_survey' => $id_survey, // Menyamakan nilai 'ps_id_survey' dengan nilai yang digunakan pada seksi baru
				'ps_id_seksi' => $new_seksi_id,
				'ps_kode' => $pertanyaan->ps_kode,
				'ps_pertanyaan' => $pertanyaan->ps_pertanyaan,
				'ps_tipe_pertanyaan' => $pertanyaan->ps_tipe_pertanyaan,
				'ps_pilihan_jawaban' => $pertanyaan->ps_pilihan_jawaban,
			];
	
			// Menyimpan pertanyaan baru ke dalam tabel 'pertanyaan_survey'
			$this->m_admin->t_survey("pertanyaan_survey", $pertanyaan_data_baru);
		}
	
		// Mengatur flash data dan mengalihkan pengguna ke halaman seksi detail
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/survey_detail/' . $id_survey);
	}


	function edit_survey_seksi($id_seksi)
	{

		$id_survey = $this->input->post('idSurvey');
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$ket = $this->input->post('ketSurvey');
		$where = ['id_seksi' => $id_seksi];
		$data = [
			'ss_kode' => $kode,
			'ss_judul' => $survey,
			'ss_keterangan' => $ket,
		];

		$this->m_admin->e_survey($where, 'seksi_survey', $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/survey_detail/' . $id_survey);
	}
	function tambah_pertanyaan()
	{

		$idUser = $this->session->id;
		$id_seksi = $this->input->post('idSeksi');
		$id_survey = $this->input->post('idSurvey');
		$kode_seksi = $this->input->post('kodeSeksi');
		$kode = $this->input->post('KodePertanyaan');
		$pertanyaan = $this->input->post('Pertanyaan');
		$tipe = $this->input->post('tipePertanyaan');
		$kewajibanMengisi = $this->input->post('kewajibanMengisi');

		$pilja = $this->input->post('pilja');
		$logicja = $this->input->post('logicja');
		$typeja = $this->input->post('typeja');
		

		$dataJawaban = '';

		foreach ($pilja as $key => $v) {

			if (count($pilja) > 1) {
				if ($v != '') {
					$dataJawaban .= $v . ':' . $logicja[$key] . ':' . $typeja[$key] . ';';
				}
			} else {
				$dataJawaban = '';
			}
		}


		$data = [
			'ps_id_survey' => $id_survey,
			'ps_id_seksi' => $id_seksi,
			'ps_kode' => $kode_seksi.$kode,
			'ps_pertanyaan' => $pertanyaan,
			'ps_tipe_pertanyaan' => $tipe,
			'ps_pilihan_jawaban' => $dataJawaban,
			'must_answer' => $kewajibanMengisi ?? null,
			'ps_creator' => $idUser,
			'ps_create' => date("Y-m-d H:i:s"),
			'ps_status' => 0,

		];

		$this->m_admin->t_survey("pertanyaan_survey", $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/seksi_detail/' . $id_seksi .'/'.$id_survey);
	}

	function edit_pertanyaan($id)
	{
		$where = ['ps_id' => $id];
		$id_seksi = $this->input->post('idSeksi');
		$id_survey = $this->input->post('idSurvey');
		$kode_seksi = $this->input->post('kodeSeksi');
		$kode = $this->input->post('KodePertanyaan'.$id);
		$pertanyaan = $this->input->post('Pertanyaan'.$id);
		$tipe = $this->input->post('tipePertanyaan'.$id);
		$kewajibanMengisi = $this->input->post('kewajibanMengisi'.$id);

		$pilja = $this->input->post('pilja');
		$logicja = $this->input->post('logicja');
		$typeja = $this->input->post('typeja');

		$dataJawaban = '';
		$pilja = $this->input->post('pilja');
		$pilja = array_filter($pilja);
		$pilja = array_unique($pilja);
		$pilja = array_values($pilja); 
		// print_r($this->input->post());exit;
		foreach ($pilja as $key => $v) {
			if (count($pilja) > 1) {
				if ($v != '') {
					$dataJawaban .= $v . ':' . $logicja[$key] . ':' . $typeja[$key] . ';';
				}
			} else {
				$dataJawaban = '';
			}
		}
		// print_r($dataJawaban);exit;
		$data = [
			'ps_id_survey' => $id_survey,
			'ps_id_seksi' => $id_seksi,
			'ps_kode' => $kode_seksi.$kode,
			'ps_pertanyaan' => $pertanyaan,
			'ps_tipe_pertanyaan' => $tipe,
			'ps_pilihan_jawaban' => $dataJawaban,
			'must_answer' => $kewajibanMengisi ?? null,
		];

		$this->m_admin->e_survey($where, 'pertanyaan_survey', $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/seksi_detail/' . $id_seksi .'/'.$id_survey);
	}

	function hapus_survey($id)
	{
		$where = ['id_survey' => $id];
		$data = [
			'is_del' => 1,
		];

		$this->m_admin->e_survey($where, 'survey', $data);
		//$this->db->query("DELETE FROM survey WHERE id_survey=".$id);
		redirect($this->agent->referrer());
		//$this->db->query("DELETE FROM survey WHERE id_survey=".$id);
		//redirect($this->agent->referrer());
	}
	/*
function hapus_survey($id){
	
	$this->db->query("DELETE FROM survey WHERE id_survey=".$id);
	redirect($this->agent->referrer());
}*/
	function hapus_survey_seksi($id)
	{
		$where = ['id_seksi' => $id];
		$data = [
			'ss_status' => 1,
		];

		$this->m_admin->e_survey($where, 'seksi_survey', $data);
		//$this->db->query("DELETE FROM survey WHERE id_survey=".$id);
		redirect($this->agent->referrer());
	}

	// function hapus_pertanyaan($idseksi, $idpertanyaan)
	// {
	// 	$where = ['ps_id' => $idpertanyaan];
	// 	$data = [
	// 		'ps_status' => 3,
	// 	];

	// 	$this->m_admin->e_survey($where, 'seksi_survey', $data);
	// 	$this->session->set_flashdata('d_survey', '');
	// 	redirect('admin/survey_detail/' . $id_survey);
	// }

	function hapus_pertanyaan($idseksi, $idpertanyaan)
{
    $where = ['ps_id' => $idpertanyaan];
    $data = [
        'ps_status' => 3,
    ];

    $this->m_admin->e_survey($where, 'pertanyaan_survey', $data);
    // $this->session->set_flashdata('e_survey', '');
    redirect('admin/seksi_detail/' . $idseksi);
}

	function duplikat_pertanyaan($idseksi, $idpertanyaan)
	{
		$id_seksi = $this->input->post('idSeksi');
		$id_survey = $this->input->post('idSurvey');
		$survey = $this->input->post('nmSurvey');
		$kode = $this->input->post('KodeSurvey');
		$ket = $this->input->post('ketSurvey');
		$where = ['id_seksi' => $id_seksi];
		$data = [
			'ss_kode' => $kode,
			'ss_judul' => $survey,
			'ss_keterangan' => $ket,
		];

		$this->m_admin->t_survey('seksi_survey', $data);
		$this->session->set_flashdata('t_survey', '');
		redirect('admin/seksi_detail/' . $id_seksi);
	
	}

	function generate_token($id)
	{

		$where = ['id_survey' => $id];
		$kode = random_string('alnum',6);

		$this->db->query("UPDATE survey SET token_survey = '$kode' WHERE id_survey = $id");
		redirect('survey');

	}


	public function seksi_detail($id,$id_survey = null)
	{
		$data['title'] = 'seksi';
		$data['infosurvey'] = $this->m_admin->list_seksi($id)->result();
		$data['listpertanyaan'] = $this->m_admin->list_pertanyaan($id)->result();
		
		$idSurvey = $data['infosurvey'] ? $data['infosurvey'][0]->ss_id_survey : false;
		if($idSurvey) $data['is_jawaban'] = $this->m_admin->count_data_survey_byid($idSurvey) > 0 ? true : false;
		else $data['is_jawaban'] = false;
		
		// print_r($data);exit;
		$this->header($data);
		$this->load->view('seksi_detail');
		$this->load->view('template/footer');
	}



	//Reset aplikasi
	function teserss()
	{
		$this->db->query('SET FOREIGN_KEY_CHECKS = 0');
		$this->db->truncate('guru');
		$this->db->truncate('ikut_ujian');
		$this->db->truncate('jurusan');
		$this->db->truncate('kelas');
		$this->db->truncate('mapel');
		$this->db->truncate('surveyor');
		$this->db->truncate('soal');
		$this->db->truncate('ujian');
		$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
		//delete_files('./../media/');
		redirect('');
	}

	//Error 404
	public function error()
	{
		$data['title'] = '404 Not Found';

		$this->header($data);
		$this->load->view('template/404');
		$this->load->view('template/footer');
	}

	function j($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function surveyor_to_koor($id)
	{
		if (!in_array($this->session->status, ['admin', 'koordinator'])) {
			redirect('');
		}
		
		if ($this->session->status == 'koordinator' && $this->session->id != $id) {
			redirect($_SERVER['HTTP_REFERER']);
		}

		$data['title'] = 'Data Surveyor';
		$data['data'] = $this->db->query("SELECT surveyor.*,survey.nama_survey,survey.kode_survey, koordinator.*, koordinator.nama AS namkod,surveyor.nama AS namyor,surveyor.password AS passyor FROM 
		surveyor JOIN koordinator ON surveyor.koordinator=koordinator.id_koordinator AND
		koordinator JOIN survey ON koordinator.survey_aktif=survey.id_survey WHERE koordinator=$id
		ORDER BY nis")->result();
		$id_survey = $this->db->query("SELECT * FROM koordinator where id_koordinator=" . $id)->result()[0]->survey_aktif;
		$data_survey = $this->db->query("SELECT * FROM survey where id_survey=" . $id_survey)->result();
		$data['nama_survey'] = $data_survey[0]->nama_survey;
		$data['kode_survey'] = $data_survey[0]->kode_survey;
		$data['id_survey'] = $id_survey;
		$data['id_koor'] = $id;
		$data['nama_koordinator'] = $this->db->query("SELECT * FROM koordinator where id_koordinator=" . $id)->result()[0]->nama;
		$data['belum'] = $this->db->query("SELECT * FROM surveyor WHERE koordinator != $id")->result();

		$this->session->set_userdata('id_survey', $id_survey);
		$this->session->set_userdata('id_koor', $id);

		$this->header($data);
		$this->load->view('surveyor_manajemen');
		$this->load->view('template/footer');
	}

	public function m_add_surv()
	{
		$id_koor = $this->input->post('id_koor');
		$id_surveyor = $this->input->post('id_surveyor');
		$jumlah = $this->input->post('jumlah');
		$this->db->query("UPDATE surveyor SET jumlah_survey = $jumlah, koordinator=$id_koor WHERE id_surveyor = $id_surveyor");
		redirect('/admin/surveyor_to_koor/' . $id_koor);
	}
	public function m_edit_surv($id)
	{
		$id_koor = $this->input->post('id_koor');
		$jumlah = $this->input->post('jumlah');
		$this->db->query("UPDATE surveyor SET jumlah_survey = $jumlah WHERE id_surveyor = $id");
		redirect('/admin/surveyor_to_koor/' . $id_koor);
	}
	public function m_edit_surv_koor($id)
	{
		$jumlah = $this->input->post('jumlah');
		$this->db->query("UPDATE surveyor SET jumlah_survey = $jumlah WHERE id_surveyor = $id");
		redirect('/admin');
	}
	public function m_delete_surv($id)
	{
		$this->db->query("UPDATE surveyor SET jumlah_survey = 0,koordinator='' WHERE id_surveyor = $id");
		redirect('/admin/surveyor_to_koor/' . $this->session->id_koor);
	}
	
	public function delete()
	{
		header('Content-Type: application/json');

		$id = $this->input->post('id');
		if ($this->m_admin->delete_single_survey_data($id)) {
			echo json_encode([
				'status' => 'success', 
				'message' => 'Data Berhasil Dihapus.'
			]);
		} else {
			echo json_encode([
				'status' => 'error', 
				'message' => 'Gagal menghapus data.'
			]);
		}
		exit;
	}

	public function delete_selected()
	{
		header('Content-Type: application/json');

		$ids = $this->input->post('ids');

		if (empty($ids)) {
			echo json_encode([
				'status' => 'error', 
				'message' => 'Tidak ada data yang dipilih.'
			]);
		}

		if ($this->m_admin->delete_multiple_survey_data($ids)) {
			echo json_encode([
				'status' => 'success', 
				'message' => 'Data Berhasil Dihapus.'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Gagal menghapus data.'
			]);
		}
	}
}

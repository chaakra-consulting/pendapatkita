<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Jakarta");

class User extends CI_Controller
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
		$this->load->model('M_User', 'm_user');
		// if (!$this->session->userdata('login')) {
		// 	redirect('login');
		// }
	}

	//Header
	private function header($data)
	{
		$this->load->view('_template/header', $data);
	}

	//404
	function notfound()
	{
		redirect('');
	}

	//Index
	public function index()
	{
		$id = ['id_surveyor' => $this->session->id];
		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'Pendapat Kita';
		$data['judul'] = 'Dashboard';
		//$whrkelas = ['kelas.kode_kelas' => $this->session->userdata('kelas')];
		//$data['jdwlujian'] = $this->m_user->jadwal_ujian($this->session->id)->result();
		$data['survey'] = $this->m_user->list_survey_koordinator()->result();

		$this->header($data);
		$this->load->view('_template/sidebar');
		$this->load->view('utama');
		$this->load->view('_template/footer');
	}

	public function datasurvey($ido, $user)
	{
		$id = ['id_surveyor' => $this->session->id];

		$whr_cek_detil_tes = ['id_survey' => $ido];
		$cek_detil_tes = $this->m_user->cek_detil_survey($whr_cek_detil_tes)->row();
		$data['detil_survey'] = $cek_detil_tes;

		$data['titleoe'] = $cek_detil_tes->nama_survey;

		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'Pendapat Kita';
		$data['judul'] = 'Data Survey';
		$data['survey'] = $this->m_user->list_hasil_survey($ido, $user)->result();

		$this->header($data);
		//          $this->load->view('utama');
		$this->load->view('data');
		$this->load->view('_template/footer');
	}

	public function datasurveypending($ido, $user)
	{
		$id = ['id_surveyor' => $this->session->id];

		$whr_cek_detil_tes = ['id_survey' => $ido];
		$cek_detil_tes = $this->m_user->cek_detil_survey($whr_cek_detil_tes)->row();
		$data['detil_survey'] = $cek_detil_tes;

		$data['titleoe'] = $cek_detil_tes->nama_survey;

		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'Pendapat Kita';
		$data['judul'] = 'Data Survey';
		$data['survey'] = $this->m_user->list_hasil_survey_pending($ido, $user)->result();

		$this->header($data);
		//          $this->load->view('utama');
		$this->load->view('data_pending');
		$this->load->view('_template/footer');
	}

	//Ujian
	public function ujian($id_ujian)
	{
		$c = $this->m_user->cek_detil_tes(['id_ujian' => $id_ujian]);
		if ($c->num_rows() < 1) {
			# code...
			redirect('');
		}
		//def session siswa
		$data['sess_id'] = $this->session->userdata('id');
		$data['sess_nama'] = $this->session->userdata('nama');

		$whr_cek_sdh_selesai = ['id_surveyor' => $data['sess_id'], 'id_ujian' => $id_ujian, 'status' => 'N'];
		$cek_sdh_selesai = $this->m_user->cek_selesai_ujian($whr_cek_sdh_selesai)->num_rows();

		if ($cek_sdh_selesai < 1) {
			# jika belum selesai ujian | ambil detil soal
			$whr_cek_detil_tes = ['id_ujian' => $id_ujian];
			$cek_detil_tes = $this->m_user->cek_detil_tes($whr_cek_detil_tes)->row();

			$whr_cek_sdh_ujian = ['id_ujian' => $id_ujian, 'id_surveyor' => $data['sess_id']];
			$cek_sdh_ujian = $this->m_user->cek_sdh_ujian($whr_cek_sdh_ujian);

			if ($cek_sdh_ujian->num_rows() < 1) {
				# code...
				$soal_urut_ok = array();
				//$whr_q_soal = ['mapel' => $cek_detil_tes->id_mapel];
				$kelas = $this->db->query('SELECT kelas FROM siswa WHERE id_surveyor=' . $this->session->id)->row();
				$q_soal = $this->m_user->q_soal($cek_detil_tes->id_mapel, $kelas->kelas)->result();
				$i = 0;
				foreach ($q_soal as $q) {
					# code...
					$soal_per = new stdClass();
					$soal_per->id = $q->id_soal;
					$soal_per->soal = $q->soal;
					$soal_per->media = $q->media;
					$soal_per->opsi_a = $q->opsi_a;
					$soal_per->opsi_b = $q->opsi_b;
					$soal_per->opsi_c = $q->opsi_c;
					$soal_per->opsi_d = $q->opsi_d;
					$soal_per->opsi_e = $q->opsi_e;
					$soal_per->jawaban = $q->jawaban;

					$soal_urut_ok[$i] = $soal_per;
					$i++;
				}
				$soal_urut_ok = $soal_urut_ok;

				$list_id_soal = '';
				$list_jw_soal = '';
				if (!empty($q_soal)) {
					# code...
					foreach ($q_soal as $w) {
						$list_id_soal .= $w->id_soal . ',';
						$list_jw_soal .= $w->id_soal . ':,';
					}
				}
				$list_id_soal = substr($list_id_soal, 0, -1);
				$list_jw_soal = substr($list_jw_soal, 0, -1);
				$waktu_mulai = date('Y-m-d H:i:s');
				$waktu_selesai = date('Y-m-d H:i:s', strtotime('+' . $cek_detil_tes->waktu . ' minutes'));

				$data_tmbh_ujian = [
					'id_ujian' => $id_ujian,
					'id_surveyor' => $data['sess_id'],
					'list_soal' => $list_id_soal,
					'list_jawaban' => $list_jw_soal,
					'jml_benar' => 0,
					'nilai' => 0,
					'tgl_mulai' => $waktu_mulai,
					'tgl_selesai' => $waktu_selesai,
					'status' => 'Y'
				];
				$this->m_user->tambah_ujian($data_tmbh_ujian);

				redirect($id_ujian);
			} else {
				$q_ambil_soal = $this->db->query('SELECT * FROM ikut_ujian WHERE id_ujian = ' . $id_ujian . ' AND id_surveyor = ' . $data['sess_id'] . '')->row();
				$urut_soal = explode(",", $q_ambil_soal->list_jawaban);

				$soal_urut_ok = array();

				for ($i = 0; $i < sizeof($urut_soal); $i++) {
					# code...
					$pc_urut_soal = explode(":", $urut_soal[$i]);
					$pc_urut_soal1 = empty($pc_urut_soal[1]) ? "''" : "'" . $pc_urut_soal[1] . "'";

					$ambil_soal = $this->db->query('SELECT *, ' . $pc_urut_soal1 . ' AS jawaban FROM soal WHERE id_soal = ' . $pc_urut_soal[0] . '')->row();
					$soal_urut_ok[] = $ambil_soal;
				}

				$whr_detil_soal = ['id_ujian' => $id_ujian];
				$data['detil_soal'] = $this->m_user->detil_soal($whr_detil_soal)->row();
				$data['detil_tes'] = $q_ambil_soal;
				$data['data'] = $soal_urut_ok;

				//view
				$data['title'] = $data['detil_soal']->mapel . ' | ' . $data['detil_soal']->nama_ujian;
				$data['judul'] = $data['detil_soal']->mapel;
				$this->load->view('_template_ujian/header', $data);
				$this->load->view('_template_ujian/ujian');
				$this->load->view('_template_ujian/footer');
			}
		} else {
			//redirect ujian selesai
			$xx = $this->m_user->cek_selesai_ujian(['id_surveyor' => $data['sess_id'], 'id_ujian' => $id_ujian, 'status' => 'N'])->row();
			redirect('selesai/' . $xx->id_tes);
		}
	}


	public function survey_form($id_survey, $kode_survey = FALSE, $kdseksi = FALSE, $kdtanya = FALSE)
	{
		$c = $this->m_user->cek_detil_survey(['id_survey' => $id_survey]);
		if ($c->num_rows() < 1) {
			# code...
			redirect('');
		}

		//def session siswa
		$data['sess_id'] = $this->session->userdata('id');
		$data['sess_nama'] = $this->session->userdata('nama');

		$data['kode_survey'] = $kode_survey;
		$data['id_survey'] = $id_survey;
		$data['kdseksi'] = $kdseksi;
		$data['kdtanya'] = $kdtanya;

		$whr_cek_detil_tes = ['id_survey' => $id_survey];
		$cek_detil_tes = $this->m_user->cek_detil_survey($whr_cek_detil_tes)->row();
		$data['detil_survey'] = $cek_detil_tes;
		$list_seksi_result = $this->m_user->list_seksi_by_survey($id_survey)->result();
			if (!empty($list_seksi_result)) {
				$data['list_seksi'] = $list_seksi_result;
			} else {
				$data['list_seksi'] = array();
		}
		$data['title'] = $cek_detil_tes->nama_survey;

		$data_jawaban_survey = $this->m_user->data_jawaban_survey($kode_survey)->row();
		if(isset($data_jawaban_survey) && $data_jawaban_survey->js_valid){
			redirect('/');
		}else{
			$this->load->view('_template_survey/header', $data);
			$this->load->view('_template_survey/sidebar',$data);
			$this->load->view('_template_survey/survey_form');
			$this->load->view('_template_survey/footer');
		}
	}
	
	function survey_formsave($seksiafter, $idsurvey)
	{
		$id_surveyor = $this->session->id;

		$id_survey = $this->input->post('id_survey');
		$kdseksi = $this->input->post('kdseksi');
		$kode_survey = $this->input->post('kode_survey');
		$target_link = $this->input->post('target_link');
		if ($target_link != NULL) {
			$query_result = $this->db->query("SELECT b.`ss_kode` FROM pertanyaan_survey a LEFT JOIN seksi_survey b ON a.`ps_id_seksi`=b.`id_seksi` WHERE a.`ps_id_survey`=$id_survey AND a.`ps_kode`='$target_link'")->result();
			if (!empty($query_result)) {
				$kode_seksi_tujuan = $query_result[0]->ss_kode;
			} else {
				$kode_seksi_tujuan = '';
			}
		} else {
			$kode_seksi_tujuan = '';
		}
		//Link Clear
		$tamb_redirect = '';
		$redir_activ = 0;
		if ($target_link != '' && $kode_seksi_tujuan != '') {
			// $wordsPGKar = trim($target_link, "0..9");
			$tamb_redirect = $kode_seksi_tujuan . '#' . $target_link;
			// echo $tamb_redirect;
			$redir_activ = 1;
		}

		if ($kdseksi == 'data') {
			$pewawancara = $this->input->post('pewawancara');
			$pemeriksa = $this->input->post('pemeriksa');
			$koderesponden = $this->input->post('koderesponden');
			$namaresponden = $this->input->post('namaresponden');

			$jum = $this->m_user->cekdata_survey($kode_survey)->row_array();
			$jumsurv = $jum['jumsurvey'];

			if ($jumsurv > 0) {
				$whereee = ['js_kodesurvey' => $kode_survey];

				$data_ = [
					'js_pewawancara' => $pewawancara,
					'js_pemeriksa' => $pemeriksa,
					'js_kode_responden' => $koderesponden,
					'js_nama_responden' => $namaresponden,
					'js_surveyor' => $id_surveyor,
				];


				$proda = $this->m_user->updateSurvey($whereee, $data_);
				if ($proda == TRUE) {
					//survey/4/100422101603/CTP
					if ($redir_activ == 1) {
						echo ("<script LANGUAGE='JavaScript'> window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $tamb_redirect . "'; </script>");
					} else {
						echo ("<script LANGUAGE='JavaScript'> window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $seksiafter . "'; </script>");
					}
				} else {
					echo ("<script LANGUAGE='JavaScript'> window.alert('Update Data Gagal'); window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $kdseksi . "'; </script>");
				}
			} else {
				$data_tmbh_ujian = [
					'js_survey_id' => $id_survey,
					'js_pewawancara' => $pewawancara,
					'js_pemeriksa' => $pemeriksa,
					'js_kode_responden' => $koderesponden,
					'js_nama_responden' => $namaresponden,
					'js_waktu' => date("Y-m-d H:i:s"),
					'js_surveyor' => $id_surveyor,
					'js_kodesurvey' => $kode_survey,
					'js_valid' => 0,
					'js_status' => '0'
				];


				$proda = $this->m_user->tambah_jawaban($data_tmbh_ujian);
				if ($proda == TRUE) {
					//survey/4/100422101603/CTP
					if ($redir_activ == 1) {
						echo ("<script LANGUAGE='JavaScript'> window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $tamb_redirect . "'; </script>");
					} else {
						echo ("<script LANGUAGE='JavaScript'> window.alert('Input Data Berhasil'); window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $seksiafter . "'; </script>");
					}
				} else {
					echo ("<script LANGUAGE='JavaScript'> window.alert('Input Data Gagal'); window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $kdseksi . "'; </script>");
				}
			}
		} elseif ($kdseksi == 'validasi') {
			$foto_array = array();
			if ($_FILES['fotorespoden1']['name'] != "" || $_FILES['fotorespoden2']['name'] != "" || $_FILES['fotorespoden3']['name'] != "" || $_FILES['fotorespoden4']['name'] != "" || $_FILES['fotorespoden5']['name'] != "") {
				for ($i = 1; $i <= 5; $i++) {
					if ($_FILES['fotorespoden' . $i]['name'] != "") {
						$upload = $this->m_user->uploadImg('fotorespoden' . $i);
						if ($upload['result'] == 'success') {
							$foto = $upload['file']['file_name'];
							array_push($foto_array, $foto);
						} else {
							echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Gagal, pastikan foto berukuran maksimal 5mb dan berformat png, jpg, jpeg. Silakan ulangi lagi'); window.location.href='" . base_url() . "'; </script>");
						}
					}
				}
				// var_dump($foto_array);
				$dataJawabane = $this->m_user->data_survey_temp_all($kode_survey)->result();
				$dtJawabn = '';
				foreach ($dataJawabane as $DTJwb) {
					$dtJawabn .= $DTJwb->tjs_jawaban;
				}

				$data_survey = [
					'js_jawaban' => $dtJawabn,
					'js_foto' => json_encode($foto_array),
					'js_valid' => '1'
				];
				$data_jawaban = [
					'tjs_status' => 1,
				];

				$proda = $this->m_user->update_jawaban($data_survey, $kode_survey);
				$proda2 = $this->m_user->update_jawaban_temp_uploaded($data_jawaban, $kode_survey);

				echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Berhasil'); window.location.href='" . base_url() . "'; </script>");
			} else {
				//echo ("<script LANGUAGE='JavaScript'> window.alert('Input Gambar Gagal, pastikan foto berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi'); window.location.href='".base_url()."'; </script>");
				echo ("<script LANGUAGE='JavaScript'> window.alert('Input Gambar Gagal, pastikan foto berukuran maksimal 5mb dan berformat png, jpg, jpeg. Silakan ulangi lagi'); window.location.href='" . base_url() . "survey/" . $id_survey . "/" . $kode_survey . "/" . $kdseksi . "'; </script>");
			}
		} else {
			//$body = print_r($_POST, true);
			$body = $_POST;
			$no = 0;
			$jawbn = '';
			// print_r($body);exit;
			foreach ($body as $key => $val) {
				
					if (is_int($key) == TRUE) { 
						$dt_pertanyaan = $this->m_user->pertanyaan_by_id($key);

						if($dt_pertanyaan->ps_tipe_pertanyaan == 1){
							$jawbn .= $key . ':';
							$radioValue = '';

							$jawabanString = $dt_pertanyaan->ps_pilihan_jawaban;
							$pilihanJawaban = explode(';', $jawabanString);

							$type = null;
							foreach($pilihanJawaban as $piljab){
								if (trim($piljab) == '') continue;

								$parts = explode(':', $piljab);
								$piljab  = isset($parts[2]) ? trim($parts[2]) : 'default';	

								if(isset($parts[0]) && $parts[0] == $val){
									$type = isset($parts[2]) ? trim($parts[2]) : ''; 
								}
							}

							if($type == 'essai'){
								if (is_array($val)) {
									$radioValue = implode(',', $val);
								} else {
									$radioValue = $val;
								}

								$inputKey = 'input_' . $key;
								if (isset($body[$inputKey]) && trim($body[$inputKey]) != '') {
									$essaiValue = trim($body[$inputKey]);
									// $jawbn .= $radioValue . ',' . $essaiValue;
									$jawbn .= $radioValue . '(' . $essaiValue . ')';
								} else {
									// $jawbn .= $radioValue. ',';
									$jawbn .= $radioValue.'()';
								}
								$jawbn .= ';';
							}else{
									if (is_int($key) == TRUE) {
										$dtary = '';
										if (is_array($val) == TRUE) {
											foreach ($val as $vl) {
												$dtary .= $vl . ',';
											}
											$jawbn .= $dtary;
										} else {
											$jawbn .= $val;
										}
										$jawbn .= ';';
									}
							}
						}elseif($dt_pertanyaan->ps_tipe_pertanyaan == 2){
							$jawbn .= $key . ':';
							foreach ($val as $vl) {
								$checkValue = '';

								$jawabanString = $dt_pertanyaan->ps_pilihan_jawaban;
								$pilihanJawaban = explode(';', $jawabanString);

								$expVl = explode(':', $vl);
								
								$type = null;
								foreach($pilihanJawaban as $piljab){
									if (trim($piljab) == '') continue;
	
									$parts = explode(':', $piljab);

									$piljab  = isset($parts[2]) ? trim($parts[2]) : 'default';	
	
									if(isset($parts[0]) && $parts[0] == $expVl[0]){
										$type = isset($parts[2]) ? trim($parts[2]) : ''; 
									}
								}

								if($type == 'essai'){
									// if (is_array($vl)) {
									// 	$checkValue = implode(',', $vl);
									// } else {
										$checkValue = $expVl[0];
									// }

									// $inputKey = 'input_' . $key;
									// print_r($body);
									// exit;
									
									if (isset($expVl[1]) && trim($expVl[1]) != '') {
										$essaiValue = trim($expVl[1]);
										$jawbn .= $checkValue . '(' . $essaiValue. '),';
									} else {
										$jawbn .= $checkValue. '(),';
									}
									// $jawbn .= ';';
								}else{
									// foreach ($body as $key => $val) {
										// $dta);
										if (is_int($key) == TRUE) {
											// $jawbn .= $key . ':';
											// $dtary = '';
											// if (is_array($val) == TRUE) {
											// 	//print_r($val);
											// 	foreach ($val as $vl) {
											// 		$dtary .= $vl . ',';
											// 	}
											// 	$jawbn .= $dtary;
											// } else {
												$jawbn .= $vl.',';
											// }
											// $jawbn .= ';';
										}
									// }
								}
							}
							$jawbn .= ';';
						}else{
							// foreach ($body as $key => $val) {
								// $dta);
								if (is_int($key) == TRUE) {
									$jawbn .= $key . ':';
									$dtary = '';
									if (is_array($val) == TRUE) {

										foreach ($val as $vl) {
											$dtary .= $vl . ',';
										}
										$jawbn .= $dtary;
									} else {
										$jawbn .= $val;
									}
									$jawbn .= ';';
								}
							// }
						}
					}
			}
			$jum = $this->m_user->cekdata_survey_temp($kode_survey, $kdseksi)->row_array();
			if ($jum['jumsurvey'] > 0) {
				$proda = $this->m_user->update_jawaban_temp(['tjs_jawaban' => $jawbn], $kode_survey, $kdseksi);
			} else {
				$data_insert = ['tjs_survey_id' => $id_survey, 'tjs_gen_id' => $kode_survey, 'tjs_seksi' => $kdseksi, 'tjs_jawaban' => $jawbn, 'tjs_create' => date("Y-m-d H:i:s"), 'tjs_user' => $id_surveyor, 'tjs_status' => 0];
				$proda = $this->m_user->tambah_jawaban_temp($data_insert);
			}

			if ($proda) {
				if ($this->input->is_ajax_request()) {
					header('Content-Type: application/json');
					echo json_encode(['status' => 'success']);
					exit;
				} else {
					$redirect_url = '';
					if (!empty($target_link)) {
						$query = $this->db->query("SELECT b.ss_kode FROM pertanyaan_survey a JOIN seksi_survey b ON a.ps_id_seksi = b.id_seksi WHERE a.ps_kode = ?", [$target_link])->row();
						$seksi_tujuan = $query ? $query->ss_kode : $seksiafter;
						$redirect_url = ($target_link == 'validasi') ? "survey/{$id_survey}/{$kode_survey}/validasi" : "survey/{$id_survey}/{$kode_survey}/{$seksi_tujuan}#{$target_link}";
					} else {
						$redirect_url = "survey/{$id_survey}/{$kode_survey}/{$seksiafter}";
					}
					redirect($redirect_url);
				}
			} else {
				if ($this->input->is_ajax_request()) {
					header('HTTP/1.1 500 Internal Server Error');
					echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data.']);
				} else {
					$this->session->set_flashdata('pesan_error', 'Penyimpanan Data Gagal');
					if ($this->agent && method_exists($this->agent, 'referrer')) {
						$ref = $this->agent->referrer();
						if ($ref) {
							redirect($ref);
						} else {
							redirect('/');
						}
					} else {
						redirect('/');
					}
				}
			}
		}
	}
	
	public function survey($id_survey)
	{
		$c = $this->m_user->cek_detil_survey(['id_survey' => $id_survey]);
		if ($c->num_rows() < 1) {
			# code...
			redirect('');
		}

		//def session siswa
		$data['sess_id'] = $this->session->userdata('id');
		$data['sess_nama'] = $this->session->userdata('nama');

		$whr_cek_detil_tes = ['id_survey' => $id_survey];
		$cek_detil_tes = $this->m_user->cek_detil_survey($whr_cek_detil_tes)->row();
		$data['detil_survey'] = $cek_detil_tes;
		$data['list_seksi'] = $this->m_user->list_seksi_by_survey($id_survey)->result();
		$data['title'] = $cek_detil_tes->nama_survey;


		$this->load->view('_template/header', $data);
		$this->load->view('_template_survey/survey');
		$this->load->view('_template_survey/footer');
	}

	function surveysave($idsurvey)
	{
		$id_surveyor = $this->session->id;

		$id_survey = $this->input->post('id_survey');
		$pewawancara = $this->input->post('pewawancara');
		$pemeriksa = $this->input->post('pemeriksa');
		$koderesponden = $this->input->post('koderesponden');
		$namaresponden = $this->input->post('namaresponden');

		//$body = print_r($_POST, true);
		$body = $_POST;
		$no = 0;
		$jawbn = '';
		foreach ($body as $key => $val) {
			// $dta);
			if (is_int($key) == TRUE) {
				$jawbn .= $key . ':';
				$dtary = '';
				if (is_array($val) == TRUE) {
					//print_r($val);
					foreach ($val as $vl) {
						$dtary .= $vl . ',';
					}
					$jawbn .= $dtary;
				} else {
					$jawbn .= $val;
				}
				$jawbn .= ';';
			}
		}

		$foto_array = array();
		if ($_FILES['fotorespoden1']['name'] != "" || $_FILES['fotorespoden2']['name'] != "" || $_FILES['fotorespoden3']['name'] != "" || $_FILES['fotorespoden4']['name'] != "" || $_FILES['fotorespoden5']['name'] != "") {
			for ($i = 1; $i <= 5; $i++) {
				if ($_FILES['fotorespoden' . $i]['name'] != "") {
					$upload = $this->m_user->uploadImg('fotorespoden' . $i);
					if ($upload['result'] == 'success') {
						$foto = $upload['file']['file_name'];
						array_push($foto_array, $foto);
					} else {
						echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Gagal, pastikan foto berukuran maksimal 5mb dan berformat png, jpg, jpeg. Silakan ulangi lagi'); window.location.href='" . base_url() . "'; </script>");
					}
				}
			}

			// $upload = $this->m_user->uploadImg($this->upload->do_upload('fotorespoden'));

			// if ($upload['result'] == 'success') {
			// 	$foto = $upload['file']['file_name'];

			$data_tmbh_ujian = [
				'js_survey_id' => $id_survey,
				'js_pewawancara' => $pewawancara,
				'js_pemeriksa' => $pemeriksa,
				'js_kode_responden' => $koderesponden,
				'js_nama_responden' => $namaresponden,
				'js_jawaban' => $jawbn,
				'js_foto' => json_encode($foto_array),
				'js_waktu' => date("Y-m-d H:i:s"),
				'js_surveyor' => $id_surveyor,
				'js_pengawas' => '',
				'js_status' => '0'
			];
			$proda = $this->m_user->tambah_jawaban($data_tmbh_ujian);
			//if($proda==TRUE){
			echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Berhasil'); window.location.href='" . base_url() . "'; </script>");
			//}else{
			//echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Gagal s'); window.location.href='".base_url()."'; </script>");
			//}
			// } else {
			// 	echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Gagal, pastikan foto berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi'); window.location.href='" . base_url() . "'; </script>");
			// }
			/*
			    $data = array();


			    */
		} else {

			$data_tmbh_ujian = [
				'js_survey_id' => $id_survey,
				'js_pewawancara' => $pewawancara,
				'js_pemeriksa' => $pemeriksa,
				'js_kode_responden' => $koderesponden,
				'js_nama_responden' => $namaresponden,
				'js_jawaban' => $jawbn,
				'js_waktu' => date("Y-m-d H:i:s"),
				'js_surveyor' => $id_surveyor,
				'js_pengawas' => '',
				'js_status' => '0'
			];
			//$proda=$this->m_user->tambah_jawaban($data_tmbh_ujian); 

			$proda = $this->m_user->tambah_jawaban($data_tmbh_ujian);
			if ($proda) {
				echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Berhasil'); window.location.href='" . base_url() . "'; </script>");
			} else {
				echo ("<script LANGUAGE='JavaScript'> window.alert('Input Survey Gagal'); window.location.href='" . base_url() . "'; </script>");
			}
		}


		//redirect('');
		//echo $jawbn;



		//echo $body;
	}


	//fungsi proses ujian
	function ujian_simpan($id_tes)
	{
		$id_surveyor = $this->session->id;
		$p = json_decode(file_get_contents('php://input'));
		$update_ = '';
		for ($i = 1; $i < $p->jml_soal; $i++) {
			# code...
			$_tjawab = 'opsi_' . $i;
			$_tidsoal = 'id_soal_' . $i;
			$jawaban_ = empty($p->$_tjawab) ? '' : $p->$_tjawab;
			$update_ .= '' . $p->$_tidsoal . ':' . $jawaban_ . ',';
		}
		$update_ = substr($update_, 0, -1);

		$this->db->query("UPDATE ikut_ujian SET list_jawaban='" . $update_ . "' WHERE id_tes='$id_tes' AND id_surveyor='$id_surveyor'");
		echo $this->db->last_query();
		exit;
	}
	function ujian_akhir($id_tes)
	{
		$id_surveyor = $this->session->id;
		$p = json_decode(file_get_contents('php://input'));
		$jumlah_soal = $p->jml_soal;
		$jumlah_benar = 0;
		$update_ = '';

		for ($i = 1; $i < $p->jml_soal; $i++) {
			# code...
			$_tjawab = 'opsi_' . $i;
			$_tidsoal = 'id_soal_' . $i;
			$jawaban_ = empty($p->$_tjawab) ? '' : $p->$_tjawab;
			$cek_jwb = $this->db->query("SELECT jawaban FROM soal WHERE id_soal='" . $p->$_tidsoal . "'")->row();
			if ($cek_jwb->jawaban == $jawaban_) {
				$jumlah_benar++;
			}
			$update_ .= '' . $p->$_tidsoal . ':' . $jawaban_ . ',';
		}
		$update_ = substr($update_, 0, -1);

		$nilai = ($jumlah_benar / ($jumlah_soal - 1)) * 100;
		$this->db->query("UPDATE ikut_ujian SET jml_benar=" . $jumlah_benar . ", nilai='" . $nilai . "', list_jawaban='" . $update_ . "', status='N' WHERE id_tes='$id_tes' AND id_surveyor='$id_surveyor'");
		$a['status'] = 'ok';
		$this->j($a);
		exit;
	}

	public function ujian_selesai($id_tes)
	{
		if ($data['detil_tes'] = $this->m_user->detil_tes(['id_tes' => $id_tes])->num_rows() < 1) {
			redirect('');
		}
		$data['detil_tes'] = $this->m_user->detil_tes(['id_tes' => $id_tes])->row();
		$whr_detil_soal = ['id_ujian' => $data['detil_tes']->id_ujian];
		$data['detil_soal'] = $this->m_user->detil_soal($whr_detil_soal)->row();
		$data['title'] = 'Ujian Selesai';
		$data['judul'] = $data['detil_soal']->mapel;

		$this->load->view('_template_ujian/header', $data);
		$this->load->view('waktu_habis');
		$this->load->view('_template_ujian/footer');
	}

	//Setting
	public function setting()
	{
		$id = ['id_surveyor' => $this->session->id];
		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'Setting';
		$data['judul'] = 'Pengaturan';

		$this->header($data);
		$this->load->view('_template/sidebar');
		$this->load->view('setting');
		$this->load->view('_template/footer');
	}
	function gantipass()
	{
		$password = $this->input->post('passLama');
		$passwordBaru = $this->input->post('konfirPass');

		$whr = ['id_surveyor' => $this->session->id];
		$cek = $this->m_user->cekpass($whr)->row_array();
		if ($password != $cek['password']) {
			# code...
			$this->session->set_flashdata('repass', 'Password lama tidak cocok !');
			redirect('setting');
		} else {
			$data = ['password' => $passwordBaru];
			$this->m_user->gantipass($data, $whr);
			$this->session->set_flashdata('repass', 'Password berhasil diubah');
			redirect('setting');
		}
	}
	function gantiprtnyan()
	{
		$pertanyaan = $this->input->post('pertanyaan');
		$jawaban = $this->input->post('jawaban');
		$kjawaban = $this->input->post('konfirJawaban');
		if (empty($pertanyaan)) {
			$this->session->set_flashdata('reper', 'Pertanyaan belum diisi !');
			redirect('setting');
		}
		if (empty($jawaban) || empty($kjawaban)) {
			$this->session->set_flashdata('reper', 'Jawaban belum diisi !');
			redirect('setting');
		}
		if ($kjawaban != $jawaban) {
			$this->session->set_flashdata('reper', 'Jawaban tidak sama !');
			redirect('setting');
		} else {
			$whr = ['id_surveyor' => $this->session->id];
			$data = [
				'pertanyaan' => $pertanyaan,
				'jawaban' => $jawaban
			];
			$this->m_user->gantipass($data, $whr);
			$this->session->set_flashdata('reper', 'Pertanyaan dan jawaban berhasil diubah');
			redirect('setting');
		}
	}


	//Fungsi tambahan
	public function j($data)
	{
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function survey_list()
	{

		$id = ['id_surveyor' => $this->session->id];
		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'List Survey';
		$data['survey'] = $this->m_user->list_survey_koordinator()->result();

		$this->header($data);
		$this->load->view('_template/sidebar');
		$this->load->view('survey_list');
		$this->load->view('_template/footer');
	}

	public function details()
	{

		$id = ['id_surveyor' => $this->session->id];
		$data['ar'] = $this->m_user->cekdefpass($id)->row_array();
		$data['title'] = 'User Details';
		$data['survey'] = $this->m_user->list_survey_koordinator()->result();

		$this->header($data);
		$this->load->view('_template/sidebar');
		$this->load->view('user_details');
		$this->load->view('_template/footer');
	}

}

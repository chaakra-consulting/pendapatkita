<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_User', 'm_user');
		$this->load->model('M_Survey');
		// $this->load->model('M_Survey');
    }

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data['title'] = 'Pendapat Kita';
		$data['judul'] = 'Dashboard';

		// $data['keyword'] = $this->input->get('keyword');
		// $data['search_result'] = $this->M_Survey->search($data['keyword']);
		$keyword = $this->input->get('keyword');

		if ($keyword) {
			$search_result = $this->M_Survey->search($keyword);
	
			if (!empty($search_result)) {
				$survey = $search_result[0];
				$timestamp = date('dmyHis');
				redirect(base_url("survey/{$survey->id_survey}/{$timestamp}/data"));
				return;
			}
	
			$data['search_result'] = [];
		}
	
		//$whrkelas = ['kelas.kode_kelas' => $this->session->userdata('kelas')];
		//$data['jdwlujian'] = $this->m_user->jadwal_ujian($this->session->id)->result();
		//$data['survey'] = $this->m_user->list_survey_koordinator()->result();

		$this->load->view('layout2/header');
		$this->load->view('home', $data);
		$this->load->view('layout2/footer');


		
	}

	// public function viewSurvey($id_survey)
    // {
    //     $data['survey'] = $this->db->get_where('survey', array('id_survey' => $id_survey))->row();

    //     // Cek apakah survey dengan id tersebut ada atau tidak
    //     if (!$data['survey']) {
    //         show_404();
    //     }

    //     $this->load->view('survey_detail', $data);
    // }

	// public function survey()
	// {
	// 	$data['title'] = 'Pendapat Kita';
	// 	$data['judul'] = 'Dashboard';
	// 	//$whrkelas = ['kelas.kode_kelas' => $this->session->userdata('kelas')];
	// 	//$data['jdwlujian'] = $this->m_user->jadwal_ujian($this->session->id)->result();
	// 	$data['survey'] = $this->m_user->list_survey_koordinator()->result();

	// 	$this->load->view('_template_open_survey/header');
	// 	$this->load->view('_template_open_survey/sidebar');
	// 	$this->load->view('survey');
	// 	$this->load->view('_template_open_survey/footer');
	// }




}

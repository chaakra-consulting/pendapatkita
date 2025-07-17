<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Admin', 'm_admin');
    }

    //index
    public function index(){
        if($this->session->status){
            redirect('');
        }
$this->session->sess_destroy();
        $this->load->view('template/login');
    }
	public function actlogin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hak = $this->input->post('akses');
		$whereguru = array('username' => $username, 'password' => $password);
		$whereadmin = array('username' => $username);
		if($hak == 'admin'){
			$cek = $this->m_admin->login_admin($whereadmin);
			// if($cek->num_rows() > 0){
			// 	$d = $cek->row_array();
			// 	$data = array(
			// 		'id' => $d['id_admin'],
			// 		'nama' => $d['nama'],
			// 		'username' => $d['username'],
			// 		'status' => 'admin'
			// 	);
			// 	$this->session->set_userdata($data);
			// 	redirect('');
			// }
			// else{
			// 	$this->session->set_flashdata('gagal', 'Username / Password salah');
			// 	redirect('login');
			// }
			if ($cek->num_rows() > 0) {
				$d = $cek->row_array();
				//if (password_verify($password, $d['password'])) {
					# data session
					$data = [
						'id' => $d['id_admin'],
						'nama' => $d['nama'],
						'username' => $d['username'],
						'status' => 'admin'
					];
					$this->session->set_userdata($data);
					redirect('');
				/*}
				else{
					$this->session->set_flashdata('gagal', 'Username / Password salah');
					redirect('login');
				}*/
			}
			else{
				$this->session->set_flashdata('gagal', 'Username / Password salah');
				redirect('login');
			}
		}
		if ($hak == 'koordinator') {
			# code...
			$cek = $this->m_admin->login_koordinator($whereguru);
			if ($cek->num_rows() > 0) {
				# code...
				$d = $cek->row_array();
				$data = array(
					'id' => $d['id_koordinator'],
					'nama' => $d['nama'],
					'username' => $d['username'], 
					'survey_aktif' => $d['survey_aktif'], 
					'status' => 'koordinator'
				);
				echo 'aa';
				$this->session->set_userdata($data);
				redirect('');
            }
            else{
				$this->session->set_flashdata('gagal', 'Username / Password salah');
                redirect('login');
            }
		}
	}
	    public function sso_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $appKey = 'pendapatkita';

        $user_app_id = 0;

        if (isset($_POST['user_app_id'])) {
            $user_app_id = $this->input->post('user_app_id');
            $getAdmin = $this->db->where('id_admin', $user_app_id)->get('admin')->row_array();

            $this->session->set_userdata([
                'masuk'   => TRUE,
                'id' => $getAdmin['id_admin'],
                'nama' => $getAdmin['nama'],
                'username' => $getAdmin['username'],
                'status' => 'admin'
            ]);

            return redirect(base_url(''));
        }

        $data = [
            'email' => $email,
            'password' => $password,
            'app_key' => $appKey,
        ];

        $cek_user = $this->post_api('https://loginsso.chaakra-consulting.com/api/UserController/cek_login', $data);

        $getRespon = json_decode($cek_user);

        // Check for API response errors
        if ($getRespon === null || !isset($getRespon->success)) {
            echo json_encode(['success' => false, 'message' => 'API response error']);
            return;
        }

        if ($getRespon->success == true) {
            if ($getRespon->data_app != null) {
                $getAdmin = $this->db->where('id_admin', $getRespon->data_app->user_app_id)->get('admin')->row_array();

                $this->session->set_userdata([
                    'masuk'   => TRUE,
                    'id' => $getAdmin['id_admin'],
                    'nama' => $getAdmin['nama'],
                    'username' => $getAdmin['username'],
                    'status' => 'admin'
                ]);
				$getRespon->redirect = base_url('');
            }
        }
        sleep(1);
        echo json_encode($getRespon);
    }
    function post_api($url, $data)
    {
        // Encode data menjadi JSON
        $postData = http_build_query($data);

        // Inisialisasi cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        // Set Header untuk JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Content-Length: ' . strlen($postData)
        ]);

        // Eksekusi request dan mendapatkan hasilnya
        $response = curl_exec($ch);

        // Cek error saat request
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        // Kembalikan hasil response
        return $response;
    }
}
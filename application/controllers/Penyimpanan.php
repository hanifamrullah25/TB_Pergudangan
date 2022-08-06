<?php
 
class Penyimpanan extends CI_Controller {
	public function __construct() #pake contruck function untuk meload database di controler ini
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$data['title'] = 'Riwayat Transaksi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['penyimpanan'] = $this->Barang_model->getallStorage();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('penyimpanan/index', $data);
		$this->load->view('template/footer');
	}



}
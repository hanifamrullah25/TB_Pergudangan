<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends CI_Controller {
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

		$data['perusahaan2'] = $this->Barang_model->getallKostumer();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('Perusahaan/index', $data);
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Riwayat Transaksi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['kostumer'] = $this->Barang_model->getallKostumer();

		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('sektor', 'Sektor', 'required');

		if($this->form_validation->run() == FALSE ){
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('perusahaan/tambah',$data);
		$this->load->view('template/footer');
		} else {

			$this->Barang_model->tambahDataPerusahaan();
			$this->session->set_flashdata('data', 'Ditambah');
			redirect('perusahaan');
		}


	}

}
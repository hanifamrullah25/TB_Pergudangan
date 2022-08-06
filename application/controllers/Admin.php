<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() #pake contruck function untuk meload database di controler ini
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$data['transaksi'] = $this->Barang_model->getallTransaksi();
		$data['transaksi2'] = $this->Barang_model->getallTransaksi2();
		$data['kostumer'] = $this->Barang_model->getallKostumer();
		$data['barang'] = $this->Barang_model->getAllBarang();

		$data['title'] = 'Riwayat Transaksi';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('template/footer');

	}

	public function tambah()
	{
		$data['kostumer'] = $this->Barang_model->getallKostumer();
		$data['barang'] = $this->Barang_model->getAllBarang();

		$data['title'] = 'Formulir Tambah Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('barang', 'Barang', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|max_length[12]');

		if($this->form_validation->run() == FALSE ){
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/tambah', $data);
		$this->load->view('template/footer');
		} else {

			$this->Barang_model->tambahDataTrnsksi();
			$this->session->set_flashdata('data', 'Ditambah');
			redirect('admin');
		}


	}

	public function ambil()
	{
		$data['kostumer'] = $this->Barang_model->getallKostumer();
		$data['barang'] = $this->Barang_model->getAllBarang();

		$data['title'] = 'Formulir Ambil Barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
		$this->form_validation->set_rules('barang', 'Barang', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|max_length[12]');

		if($this->form_validation->run() == FALSE ){
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('admin/ambil', $data);
		$this->load->view('template/footer');
		} else {

			$this->Barang_model->tambahDataTrnsksi2();
			$this->session->set_flashdata('data', 'Ditambah');
			redirect('admin');
		}


	}

}
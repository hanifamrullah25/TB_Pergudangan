<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->library('form_validation');

	} 

	public function index()
	{
		$jdl['judul'] = 'Riwayat Transaksi';
		$data['transaksi'] = $this->Barang_model->getallTransaksi();
		$data['transaksi2'] = $this->Barang_model->getallTransaksi2();
		$data['kostumer'] = $this->Barang_model->getallKostumer();
		$data['barang'] = $this->Barang_model->getAllBarang();

		$this->load->view('template/header2', $jdl);
		$this->load->view('user/index', $data);
		$this->load->view('template/footer2');
	}

	public function barang()
	{
		$jdl['judul'] = 'Data barang';
		$data['barang'] = $this->Barang_model->getAllBarang();
		if ($this->input->post('cari')) 
		{
			$data['barang'] = $this->Barang_model->cariBarang();
		}
		$this->load->view('template/header2', $jdl);
		$this->load->view('user/barang', $data);
		$this->load->view('template/footer2');
	}

	public function penyimpanan()
	{
		$jdl['judul'] = 'Storage';
		$data['penyimpanan'] = $this->Barang_model->getallStorage();
		$this->load->view('template/header2', $jdl);
		$this->load->view('penyimpanan/index', $data);
		$this->load->view('template/footer2');
	}

	public function detail($no)
	{
		$jdl['judul'] = 'Data barang';
		$data['barang'] = $this->Barang_model->getDetailbyNo($no);
		$this->load->view('template/header2', $jdl);
		$this->load->view('user/detail', $data);
		$this->load->view('template/footer2');
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang2 extends CI_Controller {
	public function __construct() #pake contruck function untuk meload database di controler ini
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$data['barang'] = $this->Barang_model->getAllBarang();

		$data['title'] = 'Data barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if ($this->input->post('cari')) 
		{
			$data['barang'] = $this->Barang_model->cariBarang();
		}
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('barang2/index', $data);
		$this->load->view('template/footer');

	}

	public function tambah()
	{
		$data['title'] = 'Data barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('barang', 'Barang', 'required|max_length[255]');
		$this->form_validation->set_rules('deskripsi', 'Diskripsi', 'required');

		if($this->form_validation->run() == FALSE ){
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('barang2/tambah');
		$this->load->view('template/footer');
		} else {
			$this->Barang_model->tambahDataBrng();
			$this->session->set_flashdata('data', 'Ditambah');
			redirect('barang2');
		}


	}

	public function hapus($no)
	{
		$this->Barang_model->hapusDataBrng($no);
		$this->session->set_flashdata('data', 'Terhapus');
		redirect('barang2');

	}

	public function detail($no)
	{
		$data['title'] = 'Data barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['barang'] = $this->Barang_model->getDetailbyNo($no);

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('barang2/detail', $data);
		$this->load->view('template/footer');
	}

	public function edit($no)
	{
		$data['title'] = 'Data barang';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['barang'] = $this->Barang_model->getDetailbyNo($no);

		$this->form_validation->set_rules('barang', 'Barang', 'required|max_length[255]');
		$this->form_validation->set_rules('deskripsi', 'Diskripsi', 'required');

		if($this->form_validation->run() == FALSE ){
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('barang2/edit', $data);
		$this->load->view('template/footer');
		} else {
			
			$this->Barang_model->editDataBrng();
			$this->session->set_flashdata('data', 'Diedit');
			redirect('barang2');
		}


	}




}
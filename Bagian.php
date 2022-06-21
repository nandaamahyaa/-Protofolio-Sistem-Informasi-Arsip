<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bagian_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['bagian']=$this->Bagian_model->getAllBagian();
		if ($this->input->post('keyword'))
		{
			$data['bagian']= $this->Bagian_model->cariDataBagian();
		}
		$this->load->view('templates/headerbagian');
		$this->load->view('bagian/bagian',$data);
		$this->load->view('templates/footerbagian');
	}
	public function tambah()
	{
		$data['newidBagian']= $this->Bagian_model->getNewIdBagian();
		$data['bagian']=$this->Bagian_model->getAllBagian();
		
		$this->form_validation->set_rules('id_bagian','ID Bagian','required');
		$this->form_validation->set_rules('bagian','Bagian','required');
		
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headerbagian');
					$this->load->view('bagian/bagian',$data);
					$this->load->view('templates/footerbagian');
                }
           else
                {
                    $this->Bagian_model->tambahDataBagian();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('bagian/Bagian');
                }
     }
	public function ubah($id_bagian)
	{
		$this->form_validation->set_rules('id_bagian','ID Bagian','required');
		$this->form_validation->set_rules('bagian','Bagian','required');
		
		$data['bagian']=$this->Bagian_model->getBagianById($id_bagian);
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headerbagian');
					$this->load->view('bagian/ubahbagian',$data);
					$this->load->view('templates/footerbagian');
                }
           else
                {
                    $this->Bagian_model->ubahDataBagian();
					$this->session->set_flashdata('flash','DiUbah');
					redirect('bagian/Bagian');
                }
     }
	 
	 
	
}
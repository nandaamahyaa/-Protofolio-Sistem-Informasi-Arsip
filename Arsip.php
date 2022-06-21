<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Arsip_model');
		$this->load->library('form_validation');
        $this->load->library('pagination');
		//$this->load->library('pdf');
	}

	public function index()
	{
		$data['arsip']=$this->Arsip_model->getDataArsipAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['arsip']= $this->Arsip_model->cariDataDataArsip();
		}
		$this->load->view('templates/headerbagian');
		$this->load->view('arsip/bagian',$data);
		$this->load->view('templates/footerbagian');
		
    }
	public function tambah()
	{
		$data['newidArsip']= $this->Arsip_model->getNewIdArsip();
		
		$data['arsip']=$this->Arsip_model->getArsipAll();
		$data['jenis_arsip']= $this->Arsip_model->getAlljenis_arsip();
		$data['bagian']= $this->Arsip_model->getAllbagian();
		
		$this->form_validation->set_rules('keterangan_arsip','Keterangan Arsip','required');
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headerbagian');
					$this->load->view('arsip/tambahbagian',$data);
					$this->load->view('templates/footerbagian');
                }
           else
                {
                    $this->Arsip_model->tambahDataArsip();
					$this->session->set_flashdata('flash','Ditambahkan');
					redirect('bagian/Arsip');
					
                }
    }
	
	public function ubah($id_arsip)
	{	
		
		$data['arsip']=$this->Arsip_model->getArsipById($id_arsip);
		$data['jenis_arsip']= $this->Arsip_model->getAlljenis_arsip();
		$data['bagian']= $this->Arsip_model->getAllbagian();
		
		$this->form_validation->set_rules('keterangan_arsip','Keterangan Arsip','required');
		if ($this->form_validation->run() == FALSE)
                {
					$this->load->view('templates/headerbagian');
					$this->load->view('arsip/ubahbagian',$data);
					$this->load->view('templates/footerbagian');
                }
           else
                {
					$this->Arsip_model->ubahDataArsip();
					$this->session->set_flashdata('flash','Diubah');
					redirect('bagian/Arsip');
                }
    }
	
	public function hapus ($id_arsip)
	{
		$this->Arsip_model->hapusDataArsip($id_arsip);
		$this->session->set_flashdata('flash','Dihapus');
		redirect('bagian/Arsip');
	}
	 
	public function masuk()
	{
		$data['arsip']=$this->Arsip_model->getArsipAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['arsip']= $this->Arsip_model->cariDataDataArsip();
		}
		$this->load->view('templates/headerbagian');
		$this->load->view('arsip/bagianpilihan',$data);
		$this->load->view('templates/footerbagian');
		
    }
	 
	public function keluar()
	{
		$data['arsip']=$this->Arsip_model->getArsipAll();
		
		
		if ($this->input->post('keyword'))
		{
			$data['arsip']= $this->Arsip_model->cariDataDataArsip();
		}
		$this->load->view('templates/headerbagian');
		$this->load->view('arsip/bagianpilihan',$data);
		$this->load->view('templates/footerbagian');
		
    }
	
	public function cetak(){
		
		$this->load->library('pdf');
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(298,7,'REKAP ARSIP',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(298,7,'Hasil Rekap',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(16,9,'',0,1);
        $pdf->SetFont('Arial','B',12 );
		$pdf->Cell(110,9,'Keterangan Arsip',1,0);
		$pdf->Cell(70,9,'Nama Arsip',1,0);
        $pdf->Cell(55,9,'Bagian',1,0);
        $pdf->Cell(40,9,'Tanggal',1,1);
        $pdf->SetFont('Arial','',10);
		
			$arsip = $this->Arsip_model->getDataArsipAll();
	
        foreach ($arsip  as $row){
			$pdf->Cell(110,9,$row['keterangan_arsip'],1,0);
			$pdf->Cell(70,9,$row['namaarsip'],1,0);
            $pdf->Cell(55,9,$row['bagian'],1,0);
			$pdf->Cell(40,9,$row['tanggal'],1,1);	
		}
        $pdf->Output();
    }
	
	public function cetakpilihan(){
		
		$this->load->library('pdf');
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(298,7,'REKAP ARSIP',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(298,7,'Hasil Rekap',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(16,9,'',0,1);
        $pdf->SetFont('Arial','B',12 );
		$pdf->Cell(110,9,'Keterangan Arsip',1,0);
		$pdf->Cell(70,9,'Nama Arsip',1,0);
        $pdf->Cell(55,9,'Bagian',1,0);
        $pdf->Cell(40,9,'Tanggal',1,1);
        $pdf->SetFont('Arial','',10);
		
		$arsip = $this->Arsip_model->getDataArsipAll();
	
        foreach ($arsip  as $row){
			$pdf->Cell(110,9,$row['keterangan_arsip'],1,0);
			$pdf->Cell(70,9,$row['namaarsip'],1,0);
            $pdf->Cell(55,9,$row['bagian'],1,0);
			$pdf->Cell(40,9,$row['tanggal'],1,1);	
		}
        $pdf->Output();
	}
}
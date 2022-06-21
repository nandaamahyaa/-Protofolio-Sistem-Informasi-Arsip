<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Arsip_model');
		$this->load->library('form_validation');
        $this->load->library('pagination');
		//$this->load->library('pdf');
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
		$kategori = $arsip[namaarsip];
		if($kategori == 'masuk')
		{
			$id = $row["id_jenisarsip"];
			$arsip = $this->Arsip_model->getArsipAll;
			$namaarsip =  '';
			 
		}
		else {
			$arsip = $this->Arsip_model->getDataArsipAll();
		}
        foreach ($arsip  as $row){
			$pdf->Cell(110,9,$row['keterangan_arsip'],1,0);
			$pdf->Cell(70,9,$row['namaarsip'],1,0);
            $pdf->Cell(55,9,$row['bagian'],1,0);
			$pdf->Cell(40,9,$row['tanggal'],1,1);	
		}
        $pdf->Output();
    }
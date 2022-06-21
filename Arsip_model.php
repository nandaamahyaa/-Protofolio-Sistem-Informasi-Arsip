<?php

class Arsip_model extends CI_model {
	
	//model untuk pagination
	//juamlah data arsip
	public function jmlAllArsip()
	{
		$kategori = $this->uri->segment('3');
		
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		$this->db->where('jenis_arsip.jenis_arsip',$kategori);
		return $this->db->get("arsip")->num_rows();
	}
	
	//data arsip
	public function getArsipAll()
	{
		$halamanKe = $this->uri->segment('4') != NULL ? $this->uri->segment('4') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);			
		$kategori = $this->uri->segment('3');
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		$this->db->where('jenis_arsip.namaarsip',$kategori);		
		return $this->db->get('arsip')-> result_array();
	}
	//data arsip print
	public function getArsipPAll()
	{
		$halamanKe = $this->uri->segment('6') != NULL ? $this->uri->segment('5') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);			
		$kategori = $this->uri->segment('4');
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		$this->db->where('jenis_arsip.namaarsip',$kategori);		
		return $this->db->get('arsip')-> result_array();
	}
	//data semua Arsip
	public function getDataArsipAll()
	{
		$halamanKe = $this->uri->segment('4') != NULL ? $this->uri->segment('4') : 1;
		$dataKe = $halamanKe * 30 - 30;
				
		$this->db->limit(30, $dataKe);		
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		
		return $this->db->get('arsip')-> result_array();
	}
	
	public function getCountAllArsip()
	{
		$kategori = $this->uri->segment('3');
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		return $this->db->get('arsip')-> num_rows();
	}
	
	public function getCountAllDataArsip()
	{		
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		
		return $this->db->get('arsip')-> num_rows();
	}
	public function getAlljenis_arsip()
	{
		$this->db->order_by('namaarsip', 'asc');
		$result = $this->db->get('jenis_arsip')->result_array();

		return $result;
	}
	public function getAllbagian()
	{
		$this->db->order_by('bagian', 'asc');
		$result = $this->db->get('bagian')->result_array();

		return $result;
	}

	public function tambahDataArsip()
	{
		$idArsip= $this->input->post('id_arsip', true);
		$data1 = [
				"id_arsip" => $idArsip,
				"keterangan_arsip" => $this->input->post('keterangan_arsip', true),
				"id_bagian" => $this->input->post('bagian', true),
				"id_jenisarsip" => $this->input->post('namaarsip', true),
				"tanggal" => $this->input->post('tanggal', true)
		];
		$this->db->insert('arsip',$data1);   
	}
	public function hapusDataArsip($id_arsip)
	{
		$this->db->delete('arsip',['id_arsip' => $id_arsip]); 
	}
	public function getArsipById($id_arsip)
	{		
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		
		$this->db->where('arsip.id_arsip',$id_arsip);
		return  $this->db->get('Arsip', ['id_arsip' => $id_arsip])->row_array();
	}
	
	public function ubahDataArsip()
	{
		$data= 
		[
				"id_arsip" => $this->input->post('id_arsip', true),
				"keterangan_arsip" => $this->input->post('keterangan_arsip', true),
				"id_bagian" => $this->input->post('bagian', true),
				"id_jenisarsip" => $this->input->post('namaarsip', true),
				"tanggal" => $this->input->post('tanggal', true)
		];
		$this->db->where('id_arsip',$this->input->post('id_arsip'));
		$this->db->update('arsip',$data);
	}
	public function cariDataArsip()
	{
		$kategori = $this->uri->segment('3');
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		
		$keyword = $this->input->post('keyword', true);
		$this->db->where('jenis_arsip.jenis_arsip',$kategori,'both');	
		$this->db->group_start();
		$this->db->like('arsip.keterangan_arsip', $keyword, 'both');
		$this->db->or_like('arsip.tanggal', $keyword, 'both');
		$this->db->or_like('bagian.id_bagian', $keyword, 'both');
		$this->db->or_like('jenis_arsip.id_bagianarsip', $keyword, 'both');
		$this->db->group_end();
		
		return $this->db->get('arsip')->result_array();
	}
public function cariDataDataArsip()
	{
		
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		
		$keyword = $this->input->post('keyword', true);
		
		$this->db->group_start();
		$this->db->like('arsip.keterangan_arsip', $keyword, 'both');
		$this->db->or_like('arsip.tanggal', $keyword, 'both');
		$this->db->or_like('bagian.id_bagian', $keyword, 'both');
		$this->db->or_like('jenis_arsip.id_bagianarsip', $keyword, 'both');
		$this->db->group_end();
		
		return $this->db->get('arsip')->result_array();
	}
	public function getNewIdArsip()
	{
		$q=$this->db->query("SELECT MAX(id_arsip) AS id_max FROM arsip");	
		$kd="PT";
		if  ($q->num_rows()>0 OR $q != 'NULL'){
			foreach ($q->result() as $k) {
				$angka = substr($k->id_max, 7);
				$tmp=(int) $angka+1;
				$kd=sprintf("%04s",$tmp);
			}
	}
		else {
			$kd="0001";
		}
	//date_default_timezone_get();
	return "L-".date ('my')."".$kd;
	}
	public function getArsippilihanByIdJadwal($id_jenisarsip)
	{
		$this->db->where('arsip.id_jenisarsip',$id_jenisarsip);
		$this->db->join('jenis_arsip', 'jenis_arsip.id_jenisarsip = arsip.id_jenisarsip');
		$this->db->join('bagian', 'bagian.id_bagian = arsip.id_bagian');
		$this->db->from('jenis_arsip');
		$this->db->select("arsip.namaarsip");
		return  $this->db->get()->result_array();
	}
}
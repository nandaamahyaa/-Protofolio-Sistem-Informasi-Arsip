<?php

class Teknisi_model extends CI_model {
	public function getAllTeknisi()
	{	
		return $this->db->get('teknisi')-> result_array();
	}

	public function tambahDataTeknisi()
	{
		$data = 
			[
				"id_teknisi" => $this->input->post('id_teknisi', true),
				"nama_teknisi" => $this->input->post('nama_teknisi', true),
				"alamat" => $this->input->post('alamat', true),
				"No_HP" => $this->input->post('No_HP', true)
			];
		$this->db->insert('teknisi',$data);   
	}
	public function getTeknisiById($id_teknisi)
	{
		return  $this->db->get_where('teknisi', ['id_teknisi' => $id_teknisi])->row_array();
	}

	public function hapusDataTeknisi($id_teknisi)
	{
		//$this->db->where('id_teknisi',$id_teknisi); 
		$this->db->delete('teknisi',['id_teknisi' => $id_teknisi]); 
	}

	public function ubahDataTeknisi()
	{
		$data = 
			[
				"id_teknisi" => $this->input->post('id_teknisi', true),
				"nama_teknisi" => $this->input->post('nama_teknisi', true),
				"alamat" => $this->input->post('alamat', true),
				"No_HP" => $this->input->post('No_HP', true)
			];
		$this->db->where('id_teknisi',$this->input->post('id_teknisi'));
		$this->db->update('teknisi',$data);   
	}
		 public function getNewIdTeknisi()
	{
		$q=$this->db->query("SELECT MAX(id_teknisi) AS id_max FROM teknisi");	
		$kd="PT";
		if  ($q->num_rows()>0 OR $q != 'NULL'){
			foreach ($q->result() as $k) {
				$angka = substr($k->id_max, 7);
				$tmp=(int) $angka+1;
				$kd=sprintf("%s",$tmp);
			}
		}
	
		else {
			$kd="1";
		}
		return "T-"."".$kd;
	}
	
	public function cariDataTeknisi()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama_teknisi', $keyword);
		$this->db->or_like('id_teknisi', $keyword);
		$this->db->or_like('alamat', $keyword);
		$this->db->or_like('No_HP', $keyword);
		return $this->db->get('teknisi')->result_array();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homearsip extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('Homearsip_model');
    }

	public function index()
	{
		$this->load->view('templates/headerbagian');
		$this->load->view('home/bagian');
		$this->load->view('templates/footerbagian');
	}
}
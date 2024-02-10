<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$wargas = [];
		$data['countSampleData'] = 12;
		$data['countData'] = 12;
		$data['countDapatBantuan'] = $this->db->select("id")->where("status", 1)->from("wargas_normalized")->get()->num_rows();
		$data['countNonBantuan'] =  $this->db->select("id")->where("status", 0)->from("wargas_normalized")->get()->num_rows();
		

		$data['warga'] = $this->db->get('wargas');
		$data['dapatBantuan'] = $this->db->select(["wargas_normalized.*", "wargas.nama", "wargas.gaji"])
			->where("wargas_normalized.status", 1)
			->from("wargas_normalized")
			->join("wargas", "wargas_normalized.wargas_id = wargas.id", "left")
			->get()->result_array();

		$data['warga'] = [];
		// echo "<pre>";
		$this->load->view('layouts/header');
		$this->load->view('dashboard/index', $data);
		$this->load->view('layouts/footer');
	}
}

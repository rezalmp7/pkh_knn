<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warga extends CI_Controller {

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
	public function index()
	{
		$data['wargas'] = $this->db->get("wargas")->result();
		
		// echo "<pre>";
		// print_r($data);
		$this->load->view('layouts/header');
		$this->load->view('warga/index', $data);
		$this->load->view('layouts/footer');
	}
	public function create() {
		$this->load->view('layouts/header');
		$this->load->view('warga/create');
		$this->load->view('layouts/footer');
	}
	public function store() {
		$post = $this->input->post();

		if(isset($post['pns']) && $post['pns'] == 'on') {
			$is_pns = true;
		} else {
			$is_pns = false;
		}

		if($post['gaji'] >= 5000000) {
			$type_gaji = 1;
		} else {
			$type_gaji = 0;
		}

		$data = array(
			'nama' => $post['nama'],
			'tempat_lahir' => $post['tempat_lahir'],
			'tanggal_lahir' => $post['tanggal_lahir'],
			'alamat' => $post['alamat'],
			'is_pns' => $is_pns,
			'type_gaji' => $type_gaji,
			'gaji' => $post['gaji'],

		);

		$this->db->insert('wargas', $data);

		redirect(base_url('/warga'));
	}
	public function edit($id) {
		$data['warga'] = $this->db->where('id', $id)->get("wargas")->row();

		$this->load->view('layouts/header');
		$this->load->view('warga/edit', $data);
		$this->load->view('layouts/footer');
	}
	public function update($id) {
		$post = $this->input->post();
		$warga = $this->db->get_where('wargas', ['id' => $id])->row();

		if(isset($post['pns']) && $post['pns'] == 'on') {
			$is_pns = true;
		} else {
			$is_pns = false;
		}

		if($post['gaji'] >= 5000000) {
			$type_gaji = 1;
		} else {
			$type_gaji = 0;
		}

		$set = array(
			'nama' => $post['nama'],
			'tempat_lahir' => $post['tempat_lahir'],
			'tanggal_lahir' => $post['tanggal_lahir'],
			'alamat' => $post['alamat'],
			'is_pns' => $is_pns,
			'type_gaji' => $type_gaji,
			'gaji' => $post['gaji'],

		);

		$this->db->set($set);
		$this->db->where('id', $id);
		$this->db->update('wargas'); 

		redirect(base_url('/warga'));
	}
	public function destroy($id) {
		$this->db->where('id', $id)->delete('wargas');
		
		redirect(base_url('/warga'));
	}
}

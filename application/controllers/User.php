<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$data['users'] = $this->db->get("users")->result();
		
		// echo "<pre>";
		// print_r($data);
		$this->load->view('layouts/header');
		$this->load->view('user/index', $data);
		$this->load->view('layouts/footer');
	}
	public function create() {
		$this->load->view('layouts/header');
		$this->load->view('user/create');
		$this->load->view('layouts/footer');
	}
	public function store() {
		$post = $this->input->post();

		$data = array(
			'nama' => $post['nama'],
			'username' => $post['username'],
			'password' => md5($post['password']),
			'level' => $post['level']
		);

		$this->db->insert('users', $data);

		redirect(base_url('/user'));
	}
	public function edit($id) {
		$data['user'] = $this->db->where('id', $id)->get("users")->row();

		$this->load->view('layouts/header');
		$this->load->view('user/edit', $data);
		$this->load->view('layouts/footer');
	}
	public function update($id) {
		$user = $this->db->where('id', $id)->get('users')->row();
		$post = $this->input->post();

		if($post['password'] != '' || $post['password'] != null) {
			$password = md5($post['password']);
		} else {
			$password = $user->password;
		}

		$set = array(
			'nama' => $post['nama'],
			'username' => $post['username'],
			'password' => $password,
			'level' => $post['level']
		);

		$this->db->where('id', $id)->set($set)->update('users');

		redirect(base_url('/user'));
	}
	public function destroy($id) {
		$this->db->where('id', $id)->delete('users');
		
		redirect(base_url('/user'));
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function _construct(){
		parent::_construct();
		$this->load->model("Usuarios_model");
	}
	public function index()
	{
		$this->load->view('admin/login');

	}

	public function login(){
		$username =  $this->input->post(username);
		$password =  $this->input->post(password);
		$res = $this->Usuarios_model->login($username, sha1($password));

		if(!$res) {
			redirect(base_url());
		}
		else{
			$data = array(
				'id' => $res->id,
				'nombre' => $res->nombres,
				'rol' => $res->rol_id,
				'login' => TRUE
			);
			$this->session->set_userdata($data);
			redirect(base_url()."dashboard");
		}
	}
}

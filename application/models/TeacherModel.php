<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherModel extends CI_Model {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function teacherLoginModel($credentials){

		$condition = array('username'=>$credentials['username'],'password_hash'=>$credentials['password']);

		$this->db->where($condition);

		$query = $this->db->get('teacher');

		if($query){

			return $query->result();
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherController extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function teacherLogin()
	{
		$data['result']="";

		if($this->input->post()){

			$username = $this->input->post('email');
			$password = $this->input->post('password');

			$credentials = array(
				'username' => $username,
				'password' => $password
			);

			$data['result'] = $this->teacherModel->teacherLoginModel($credentials);

			$sessdata = array(
				'username' => $data['result'][0]->username,
				'name' => $data['result'][0]->name,
				'logged_in' => TRUE
			);
			
			$this->session->set_userdata($sessdata);

			redirect('dashboard');

		}else {

			$ses = $this->session->userdata('name');
			
			if(isset($ses)){

				redirect('dashboard');
			}else{

				$this->load->view('login');
			}
		}
	}

	public function teacherProfile() {

		$ses = $this->session->userdata('name');
		if(isset($ses)) {

			$this->load->view('dashboard');
		}else {
			redirect('login');
		}
	}

	public function logoutUser() {

		$this->session->unset_userdata('name');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('login');
	}

	public function saveQuestionnaire() {

		if($this->input->post())
		{

			$num_questions = $this->input->post('num_questions');
			$ques_type = $this->input->post('ques_type');
			$questions = $this->input->post('ques');
			$is_timer = $this->input->post('timerselect');
			$answers = "";
			$timerval = 0;
			var_dump($this->input->post());die;
			if($ques_type == 1)
			{
				$answers = $this->input->post('opt');
								
			} elseif ($ques_type == 2) {

				$answers = $this->input->post('truefalse');
			}

			if($is_timer == 1)
			{
				$timerval = $this->input->post('timerval');
			}
			echo "<br>Number of questions :" .$num_questions;
			echo "<br>Question type :" .$ques_type;
			echo "<br>Questions : ";
			foreach ($questions as $key => $value) {
				echo $value;
				echo "<br>";
			}
			echo "<br>istimer : " .$is_timer;
			echo "<br>timervalue : " .$timerval;
			//var_dump($answers);die;
			//var_dump($questions);die;
			//var_dump($this->input->post()); die;
		}
	}
}

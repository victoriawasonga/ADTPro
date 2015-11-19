<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'\libraries\REST_Controller.php');
class Api1 extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function student_get()
	{
		$id=$this->uri->segment(3);//refers to the third segment ie, third one after the servername on the url: http://localhost/API1/api/student/1
		$this->load->model('model_students');
		$student=$this->model_students->get_by(array('id'=> $id));
		if(isset($student['id']))
		{
		$this->response(array('Status'=>'Success','message'=>$student));
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>'Student not found'), 404); 
		}
	}
	function student_put()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_data($this->put());
		if($this->form_validation->run('student_put') !=false)
		{
			die('good data');
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}

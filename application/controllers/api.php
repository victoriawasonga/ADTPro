<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require (APPPATH.'\libraries\REST_Controller.php');
class Api extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_api');
	}
	function patient_get()//Selects from the db
	{
		$id=$this->uri->segment(3);//refers to the third segment ie, third one after the servername on the url: http://localhost/API1/api/student/1
		$this->load->model('model_demographics');
		$patient=$this->model_demographics->get_by(array('id'=>$id));
		if(isset($patient['id']))
		{
		$this->response(array('Status'=>'Success','message'=>$patient));
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>'Patient not found'), 404); 
		}
	}
	function patient_put()//Inserts into the db
	{
		$this->load->library('form_validation');
		$data=remove_unknown_fields($this->put(),$this->form_validation->get_field_names('patient_put'));
		//$this->form_validation->set_data($this->put());
		$this->form_validation->set_data($data);
		if($this->form_validation->run('patient_put') !=false)
		{
			$this->load->model('model_demographics');
			$name_exists=$this->model_demographics->get_by(array('first_name'=>$this->put('first_name')));
			if($name_exists)
			{
				$this->response(array('Status'=>'Failure','message'=>'name already exists'), REST_Controller::HTTP_CONFLICT);
			}
			//$patient=$this->put();
			//$patient_id=$this->model_demographics->insert($patient);
			$patient_id=$this->model_demographics->insert($data);
			if(!$patient_id)
			{
				$this->response(array('Status'=>'Failure','message'=>'Patient not created'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			else
			{
				$this->response(array('Status'=>'Success','message'=>'Patient created'));
			}
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
		}
	}
	function patient_post()//Updates values in the db
	{
		$id=$this->uri->segment(3);//refers to the third segment ie, third one after the servername on the url: http://localhost/API1/api/student/1
		$this->load->model('model_demographics');
		$patient=$this->model_demographics->get_by(array('id'=>$id));
		if(isset($patient['id']))
		{
			$this->load->library('form_validation');
			$data=remove_unknown_fields($this->post(),$this->form_validation->get_field_names('patient_post'));
			$this->form_validation->set_data($data);
			if($this->form_validation->run('patient_post') !=false)
			{
				$this->load->model('model_demographics');
				$safe_name=!isset($data['first_name'])|| $data['first_name']==$patient['first_name']||!$this->model_demographics->get_by(array('first_name'=>$data['first_name']));
				if(!$safe_name)
				{
					$this->response(array('Status'=>'Failure','message'=>'name already in use'), REST_Controller::HTTP_CONFLICT);
				}
				$updated=$this->model_demographics->update($id,$data);
				if(!$updated)
				{
					$this->response(array('Status'=>'Failure','message'=>'Patient not updated'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('Status'=>'Success','message'=>'Patient updated'));
				}
			}
			else
			{
				$this->response(array('Status'=>'Failure','message'=>$this->form_validation->get_errors_as_array()),REST_Controller::HTTP_BAD_REQUEST);
			}
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>'Patient not found'), 404); 
		}
	}
	function patient_delete()//removes values from the db, ie disactivating them
	{
		$id=$this->uri->segment(3);//refers to the third segment ie, third one after the servername on the url: http://localhost/API1/api/student/1
		$this->load->model('model_demographics');
		$patient=$this->model_demographics->get_by(array('id'=>$id));
		if(isset($patient['id']))
		{
		 	$data['active']='0';
			$deleted=$this->model_demographics->update($id,$data);
			if(!$deleted)
				{
					$this->response(array('Status'=>'Failure','message'=>'Patient not deleted'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
				else
				{
					$this->response(array('Status'=>'Success','message'=>'Patient deleted'));
				}
		}
		else
		{
			$this->response(array('Status'=>'Failure','message'=>'Patient is inactive or not on the system'), 404); 
		}
	}
}

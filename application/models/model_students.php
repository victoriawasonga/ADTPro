<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_students extends MY_Model
{
	protected $_table='students';//tablename
	protected $primary_key='id';//primary key
	protected $return_type='array';//return type, can be object or array.
	
	//state an array of functions to call after information is retrieved from the database. It's contained in the MY_Model class.
	protected $after_get=array('remove_sensitive');
	protected function remove_sensitive($student)
	{
		return $patient;
	}
}
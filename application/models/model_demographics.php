<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_demographics extends MY_Model
{
	protected $_table='patient';//tablename - patient
	protected $primary_key='id';//primary key
	protected $return_type='array';//return type, can be object or array.
	
	//state an array of functions to call after information is retrieved from the database. It's contained in the MY_Model class.
	protected $after_get=array('remove_sensitive');
	//protected $before_create=array('prep_data');
	protected function remove_sensitive($patient)
	{
		//unset ($patient['first_name']);
		//unset ($patient['last_name']);
		unset ($patient['medical_record_number']);
		unset ($patient['other_name']);
		unset ($patient['dob']);
		unset ($patient['pob']);
		unset ($patient['physical']);
		unset ($patient['alternate']);
		unset ($patient['adr']);
		unset ($patient['phone']);	
		
		
		//unset ($patient['id']);
		unset ($patient['gender']);
		unset ($patient['pregnant']);
		unset ($patient['weight']);
		unset ($patient['height']);
		unset ($patient['sa']);
		unset ($patient['tb']);
		unset ($patient['smoke']);
		unset ($patient['alcohol']);
		unset ($patient['date_enrolled']);	
		
		unset ($patient['source']);
		unset ($patient['supported_by']);
		unset ($patient['timestamp']);
		unset ($patient['service']);
		unset ($patient['migration_id']);
		unset ($patient['machine_code']);
		unset ($patient['sms_consent']);
		unset ($patient['partner_status']);
		unset ($patient['fplan']);
		unset ($patient['disclosure']);	
		
		unset ($patient['non_commun']);
		unset ($patient['status_change_date']);
		unset ($patient['partner_type']);
		unset ($patient['support_group']);
		unset ($patient['current_regimen']);
		unset ($patient['Start_Regimen_Merged_From']);
		unset ($patient['Current_Regimen_Merged_From']);
		unset ($patient['nextappointment']);
		unset ($patient['start_height']);
		unset ($patient['start_weight']);
		unset ($patient['start_bsa']);
		unset ($patient['transfer_from']);			
		return $patient;
	}
	/*protected function prep_data($patient)
	{
		$patient['password']=md5($patient['password']);
						
		return $patient;
	}*/
}
<?php
//video 009
function remove_unknown_fields($raw_data, $expected_fields)
{
	$new_data=array(); //consists of rows removed from the $raw_data array if they were not found in the $expected_fields array.
	foreach($raw_data as $field_name=>$field_value)
	{
		if($field_value!="" && in_array($field_name,array_values($expected_fields)))
		{
			$new_data[$field_name]=$field_value;
		}
	}
	return $new_data;
}
?>
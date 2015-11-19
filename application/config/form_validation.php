<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config=array(
'patient_put'=>array(
//array('field'=>'email_address','label'=>'email_address','rules'=>'trim|required|valid_email'),
//array('field'=>'password','label'=>'password','rules'=>'trim|required|min_length[8]|max_length[16]'),
array('field'=>'first_name','label'=>'first_name','rules'=>'trim|required|max_length[50]'),
array('field'=>'last_name','label'=>'last_name','rules'=>'trim|required|max_length[50]'),
array('field'=>'other_name','label'=>'other_name','rules'=>'trim|required|max_length[50]'),
array('field'=>'active','label'=>'active','rules'=>'trim|required|max_length[50]'),
//array('field'=>'phone_number','label'=>'phone_number','rules'=>'trim|required|alpha_dash'),
),

//remove the required option to indicate that these fields are optional
'patient_post'=>array(
//array('field'=>'email_address','label'=>'email_address','rules'=>'trim|required|valid_email'),
//array('field'=>'password','label'=>'password','rules'=>'trim|required|min_length[8]|max_length[16]'),
array('field'=>'first_name','label'=>'first_name','rules'=>'trim|max_length[50]'),
array('field'=>'last_name','label'=>'last_name','rules'=>'trim|max_length[50]'),
array('field'=>'other_name','label'=>'other_name','rules'=>'trim|max_length[50]'),
array('field'=>'active','label'=>'active','rules'=>'trim|max_length[50]'),
//array('field'=>'phone_number','label'=>'phone_number','rules'=>'trim|required|alpha_dash'),
),
);
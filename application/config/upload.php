<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Used by the upload class
 */
 
$config['upload_path'] 		= './uploads/';
$config['allowed_types'] 	= 'gif|jpg|png|doc|pdf|docx|xls|xlsx';
$config['file_name']		= '';
$config['overwrite']		= FALSE;
$config['max_size']			= '102400'; //100 MB
$config['max_width']		= 0;
$config['max_height']		= 0;
$config['max_filename']		= 0;
$config['encrypt_name']		= TRUE;
$config['remove_spaces']	= TRUE;

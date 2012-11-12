<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * mithra62 - CT Admin
 *
 * @package		mithra62:Ct_admin
 * @author		Eric Lamb
 * @copyright	Copyright (c) 2011, mithra62, Eric Lamb.
 * @link		http://mithra62.com/projects/view/ct-admin/
 * @since		1.3.2
 * @filesource 	./system/expressionengine/third_party/ct_admin/
 */
 
 /**
 * CT Admin - Mod Class
 *
 * Module class
 *
 * @package 	mithra62:Ct_admin
 * @author		Eric Lamb
 * @filesource 	./system/expressionengine/third_party/ct_admin/mod.ct_admin.php
 */
class Ct_admin_extender {

	public $return_data	= '';
	
	public function __construct()
	{
		$this->EE =& get_instance();
	}
	
	public function void()
	{
		
	}
}
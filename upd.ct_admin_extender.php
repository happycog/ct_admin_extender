<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * mithra62 - CT Admin
 *
 * @package		mithra62:Ct_admin
 * @author		Eric Lamb
 * @copyright	Copyright (c) 2012, mithra62, Eric Lamb.
 * @link		http://mithra62.com/projects/view/ct-admin/
 * @since		1.4.1
 * @filesource 	./system/expressionengine/third_party/ct_admin/
 */
 
 /**
 * CT Admin - Upd Class
 *
 * Updater class
 *
 * @package 	mithra62:Ct_admin
 * @author		Eric Lamb
 * @filesource 	./system/expressionengine/third_party/ct_admin/upd.ct_admin.php
 */
class Ct_admin_extender_upd 
{   
	/**
	 * The extensions we're installing
	 * @var array
	 */
    private $installed_hooks = array(
    	array('method' => 'ct_admin_report', 'hook' => 'ct_admin_custom_reports'),
    	array('method' => 'ct_admin_order_menu_modify', 'hook' => 'ct_admin_modify_order_menu'),
    	array('method' => 'ct_admin_main_menu_modify', 'hook' => 'ct_admin_modify_main_menu'),
    		
    	array('method' => 'ct_admin_order_view', 'hook' => 'ct_admin_order_view'),
    	array('method' => 'ct_admin_order_view_secondary', 'hook' => 'ct_admin_order_secondary_view'),
    	array('method' => 'ct_admin_order_view_tertiary', 'hook' => 'ct_admin_order_tertiary_view'),
    	array('method' => 'ct_admin_customer_menu_modify', 'hook' => 'ct_admin_modify_customer_menu'),
    	array('method' => 'ct_admin_customer_view', 'hook' => 'ct_admin_customer_view'),
    	array('method' => 'ct_admin_customer_view_secondary', 'hook' => 'ct_admin_customer_secondary_view'),
    	array('method' => 'ct_admin_customer_view_tertiary', 'hook' => 'ct_admin_customer_tertiary_view'),
    	array('method' => 'ct_admin_history_report_view', 'hook' => 'ct_admin_history_report_view'),
    	array('method' => 'ct_admin_history_report_secondary_view', 'hook' => 'ct_admin_history_report_secondary_view'),
    	array('method' => 'ct_admin_history_report_tertiary_view', 'hook' => 'ct_admin_history_report_tertiary_view'),
    );
    
    public $name = '';
    
    public $class = '';    
     
    public function __construct() 
    { 
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();
		include PATH_THIRD.'ct_admin_extender/config'.EXT;
		
		$this->version = $config['version'];	
		$this->name = $this->class = $config['mod_class'];
		$this->ext_class = $config['ext_class'];
    } 
    
	public function install() 
	{
		$this->EE->load->dbforge();
	
		$data = array(
			'module_name' => $this->name,
			'module_version' => $this->version,
			'has_cp_backend' => 'y',
			'has_publish_fields' => 'n'
		);
	
		$this->EE->db->insert('modules', $data);
		
		$data = array('class' => $this->name, 'method' => 'void');
		$this->EE->db->insert('actions', $data);
		
		$this->activate_extension();
		
		return TRUE;
	} 
	
	public function activate_extension()
	{
		
		$data = array();
		foreach($this->installed_hooks AS $ext)
		{
			$data[] = array(
						'class'      => $this->ext_class,
						'method'    => $ext['method'],
						'hook'  => $ext['hook'],
						'settings'    => '',
						'priority'    => 1,
						'version'    => $this->version,
						'enabled'    => 'y'
			);	
		}
		
		foreach($data AS $ex)
		{
			$this->EE->db->insert('extensions', $ex);	
		}		
	}

	public function uninstall()
	{
		$this->EE->load->dbforge();
	
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => $this->class));
	
		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');
	
		$this->EE->db->where('module_name', $this->class);
		$this->EE->db->delete('modules');
	
		$this->EE->db->where('class', $this->class);
		$this->EE->db->delete('actions');
		$this->disable_extension();
	
		return TRUE;
	}
	
	public function disable_extension()
	{
		$this->EE->db->where('class', $this->ext_class);
		$this->EE->db->delete('extensions');
	}

	public function update($current = '')
	{
		
		if ($current == $this->version)
		{
			return FALSE;
		}
		
	}	
}
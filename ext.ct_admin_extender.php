<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * mithra62 - CT Admin Extender
 *
 * @package		mithra62:Ct_admin_extender
 * @author		Eric Lamb
 * @copyright	Copyright (c) 2012, mithra62, Eric Lamb.
 * @link		http://mithra62.com/
 * @updated		1.0
 * @filesource 	./system/expressionengine/third_party/ct_admin_extender/
 */
 
 /**
 * CT Admin Extender - Extension
 *
 * Extension class
 *
 * @package 	mithra62:Ct_admin_extender
 * @author		Eric Lamb
 * @filesource 	./system/expressionengine/third_party/ct_admin_extender/ext.ct_admin_extender.php
 */
class Ct_admin_extender_ext 
{
	/**
	 * The extensions default settings
	 * @var array
	 */
	public $settings = array();
	
	/**
	 * The extension name
	 * @var string
	 */
	public $name = '';
	
	/**
	 * The extension version
	 * @var float
	 */
	public $version = '';
	public $description	= '';
	public $settings_exist	= 'n';
	public $docs_url		= '';
	
	public $required_by = array('module');
	

	public $url_base = '';
	public $query_base = '';
	
	/**
	 * The name of the module; used for links and whatnots
	 * @var string
	 */
	private $mod_name = 'ct_admin_extender';	
		
	public function __construct($settings='')
	{
		$this->EE =& get_instance();
		include PATH_THIRD.'ct_admin_extender/config'.EXT;
		
		$this->version = $config['version'];
		$this->name = $config['name'];
				
		$this->settings = (!$settings ? $this->settings : $settings);
		$this->EE->lang->loadfile('ct_admin_extender');
		$this->description = lang('ct_admin_extender_module_description');
		$this->EE->load->add_package_path(PATH_THIRD.'ct_admin_extender/');
		$this->EE->load->add_package_path(PATH_THIRD.'ct_admin/');
		

		$this->query_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->mod_name.AMP.'method=';
		
		if(defined('BASE'))
		{
			$this->url_base = BASE.AMP.$this->query_base;
			$this->EE->cp->set_variable('url_base', $this->url_base);
			$this->EE->cp->set_variable('query_base', $this->query_base);	
		}	
	}

	public function ct_admin_report($report)
	{
		$vars = array();
		$report .= $this->EE->load->view('ct_hook_reports', $vars, TRUE);
		return $report;
	}
	
	public function ct_admin_order_view(array $order_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['order_details'] = $order_details;
		$view .= $this->EE->load->view('ct_hook_order_view', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_order_view_secondary(array $order_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['order_details'] = $order_details;
		$view .= $this->EE->load->view('ct_hook_order_view_secondary', $vars, TRUE);
		return $view;
	}
	
	
	public function ct_admin_order_view_tertiary(array $order_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['order_details'] = $order_details;
		$view .= $this->EE->load->view('ct_hook_order_view_tertiary', $vars, TRUE);
		return $view;
	}
	
	
	public function ct_admin_order_view2(array $order_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['order_details'] = $order_details;
		$view .= $this->EE->load->view('ct_hook_order_view', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_order_menu_modify(array $menu)
	{
		$menu[lang('my_order_page')] = array('target' => '_self', 'url' => $this->url_base.'order_thing'.AMP.'order_id='.$this->EE->input->get('id'));
		return $menu;
	}
	
	public function ct_admin_main_menu_modify($menu)
	{
		$menu[$this->EE->lang->line('my_custom_page')] = $this->url_base.'index';
		return $menu;
	}
	
	public function ct_admin_modify_order_details_block($block, array $order_data)
	{
		$block['devotee_license_key'] = 'devotee_license_key';
		$block['devotee_payment_id'] = 'devotee_payment_id';
		unset($block['order_shipping_option']);
		unset($block['order_shipping']);
		return $block;
	}
	
	public function ct_admin_customer_menu_modify(array $menu, array $customer_data)
	{
		$menu[lang('my_customer_page')] = array('target' => '_self', 'url' => $this->url_base.'customer_page'.AMP.'email='.$this->EE->input->get('email'));
		return $menu;
	}
	
	public function ct_admin_customer_view(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_hook_customer_view', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_customer_view_secondary(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_hook_customer_view_secondary', $vars, TRUE);
		return $view;
	}
	
	
	public function ct_admin_customer_view_tertiary(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_hook_customer_view_tertiary', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_history_report_view(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_admin_history_report_view', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_history_report_secondary_view(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_admin_history_report_view_secondary', $vars, TRUE);
		return $view;
	}
	
	public function ct_admin_history_report_tertiary_view(array $customer_details)
	{
		$view = $this->EE->extensions->last_call;
		$vars = array();
		$vars['customer_details'] = $customer_details;
		$view .= $this->EE->load->view('ct_admin_history_report_view_tertiary', $vars, TRUE);
		return $view;
	}

	public function ct_admin_modify_order_items($order_items)
	{
		$order_items = ($this->EE->extensions->last_call != '' ? $this->EE->extensions->last_call : $order_items);
		return $order_items;
	}
	
	public function activate_extension() 
	{
		return TRUE;
	}
	
	public function update_extension($current = '')
	{
		return TRUE;
	}

	public function disable_extension()
	{
		return TRUE;

	}
}
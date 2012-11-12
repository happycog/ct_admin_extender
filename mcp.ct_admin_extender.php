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
 * Setup the CT Admin CP
 */
$EE =& get_instance();
$EE->load->file(PATH_THIRD . "ct_admin/mcp.ct_admin.php");

 /**
 * CT Admin Extender - CP Class
 *
 * Control Panel class
 *
 * @package 	mithra62:Ct_admin_extender
 * @author		Eric Lamb
 * @filesource 	./system/expressionengine/third_party/ct_admin_extender/mcp.ct_admin_extender.php
 */
class Ct_admin_extender_mcp extends Ct_admin_mcp
{
	/**
	 * The URL to the module
	 * @var string
	 */
	public $url_base = '';
	
	/**
	 * The amount of pagination items per page
	 * @var int
	 */
	public $perpage = 10;
	
	/**
	 * The delimiter for the datatables jquery
	 * @var stirng
	 */
	public $pipe_length = 1;
	
	/**
	 * The name of the module; used for links and whatnots
	 * @var string
	 */
	private $mod_name = 'ct_admin_extender';
	
	/**
	 * The breadcrumb override 
	 * @var array
	 */
	protected static $_breadcrumbs = array();
	
	
	public function __construct()
	{
		$this->EE =& get_instance();
		$this->EE->load->add_package_path(PATH_THIRD.'ct_admin/');
		$this->EE->lang->loadfile('ct_admin');
		parent::__construct(); //load up CT Admin and CartThrob libraries
		$this->add_breadcrumb($this->url_base.'index', lang('ct_admin_module_name'));
		
		//override a couple things now
		$this->ct_admin_url_base = $this->url_base;
		$this->ct_admin_query_base = $this->query_base;
		$this->query_base = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$this->mod_name.AMP.'method=';
		$this->url_base = BASE.AMP.$this->query_base;
		$this->EE->cp->set_variable('ct_admin_url_base', $this->ct_admin_url_base);
		$this->EE->cp->set_variable('ct_admin_query_base', $this->ct_admin_query_base);
		$this->EE->cp->set_variable('url_base', $this->url_base);
		$this->EE->cp->set_variable('query_base', $this->query_base);			
	}

	private function add_breadcrumb($link, $title)
	{
		self::$_breadcrumbs[$link] = $title;
		$this->EE->load->vars(array('cp_breadcrumbs' => self::$_breadcrumbs));
	}	
	
	public function index()
	{
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('my_custom_page'));
		$this->add_breadcrumb($this->url_base.'indrtfex', lang('ct_admin_extender_module_name'));
		//$this->EE->functions->redirect(BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=ct_admin'.AMP.'method=index');
	}	
	
	public function order_thing()
	{
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('my_order_page'));
		$this->add_breadcrumb($this->url_base.'indrtfex', lang('ct_admin_extender_module_name'));		
	}
	
	public function customer_page()
	{
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('my_customer_page'));
		$this->add_breadcrumb($this->url_base.'index', lang('ct_admin_extender_module_name'));		
	}
}
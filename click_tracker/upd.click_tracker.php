<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Website: http://www.cloudmanic.com
//
class Click_Tracker_upd 
{ 
	var $version = '1.0';
	var $module_name	=	'Click_Tracker'; 
  
  //
  // Constructor .....
  //   
	function __construct() 
	{ 
		$this->EE =& get_instance();
	}
	
	//
	// Install this module ...
	//
	function install() 
	{
		$this->EE->load->dbforge();
		
		// Install the module
		$data = array(
		  'module_name' => $this->module_name,
		  'module_version' => $this->version,
		  'has_cp_backend' => 'y',
		  'has_publish_fields' => 'n'
		);
		$this->EE->db->insert('modules', $data);
		
		// Install the action
		$data = array(
			'class'		=> $this->module_name,
			'method'	=> 'track'
		);
		$this->EE->db->insert('actions', $data);
		
		// Install the tables used to track this information
		$cols = array(
		  'id' => array('type' => 'INT', 'constraint' => 9, 'unsigned' => TRUE, 'auto_increment' => TRUE),
		  'source' => array('type' => 'VARCHAR', 'constraint' => '25', 'null' => FALSE),
		  'ip' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => FALSE),
		  'server' => array('type' => 'TEXT', 'null' => FALSE)
		);
		$this->EE->dbforge->add_key('id', TRUE);
		$this->EE->dbforge->add_key('ip');
		$this->EE->dbforge->add_key('source');
		$this->EE->dbforge->add_field($cols);
		$this->EE->dbforge->add_field("created_at TIMESTAMP DEFAULT now() ON UPDATE now()");
		$this->EE->dbforge->create_table('click_tracked', TRUE);
		
		return TRUE;
	}
	
	//
	// Uninstall this module (this mod sucks....)  
	// 
	function uninstall()
	{
		$this->EE->load->dbforge();

		// Toast the module.
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', array('module_name' => $this->module_name));
		
		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');
		
		$this->EE->db->where('module_name', $this->module_name);
		$this->EE->db->delete('modules');
		
		// Toast the action.
		$this->EE->db->where('class', $this->module_name);
		$this->EE->db->delete('actions');
		
		// Toast the tables we created.
		$this->EE->dbforge->drop_table('click_tracked');
		
		return TRUE;
	}
	
	//
	// Upgrade this module (woot woot!! I am bleeding edge)
	//
	function update()
	{
		return FALSE;
	} 
}

/* End File */
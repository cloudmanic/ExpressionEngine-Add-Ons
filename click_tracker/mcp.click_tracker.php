<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Click_Tracker_mcp
{ 
	//
	// Constructor ...
	//
	function __construct()
	{
		$this->EE =& get_instance();
			$this->EE->cp->set_right_nav(array(
			'add_download'	=> BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'
				.AMP.'module=download'.AMP.'method=file_browse'
			));
	}
}

/* End File */
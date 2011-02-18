<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Website: http://www.cloudmanic.com
//
class Click_Tracker 
{
	var $return_data	= '';
	
	//
	// Constructor....
	//
	function __construct()
	{
		$this->EE =& get_instance();
	}
	
	//
	// Track - This is called via the EE actions url request.
	// the name of the source for this url track is collected
	// and then redirected to the correct page in the site.
	//
	function track()
	{
		$redirect = $this->EE->functions->fetch_site_index();
		
		if($this->EE->input->get('s')) 
		{
			if(session_id() == "") {
				session_start(); 
			}
		
			$data['server'] = serialize($_SERVER);
			$data['source'] = $this->EE->input->get('s');	
			
			if(isset($_SERVER['REMOTE_ADDR'])) 
			{
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$this->EE->input->set_cookie('clickip', $_SERVER['REMOTE_ADDR']);
				$_SESSION['clickip'] = $_SERVER['REMOTE_ADDR'];
				$this->EE->functions->set_cookie('clickip', $_SERVER['REMOTE_ADDR']);
			}
			
			$this->EE->db->insert('click_tracked', $data);
			$_SESSION['clicktrack'] = $data['source'];
		}
		
		$this->EE->functions->redirect($redirect);
	}    
}

/* End File */
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Website: http://www.cloudmanic.com
//
class Click_Tracker_mcp
{ 
	private $data = array();
	private $perpage = 50;
	
	//
	// Constructor ...
	//
	function __construct()
	{
		$this->EE =& get_instance();
	}
	
	//
	// Index page for viewing the results.
	//
	function index()
	{
		$this->data['trackurl'] = $this->EE->functions->fetch_site_index(0, 0).QUERY_MARKER . 'ACT=' .
															$this->EE->cp->fetch_action_id('Click_Tracker', 'track') . '&s=sourcename';

		$this->EE->load->library('table');
		$this->EE->load->library('pagination');
		$this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('click_tracker_module_name'));
		
		// Get click track data.
		if(! $rownum = $this->EE->input->get_post('rownum')) { $rownum = 0; }
		$this->EE->db->order_by('created_at DESC');
		$this->data['results'] = $this->EE->db->get('click_tracked', $this->perpage, $rownum);
		$total = $this->EE->db->count_all('click_tracked');
		
		// Pass the relevant data to the paginate class so it can display the "next page" links
		$p_config = $this->pagination_config('index', $total);
		$this->EE->pagination->initialize($p_config);

		$this->data['pagination'] = $this->EE->pagination->create_links();
		return $this->EE->load->view('index', $this->data, TRUE);
	}
	
	//
	// Setup Pagination Config ...
	//
	function pagination_config($method, $total_rows)
	{
		// Pass the relevant data to the paginate class
		$config['base_url'] = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=click_tracker'.AMP.'method='.$method;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $this->perpage;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'rownum';
		$config['full_tag_open'] = '<p id="paginationLinks">';
		$config['full_tag_close'] = '</p>';
		$config['prev_link'] = '<img src="'.$this->EE->cp->cp_theme_url.'images/pagination_prev_button.gif" width="13" height="13" alt="&lt;" />';
		$config['next_link'] = '<img src="'.$this->EE->cp->cp_theme_url.'images/pagination_next_button.gif" width="13" height="13" alt="&gt;" />';
		$config['first_link'] = '<img src="'.$this->EE->cp->cp_theme_url.'images/pagination_first_button.gif" width="13" height="13" alt="&lt; &lt;" />';
		$config['last_link'] = '<img src="'.$this->EE->cp->cp_theme_url.'images/pagination_last_button.gif" width="13" height="13" alt="&gt; &gt;" />';

		return $config;
	}
}

/* End File */
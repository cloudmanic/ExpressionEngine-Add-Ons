<?php
//
// By: Spicer Matthews <spicer@cloudmanic.com>
// Company: Cloudmanic Labs, LLC
// Website: http://www.cloudmanic.com
//
?>

<p style="margin: 15px	0; font-size: 14px;"><b>Your click track url:</b> <?=$trackurl?></p>

<?php 
if($results->num_rows() > 0) : 
	$this->table->set_template($cp_table_template);
	$this->table->set_heading(lang('id'), lang('source'), lang('ip'), lang('timestamp'));
	
	foreach($results->result_array() AS $key => $row)
	{
		$this->table->add_row($row['id'], $row['source'], $row['ip'], $row['created_at']);
	}
	
	echo $this->table->generate();
?>


<div class="tableFooter">
	<div class="tableSubmit"></div>
	<span><?=$pagination?></span>	
	<span class="pagination" id="filter_pagination"></span>
</div>	

<?php else: ?>
<h3><?=lang('no_results')?></h3>
<?php endif; ?>
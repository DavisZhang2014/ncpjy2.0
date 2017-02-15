<?php
require_once(FINAL_ROOT . 'lib/Smarty/Smarty.class.php');
class TemplateSmarty extends Smarty 
{
	function TemplateSmarty($project="",$tpl_dir="")
	{
		
		if($tpl_dir && substr($tpl_dir,0,1) != "/") $tpl_path = __ROOT__ . 'Tpl/' . $tpl_dir;
		$this->project  = $project;
		$this->template_dir = $tpl_path ? $tpl_path : __ROOT__ . 'Tpl';
		$this->compile_dir  = __ROOT__ . 'data/smarty_c/' . $project.'/'.$tpl_dir;
		$this->cache_dir  = __ROOT__ . 'data/smarty_cache/' . $project.'/'.$tpl_dir;
		if(!is_dir($this->compile_dir)) {
			$this->mkdir_and_chmod($this->compile_dir);
		}
		$this->left_delimiter = '<{';
		$this->right_delimiter = '}>';
		if($project == "" && defined("DEBUG_MODE") && DEBUG_MODE == false)
		{
			//for production, we dont check the new tpl, and always use compiled file.
			$this->compile_check = false;
		}
		
		//cache open
		$this->caching = false;
		if($this->caching)
		{
			if(!is_dir($this->cache_dir)) $this->mkdir_and_chmod($this->cache_dir);
		}
		parent::Smarty();
	}
	
	function mkdir_and_chmod($_dir)
	{
		@mkdir($_dir,0777,true);
		@chmod($_dir,0777);
	}
}
?>
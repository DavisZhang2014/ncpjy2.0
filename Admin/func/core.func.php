<?php  
	
	function DBlink(){
		return new Mysql(DB_NAME, DB_HOST, DB_USER, DB_PASS);
	}
<?php

if (!defined('IN_DS')) {
	die('Hacking attempt');
}



// set cache
$cacheFileName = MEM_PREX . 'index';
$objCache = new Cache($cacheFileName);

// if (DEBUG_MODE || isset($_GET['forcerefresh']))
//     $mainContent = '';
// else{
// 	$mainContent = $objCache->getCache();
// 	set_batch_impressions($objCache->getCacheByKey($CpCacheFileName));
// }

$tpl->assign('page_title','首页');
$tpl->display(TPL_PREFIX.'homepage.html');
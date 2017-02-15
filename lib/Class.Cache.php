<?php
if (!defined('IN_DS')) {
	die('Hacking attempt');
}

class Cache
{
	var $cacheDir = '';
	var $cachename = '';
	var $cacheExpSeconds = '';
	var $cacheFile = '';
	var $cacheLogFile = '';
	var $memcache = null;
	
	function Cache($cachename, $cacheDir = '', $cacheExpSeconds = '')
	{
		$this->cacheDir = $cacheDir;
		if (empty($cacheDir))
			$this->cacheDir = MEM_CACHE_LOG;
		
		$this->cacheExpSeconds = MEM_LIFT_TIME;
		if (is_numeric($cacheExpSeconds))
			$this->cacheExpSeconds = $cacheExpSeconds;

		if (defined('MEM_CACHE_SERVER_LIST') && defined('DEBUG_MODE') && DEBUG_MODE === false) {
			$this->memcache = new Memcache;
			$server_port = defined('MEM_CACHE_PORT') ? MEM_CACHE_PORT : 11211;
			$server_list = explode('|', MEM_CACHE_SERVER_LIST);
			foreach($server_list as $server)
			{
				$server = trim($server);
				if(!$server)
					continue;
				
				$this->memcache->addServer($server, $server_port);
			}
		}
	
		if ($this->isKeywordCache($cachename))
			$cachename = $this->getKeywordCacheName($cachename);
		
		$this->cachename = $cachename;
		$this->cacheLogFile = $this->cacheDir . 'cachelog.txt';
	}
		
	function isKeywordCache($cachename) {
		return (substr($cachename,2,9) == "_keyword_");
	}
		
	function getKeywordCacheName($cachename) {
   		$cachename = urlencode(strtolower($cachename));
		
		$pattern = '/[^:0-9a-z\\._-]/';
		$replacement = '_';
		return preg_replace($pattern, $replacement, $cachename);
   	}
   		
	function initialCache() {
		ob_start();
	}

	function endCache($rtnRes = true) {
		$content = ob_get_contents();
		$order   = array("\r\n", "\n", "\r");
		$content=str_replace($order, "", $content);
		$content = preg_replace("/[\s]+/is"," ",$content);
		ob_end_clean();
		$modtimestamp = "<!-- last mod time:".date("Y-m-d H:i:s")." -->\n";
		$rtnRes = $this->setCache($content);
		
// 		if(D_A_B_TEST != 'get_code' && D_A_B_TEST != "" && D_A_B_TEST != null && D_A_B_TEST != "D_A_B_TEST"){
// 			$content = str_replace('class="get_code"','class="'.D_A_B_TEST.'"',$content);
// 		}
		if ($rtnRes)
			return $content;
		else
			return $content;
	}
		
	function setCache(&$content) {
		$rtnRes = true;
		if($this->needCache()) {
			$content_time = time();
			$need_compress = (strlen($content) > 256) ? MEMCACHE_COMPRESSED : false;
			$this->memcache->set($this->cachename . ':' . SID_PREFIX . 'c', $content, $need_compress, $this->cacheExpSeconds) or $rtnRes = false;
			//$this->memcache->set($this->cachename . ':' . SID_PREFIX . 't', $content_time, false, $this->cacheExpSeconds) or $rtnRes = false;
			
			if ($rtnRes)
				$this->setLog('new_cache');
			else
				$this->setLog('new_cache_failed');
		}
	    
		return $rtnRes;
	}
		
	function endCacheByCoupon($rtnRes = true) {
		$content = ob_get_contents();
		ob_end_clean();
		$rtnRes = true;
		if ($this->needCache()) {
			$content_time = time();
			$need_compress = (strlen($content) > 256) ? MEMCACHE_COMPRESSED : false;
			$this->memcache->set($this->cachename . ':' . SID_PREFIX . 'c', $content, $need_compress, $this->cacheExpSeconds + 86400) or $rtnRes = false;
			if($rtnRes)
				$this->setLog('new_coupon_cache');
			else
				$this->setLog('new_coupon_cache_failed');
		}
	    
		if($rtnRes)
			return $content;
		else
			return;
	}

	function needCache() {
		if (!$this->memcache)
			return false;
		
		if(defined('DEBUG_MODE') && DEBUG_MODE === false)
			return true;
		
		return false;
	}
		
	function getCacheTime() {
		if (!$this->memcache)
			return '';
		
		$res = $this->memcache->get($this->cachename . ':' . SID_PREFIX . 't');
		if ($res === false)
			return '';
		
		return $res;
	}
	
	function expireCache() {
		if ($this->getCacheTime()) {
			$this->memcache->delete($this->cachename . ':' . SID_PREFIX . 'c');
			$this->memcache->delete($this->cachename . ':' . SID_PREFIX . 't');
		}
	}
	
   function getCache() {
		if (!$this->memcache)
			return '';
		
		$res = $this->memcache->get($this->cachename . ':' . SID_PREFIX . 'c');
// 		if(D_A_B_TEST != 'get_code' && D_A_B_TEST != "" && D_A_B_TEST != null){
// 			$res = str_replace('class="get_code"','class="'.D_A_B_TEST.'"',$res);
// 		}
		if ($res === false || empty($res)) {
			$this->setLog('miss');
			return '';
		}
		
		$this->setLog('hit');
		return $res;
	}

	function setLog($type) {
		if (CACHE_FUNC_DEBUG_MODE) {
			$logline = date('Y-m-d H:i:s') . "\t{$type}\t" . $this->cachename . "\n";
			error_log($logline, 3, $this->cacheLogFile);
		}
	}
	//根据key设置cache
	function setCacheByKey($key,&$content) {
		$rtnRes = true;
		if($this->needCache()) {
			$content_time = time();
			$need_compress = (strlen($content) > 256) ? MEMCACHE_COMPRESSED : false;
			$this->memcache->set($key . ':' . SID_PREFIX . 'c', $content, $need_compress, $this->cacheExpSeconds) or $rtnRes = false;
			if ($rtnRes)
				$this->setLog('new_cache');
			else
				$this->setLog('new_cache_failed');
		}
		 
		return $rtnRes;
	}
	//根据key获取cache
	function getCacheByKey($key) {
		if (!$this->memcache)
			return '';
		$res = $this->memcache->get($key . ':' . SID_PREFIX . 'c');
		if ($res === false || empty($res)) {
			$this->setLog('miss');
			return '';
		}
		
		$this->setLog('hit');
		return $res;
	}
}
?>

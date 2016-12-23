<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if (!defined('IN_TG'))		//防止恶意调用
	{
		exit('非法调用');
	}
	mysql_close();
?>
<div id="footer">
<p>本程序执行耗时为：<?php echo round((_runtime()- START_TIME),4);?>秒</p>
<p>版权所有	翻版必究</p>
<p><span>本程序有*****提供 </span></p>
</div>
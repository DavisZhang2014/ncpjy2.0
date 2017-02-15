<?php /* Smarty version 2.6.26, created on 2017-02-14 06:18:44
         compiled from ../Public/menu.html */ ?>
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->        
	<ul class="page-sidebar-menu">
		<li>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler hidden-phone"></div>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		</li>

		<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<?php if ($this->_tpl_vars['item']['selected'] == 'yes'): ?>
				<li class="start active ">
					<a href="<?php echo $this->_tpl_vars['__APP__']; ?>
/<?php echo $this->_tpl_vars['item']['Code']; ?>
">
					<i class="icon-briefcase"></i> 
					<span class="title"><?php echo $this->_tpl_vars['item']['DisplayName']; ?>
</span>
					<span class="selected"></span>
					</a>
				</li>
			<?php else: ?>
				<li class=" ">
					<a href="<?php echo $this->_tpl_vars['__APP__']; ?>
/<?php echo $this->_tpl_vars['item']['Code']; ?>
">
					<i class="icon-briefcase"></i> 
					<span class="title"><?php echo $this->_tpl_vars['item']['DisplayName']; ?>
</span>
					<span class="arrow"></span>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
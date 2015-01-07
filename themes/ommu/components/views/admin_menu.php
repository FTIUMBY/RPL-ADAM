<?php
	if($module == null && in_array($controller, array('admin'))) {
		$dashboard = 'class="active"';
		$title = 'Mainmenu';
		
	} elseif($module != null && $module == 'project') {
		$project = 'class="active"';
		$title = 'Mainmenu';
		
	} elseif($module != null && $module == 'kanban') {
		$kanban = 'class="active"';
		$title = 'Mainmenu';
		
	} elseif($module != null && $module == 'users') {
		$member = 'class="active"';
		$title = 'Mainmenu';
		
	} elseif($module == null && in_array($controller, array('settings','theme','globaltag','contentmenu'))) {
		$settings = 'class="active"';
		$title = 'Mainmenu';
	}
?>

<?php //begin.Main Menu ?>
<div class="mainmenu">
	<ul>
		<li <?php echo $dashboard; ?>><a class="dashboard" href="<?php echo Yii::app()->createUrl('admin/index');?>" title="Dashboard">Dashboard</a></li>
		<li <?php echo $project; ?>><a class="content" href="<?php echo Yii::app()->createUrl('project/admin/manage');?>" title="Project">Project</a></li>
		<li <?php echo $kanban; ?>><a class="content" href="<?php echo Yii::app()->createUrl('kanban/task/manage');?>" title="Kanban">Kanban</a></li>
		<li <?php echo $member; ?>><a class="member" href="<?php echo Yii::app()->createUrl('users/member/manage');?>" title="User">User</a></li>
		<li <?php echo $settings; ?>><a class="setting" href="<?php echo Yii::app()->createUrl('settings/general');?>" title="Setting">Setting</a></li>
	</ul>
</div>
<?php //end.Main Menu ?>

<?php //begin.Submenu ?>
<div class="submenu">
	<h3><?php echo $title;?></h3>
	<ul>
		<?php if($module == null && in_array($controller, array('admin'))) {?>
		
		<li <?php echo $currentAction == 'admin/dashboard' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('admin/dashboard');?>" title="Summary">Summary</a></li>
		
		<?php } elseif($module != null && $module == 'project') {?>
		
		<li <?php echo in_array($controller, array('admin','team','media','tag','like')) ? 'class="submenu-show"' : '' ?>><a <?php echo $controller == 'admin' ? 'class="active"' : '' ?> href="<?php echo Yii::app()->createUrl('project/admin/manage');?>" title="View Projects">View Projects</a>
			<ul>
				<li <?php echo $controller == 'team' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/team/manage');?>" title="Team"><span class="icons">C</span>Team</a></li>
				<li <?php echo $controller == 'media' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/media/manage');?>" title="Photo"><span class="icons">C</span>Photo</a></li>
				<li <?php echo $controller == 'tag' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/tag/manage');?>" title="Tags"><span class="icons">C</span>Tags</a></li>
				<li <?php echo $controller == 'like' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/like/manage');?>" title="Like"><span class="icons">C</span>Like</a></li>
			</ul>
		</li>
		<li <?php echo $controller == 'client' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/client/manage');?>" title="Client">Client</a></li>
		<li <?php echo $controller == 'setting' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('project/setting/index');?>" title="Settings">Settings</a></li>
		
		<?php } elseif($module != null && $module == 'kanban') {?>
		
		<li <?php echo in_array($controller, array('backlog','task','subtask','comment')) ? 'class="submenu-show"' : '' ?>><a <?php echo $controller == 'backlog' ? 'class="active"' : '' ?> href="<?php echo Yii::app()->createUrl('kanban/backlog/index');?>" title="Backlog">Backlog</a>
			<ul>
				<li <?php echo $controller == 'task' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/task/manage');?>" title="Task"><span class="icons">C</span>Task</a></li>
				<li <?php echo $controller == 'subtask' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/subtask/manage');?>" title="Subtask"><span class="icons">C</span>Subtask</a></li>
				<li <?php echo $controller == 'comment' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/comment/manage');?>" title="Comment"><span class="icons">C</span>Comment</a></li>
			</ul>
		</li>
		<li <?php echo $controller == 'division' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/division/manage');?>" title="Division">Division</a></li>
		<li <?php echo $controller == 'user' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/user/manage');?>" title="Users">Users</a></li>
		<li <?php echo $controller == 'setting' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('kanban/setting/index');?>" title="Setting">Setting</a></li>
		
		<?php } elseif($module != null && $module == 'users') {?>
		
		<li <?php echo $controller == 'member' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/member/manage');?>" title="Members">Members</a></li>
		<li <?php echo $controller == 'level' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/level/manage');?>" title="User Level">User Level</a></li>
		<li <?php echo $controller == 'history' ? 'class="submenu-show"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/history/login');?>" title="History">History</a>
			<ul>
				<li <?php echo $currentAction == 'history/login' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/history/login');?>" title="Login"><span class="icons">C</span>Login</a></li>
				<li <?php echo $currentAction == 'history/email' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/history/email');?>" title="Email"><span class="icons">C</span>Email</a></li>
				<li <?php echo $currentAction == 'history/password' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('users/history/password');?>" title="Password"><span class="icons">C</span>Password</a></li>
			</ul>
		</li>
		
		<?php } elseif($module == null && in_array($controller, array('settings','theme','globaltag','contentmenu'))) {?>
		
		<li <?php echo $currentAction == 'settings/general' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/general');?>" title="General Settings">General Settings</a></li>
		<li <?php echo $currentAction == 'settings/banned' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/banned');?>" title="Spam & Banning Tools">Spam & Banning Tools</a></li>
		<li <?php echo $currentAction == 'settings/locale' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/locale');?>" title="Locale Settings">Locale Settings</a></li>
		<li <?php echo $controller == 'theme' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('theme/manage');?>" title="Theme Settings">Theme Settings</a></li>
		<li <?php echo $currentAction == 'settings/analytic' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('settings/analytic');?>" title="Google Analytics Settings">Google Analytics Settings</a></li>
		<li <?php echo $controller == 'globaltag' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('globaltag/manage');?>" title="Tags">Tags</a></li>
		<li <?php echo $controller == 'contentmenu' ? 'class="selected"' : '' ?>><a href="<?php echo Yii::app()->createUrl('contentmenu/manage');?>" title="Content Menu">Content Menu</a></li>
		
		<?php }?>
	</ul>
</div>
<?php //end.Submenu ?>
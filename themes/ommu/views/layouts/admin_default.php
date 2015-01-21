<?php $this->beginContent('//layouts/default');
	Yii::import('webroot.themes.'.Yii::app()->theme->name.'.components.*');
	$module = strtolower(Yii::app()->controller->module->id);
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	$currentAction = strtolower(Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	$currentModule = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id);
	$currentModuleAction = strtolower(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id);
	if($module == null) {
		if($currentAction == 'site/login') {
			$class = 'login';
		} else {
			$class = $controller;
		}
	} else {
		if(in_array($currentModule, array('users/forgot','users/verify'))) {
			$class = 'login';
		} else if($controller == 'admin') {
			$class = $module;
		} else if($module == 'kanban') {
			$class = $module;
		} else {
			$class = $module.'-'.$controller;
		}
	}
?>
<?php if($currentModuleAction != 'kanban/backlog/board') {?>
	<div id="<?php echo $class;?>" <?php echo $this->dialogDetail == true ? (!empty($this->dialogWidth) ? 'class="boxed"' : 'class="clearfix"') : 'class="clearfix"';?>>
		<?php if($this->dialogDetail == false) {
			if ($currentAction != 'site/login') {?>
			<?php //begin.Title ?>
			<h1 class="small"><?php echo CHtml::encode($this->pageTitle); ?></h1>
			<?php echo $this->pageDescription != OmmuSettings::getInfo('site_description') ? '<p class="intro">'.$this->pageDescription.'</p>' : '';?>
			<?php //end.Title ?>

			<?php //begin.Content Menu ?>
			<div class="contentmenu clearfix">
				<?php $this->widget('AdminContentMenu'); ?>
				<?php $this->widget('application.components.system.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'gridmenu clearfix'),
				)); ?>
			</div>
			<?php //end.Content Menu ?>
		<?php }
		}
		
		//If Dialog
		if($this->dialogDetail == true && !empty($this->dialogWidth)) {?>
			<?php //begin.Dialog Header ?>
			<div class="dialog-header">
				<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
			</div>
			<?php //end.Dialog Header ?>
		<?php } else {
			if($module == 'kanban' && $controller == 'backlog') {
				if($action == 'add') {?>
					<div class="dialog-header">
						<h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
					</div>				
				<?php } else if(in_array($action, array('edit','subtask','comment'))) {?>
					<div class="dialog-tab">
						<ul class="clearfix">
							<li <?php echo (in_array($action, array('edit'))) ? 'class="selected"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('edit', array('taskid'=>$_GET['taskid'], 'pid'=>$_GET['pid']));?>" title="Task">Task</a></li>
							<li <?php echo (in_array($action, array('subtask'))) ? 'class="selected"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('subtask', array('taskid'=>$_GET['taskid'], 'pid'=>$_GET['pid']));?>" title="Subtask">Subtask</a></li>
							<li <?php echo (in_array($action, array('comment'))) ? 'class="selected"' : '';?>><a href="<?php echo Yii::app()->controller->createUrl('comment', array('taskid'=>$_GET['taskid'], 'pid'=>$_GET['pid']));?>" title="Comment">Comment</a></li>
						</ul>
					</div>
				<?php }
			}
		}?>
		
		<?php echo $content; ?>
	</div>
<?php } else {
	echo $content;
}?>

<?php $this->endContent(); ?>
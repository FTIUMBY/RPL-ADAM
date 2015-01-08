<?php
/**
 * Kanban Tasks (kanban-tasks)
 * @var $this TaskController * @var $model KanbanTasks *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

	$this->breadcrumbs=array(
		'Kanban Tasks'=>array('manage'),
		'Create',
	);
?>

<div class="dialog-content" id="subtask-comment">
	<?php $this->widget('application.components.system.FListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view_subtask',
		'pager' => array(
			'header' => '',
		), 
		'summaryText' => '',
		'itemsCssClass' => 'items clearfix',
		'pagerCssClass'=>'pager clearfix',
	)); ?>
	
	<?php $form=$this->beginWidget('application.components.system.OActiveForm', array( 
		'id'=>'kanban-task-sub-form', 
		'enableAjaxValidation'=>true, 
		//'htmlOptions' => array('enctype' => 'multipart/form-data') 
	)); ?>
		<fieldset>
			<?php 
			$model->task_id = $_GET['taskid'];
			echo $form->hiddenField($model,'task_id'); ?>
			<div class="table">
				<?php echo $form->textArea($model,'subtask_name',array('rows'=>6, 'cols'=>50, 'class'=>'span-11 smaller')); ?>
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('onclick' => 'setEnableSave()')); ?>
			</div>
			<?php echo $form->error($model,'subtask_name'); ?>
		</fieldset> 
	<?php $this->endWidget(); ?>	
</div>
<div class="dialog-submit">
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
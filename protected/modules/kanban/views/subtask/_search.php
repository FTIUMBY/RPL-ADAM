<?php
/**
 * Kanban Task Subs (kanban-task-sub)
 * @var $this SubtaskController * @var $model KanbanTaskSub * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<ul>
		<li>
			<?php echo $model->getAttributeLabel('subtask_id'); ?><br/>
			<?php echo $form->textField($model,'subtask_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('done_status'); ?><br/>
			<?php echo $form->textField($model,'done_status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('task_id'); ?><br/>
			<?php echo $form->textField($model,'task_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subtask_name'); ?><br/>
			<?php echo $form->textArea($model,'subtask_name',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('action_date'); ?><br/>
			<?php echo $form->textField($model,'action_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('action_by'); ?><br/>
			<?php echo $form->textField($model,'action_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

<?php
/**
 * Kanban Tasks (kanban-tasks)
 * @var $this TaskController * @var $model KanbanTasks * @var $form CActiveForm
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
			<?php echo $model->getAttributeLabel('task_id'); ?><br/>
			<?php echo $form->textField($model,'task_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('project_id'); ?><br/>
			<?php echo $form->textField($model,'project_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('cat_id'); ?><br/>
			<?php echo $form->textField($model,'cat_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('division_id'); ?><br/>
			<?php echo $form->textField($model,'division_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('user_id'); ?><br/>
			<?php echo $form->textField($model,'user_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('number'); ?><br/>
			<?php echo $form->textField($model,'number'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('current_action'); ?><br/>
			<?php echo $form->textField($model,'current_action',array('size'=>60,'maxlength'=>64)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('task_name'); ?><br/>
			<?php echo $form->textField($model,'task_name',array('size'=>60,'maxlength'=>64)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('task_desc'); ?><br/>
			<?php echo $form->textArea($model,'task_desc',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('priority'); ?><br/>
			<?php echo $form->textField($model,'priority'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('due_date'); ?><br/>
			<?php echo $form->textField($model,'due_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('reschedule_date'); ?><br/>
			<?php echo $form->textField($model,'reschedule_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('overtime'); ?><br/>
			<?php echo $form->textField($model,'overtime'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('overtime_date'); ?><br/>
			<?php echo $form->textField($model,'overtime_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('task_status'); ?><br/>
			<?php echo $form->textField($model,'task_status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('progress_date'); ?><br/>
			<?php echo $form->textField($model,'progress_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('progress_by'); ?><br/>
			<?php echo $form->textField($model,'progress_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('done_date'); ?><br/>
			<?php echo $form->textField($model,'done_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('done_by'); ?><br/>
			<?php echo $form->textField($model,'done_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('tested_date'); ?><br/>
			<?php echo $form->textField($model,'tested_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('tested_by'); ?><br/>
			<?php echo $form->textField($model,'tested_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('tested_status'); ?><br/>
			<?php echo $form->textField($model,'tested_status'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('tested_verified'); ?><br/>
			<?php echo $form->textField($model,'tested_verified'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subtask'); ?><br/>
			<?php echo $form->textField($model,'subtask'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('subtask_done'); ?><br/>
			<?php echo $form->textField($model,'subtask_done'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('comment'); ?><br/>
			<?php echo $form->textField($model,'comment'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_date'); ?><br/>
			<?php echo $form->textField($model,'creation_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('creation_by'); ?><br/>
			<?php echo $form->textField($model,'creation_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('updated_date'); ?><br/>
			<?php echo $form->textField($model,'updated_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('updated_by'); ?><br/>
			<?php echo $form->textField($model,'updated_by',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
	<div class="clear"></div>
<?php $this->endWidget(); ?>

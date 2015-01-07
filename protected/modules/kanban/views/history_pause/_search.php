<?php
/**
 * Kanban Task History Pauses (kanban-task-history-pause)
 * @var $this HistorypauseController * @var $model KanbanTaskHistoryPause * @var $form CActiveForm
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
			<?php echo $model->getAttributeLabel('pause_id'); ?><br/>
			<?php echo $form->textField($model,'pause_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('task_id'); ?><br/>
			<?php echo $form->textField($model,'task_id',array('size'=>11,'maxlength'=>11)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('pause_date'); ?><br/>
			<?php echo $form->textField($model,'pause_date'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('pause_condition'); ?><br/>
			<?php echo $form->textArea($model,'pause_condition',array('rows'=>6, 'cols'=>50)); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('unpause_date'); ?><br/>
			<?php echo $form->textField($model,'unpause_date'); ?>
		</li>

		<li class="submit">
			<?php echo CHtml::submitButton('Search'); ?>
		</li>
	</ul>
<?php $this->endWidget(); ?>

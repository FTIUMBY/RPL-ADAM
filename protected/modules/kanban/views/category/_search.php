<?php
/**
 * Kanban Task Categories (kanban-task-category)
 * @var $this CategoryController * @var $model KanbanTaskCategory * @var $form CActiveForm
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
			<?php echo $model->getAttributeLabel('cat_id'); ?><br/>
			<?php echo $form->textField($model,'cat_id'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('publish'); ?><br/>
			<?php echo $form->textField($model,'publish'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('name'); ?><br/>
			<?php echo $form->textField($model,'name'); ?>
		</li>

		<li>
			<?php echo $model->getAttributeLabel('desc'); ?><br/>
			<?php echo $form->textField($model,'desc'); ?>
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

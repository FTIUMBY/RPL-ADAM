<?php
/**
 * Kanban Task Comments (kanban-task-comment)
 * @var $this CommentController * @var $model KanbanTaskComment * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-task-comment-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<div class="dialog-content">

	<fieldset>

		<?php //begin.Messages ?>
		<div id="ajax-message">
			<?php echo $form->errorSummary($model); ?>
		</div>
		<?php //begin.Messages ?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'task_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'task_id',array('maxlength'=>11)); ?>
				<?php echo $form->error($model,'task_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'user_id'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'user_id',array('maxlength'=>11)); ?>
				<?php echo $form->error($model,'user_id'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'comment'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($model,'comment'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'creation_date'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'creation_date'); ?>
				<?php echo $form->error($model,'creation_date'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

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

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-task-history-pause-form',
	'enableAjaxValidation'=>true,
	//'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>

<?php //begin.Messages ?>
<div id="ajax-message">
	<?php echo $form->errorSummary($model); ?>
</div>
<?php //begin.Messages ?>

<fieldset>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'task_id'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'task_id',array('size'=>11,'maxlength'=>11)); ?>
			<?php echo $form->error($model,'task_id'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'pause_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->pause_date != '0000-00-00' ? $model->pause_date = date('d-m-Y', strtotime($model->pause_date)) : '') : '';
			//echo $form->textField($model,'pause_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'pause_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'pause_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'pause_condition'); ?>
		<div class="desc">
			<?php echo $form->textArea($model,'pause_condition',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'pause_condition'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'unpause_date'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->unpause_date != '0000-00-00' ? $model->unpause_date = date('d-m-Y', strtotime($model->unpause_date)) : '') : '';
			//echo $form->textField($model,'unpause_date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'unpause_date',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'unpause_date'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="submit clearfix">
		<label>&nbsp;</label>
		<div class="desc">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('onclick' => 'setEnableSave()')); ?>
		</div>
	</div>

</fieldset>
<?php /*
<div class="dialog-content">
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
*/?>
<?php $this->endWidget(); ?>



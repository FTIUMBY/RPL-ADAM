<?php
/**
 * Kanban User Divisions (kanban-user-division)
 * @var $this DivisionController * @var $model KanbanUserDivision * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-user-division-form',
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
			<?php echo $form->labelEx($model,'parent'); ?>
			<div class="desc">
				<?php if(KanbanUserDivision::getDivision() != null) {
					echo $form->dropDownList($model,'parent', KanbanUserDivision::getDivision(), array('prompt'=>'No Parent'));
				} else {
					echo $form->dropDownList($model,'parent', array(0=>'No Parent'));
				}?>
				<?php echo $form->error($model,'parent'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'name',array('maxlength'=>32,'class'=>'span-8')); ?>
				<?php echo $form->error($model,'name'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'desc'); ?>
			<div class="desc">
				<?php echo $form->textArea($model,'desc',array('maxlength'=>128,'class'=>'span-11 smaller')); ?>
				<?php echo $form->error($model,'desc'); ?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'management'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'management'); ?>
				<?php echo $form->labelEx($model,'management'); ?>
				<?php echo $form->error($model,'management'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'tested'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'tested'); ?>
				<?php echo $form->labelEx($model,'tested'); ?>
				<?php echo $form->error($model,'tested'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'verified'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'verified'); ?>
				<?php echo $form->labelEx($model,'verified'); ?>
				<?php echo $form->error($model,'verified'); ?>
				<?php /*<div class="small-px silent"></div>*/?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'publish'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'publish'); ?>
				<?php echo $form->labelEx($model,'publish'); ?>
				<?php echo $form->error($model,'publish'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

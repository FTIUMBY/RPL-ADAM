<?php
/**
 * Users (users)
 * @var $this MemberController * @var $model Users * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'users-form',
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
		
		<?php if(!$model->isNewRecord) {?>
		<div class="intro">
			To edit this users's account, make changes to the form below. If you want to temporarily prevent this user from logging in, you can set the user account to "disabled" below.
		</div>
		<?php }?>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'level_id'); ?>
			<div class="desc">
				<?php echo $form->dropDownList($model,'level_id', UserLevel::getLevel()); ?>
				<?php echo $form->error($model,'level_id'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'username'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'username',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'email'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'email',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'new_password'); ?>
			<div class="desc">
				<?php echo $form->passwordField($model,'new_password',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'new_password'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'first_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'first_name',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'first_name'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'last_name'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'last_name',array('maxlength'=>32)); ?>
				<?php echo $form->error($model,'last_name'); ?>
			</div>
		</div>

		<?php if(!$model->isNewRecord) {?>
		<div class="clearfix">
			<?php echo $form->labelEx($model,'displayname'); ?>
			<div class="desc">
				<?php echo $form->textField($model,'displayname',array('maxlength'=>64)); ?>
				<?php echo $form->error($model,'displayname'); ?>
			</div>
		</div>
		<?php }?>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'enabled'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'enabled'); ?>
				<?php echo $form->labelEx($model,'enabled'); ?>
				<?php echo $form->error($model,'enabled'); ?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'verified'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'verified'); ?>
				<?php echo $form->labelEx($model,'verified'); ?>
				<?php echo $form->error($model,'verified'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>



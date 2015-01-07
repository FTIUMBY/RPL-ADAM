<?php
/**
 * Kanban Users (kanban-users)
 * @var $this UserController * @var $model KanbanUsers * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'kanban-users-form',
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
			<?php echo $form->labelEx($model,'division_id'); ?>
			<div class="desc">
				<?php if(KanbanUserDivision::getDivision() != null) {
					echo $form->dropDownList($model,'division_id', KanbanUserDivision::getDivision());
				} else {
					echo $form->dropDownList($model,'division_id');
				}?>
				<?php echo $form->error($model,'division_id'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'user_input'); ?>
			<div class="desc">
				<?php
				//echo $form->textField($model,'user_input',array('maxlength'=>32));
				$model->user_input = $model->user->displayname;
				$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $model,
					'attribute' => 'user_input',
					'source' => Yii::app()->controller->createUrl('suggest'),
					'options' => array(
						//'delay '=> 50,
						'minLength' => 1,
						'showAnim' => 'fold',
						'select' => "js:function(event, ui) {
							$('#KanbanUsers_user_id').val(ui.item.id);
						}"
					),
					'htmlOptions' => array(
						'class' => 'span-7',
						'maxlength'=>32,
					),
				));
				echo $form->hiddenField($model,'user_id');
				echo $form->error($model,'user_input');
				?>
			</div>
		</div>

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'status'); ?>
			<div class="desc">
				<?php echo $form->checkBox($model,'status'); ?>
				<?php echo $form->labelEx($model,'status'); ?>
				<?php echo $form->error($model,'status'); ?>
			</div>
		</div>

	</fieldset>
</div>
<div class="dialog-submit">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save' ,array('onclick' => 'setEnableSave()')); ?>
	<?php echo CHtml::button('Close', array('id'=>'closed')); ?>
</div>
<?php $this->endWidget(); ?>

<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
	'id'=>'ommu-settings-form',
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
		<?php echo $form->labelEx($model,'site_creation'); ?>
		<div class="desc">
			<?php
			!$model->isNewRecord ? ($model->site_creation != '0000-00-00' ? $model->site_creation = date('d-m-Y', strtotime($model->site_creation)) : '') : '';
			//echo $form->textField($model,'site_creation');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'=>$model,
				'attribute'=>'site_creation',
				//'mode'=>'datetime',
				'options'=>array(
					'dateFormat' => 'dd-mm-yy',
				),
				'htmlOptions'=>array(
					'class' => 'span-4',
				 ),
			)); ?>
			<?php echo $form->error($model,'site_creation'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_dateformat'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_dateformat',array('maxlength'=>8)); ?>
			<?php echo $form->error($model,'site_dateformat'); ?>
			<?php /*<div class="small-px silent"></div>*/?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'site_timeformat'); ?>
		<div class="desc">
			<?php echo $form->textField($model,'site_timeformat',array('maxlength'=>8)); ?>
			<?php echo $form->error($model,'site_timeformat'); ?>
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
<?php $this->endWidget(); ?>
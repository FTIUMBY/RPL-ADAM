<?php
/**
 * @var $this LocaleController
 * @var $model OmmuLocale
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contact (+62)856-299-4114
 *
 */
 
	$this->breadcrumbs=array(
		'Ommu Locales'=>array('manage'),
		'Create',
	);
?>

<div class="form" name="post-on">
	<?php $form=$this->beginWidget('application.components.system.OActiveForm', array(
		'id'=>'ommu-locale-form',
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
			<?php echo $form->labelEx($model,'default_locale'); ?>
			<div class="desc">
				<?php 
				$model->default_locale = OmmuLocale::getDefault();
				echo $form->dropDownList($model,'default_locale', OmmuLocale::getLocale()); ?>
				<?php echo $form->error($model,'default_locale'); ?>
			</div>
		</div>

		<div class="clearfix">
			<?php echo $form->labelEx($model,'timezone'); ?>
			<div class="desc">
				<?php 
				$model->timezone = OmmuTimezone::getDefault();
				echo $form->dropDownList($model,'timezone', OmmuTimezone::getTimezone()); ?>
				<?php echo $form->error($model,'timezone'); ?>
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
</div>

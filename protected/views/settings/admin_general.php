<?php
/**
 * Ommu Settings (ommu-settings)
 * @var $this SettingsController * @var $model OmmuSettings * @var $form CActiveForm
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2014 Ommu Platform (ommu.co)
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */
 
	$this->breadcrumbs=array(
		'Ommu Settings'=>array('manage'),
		'Manage',
	);
	$cs = Yii::app()->getClientScript();
$js=<<<EOP
	$('#OmmuSettings_online input[name="OmmuSettings[online]"]').live('change', function() {
		var id = $(this).val();
		if(id == '0') {
			$('div#construction').slideDown();
		} else {
			$('div#construction').slideUp();
		}
	});
EOP;
	$cs->registerScript('smtp', $js, CClientScript::POS_END);
?>

<div class="form" name="post-on">

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

		<div class="clearfix publish">
			<?php echo $form->labelEx($model,'online'); ?>
			<div class="desc">
				<span class="small-px">Maintenance Mode will prevent site visitors from accessing your website. You can customize the maintenance mode page by manually editing the file "/application/maintenance.html".</span>
				<?php echo $form->radioButtonList($model, 'online', array(
					1 => 'Online',
					0 => 'Offline (Maintenance Mode)',
				)); ?>
				<?php echo $form->error($model,'online'); ?>
			</div>
		</div>
		
		<div id="construction" <?php echo $model->online != '0' ? 'class="hide"' : ''; ?>>
			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('construction_date');?> <span class="required">*</span></label>
				<div class="desc">
					<?php
					!$model->isNewRecord ? ($model->construction_date != '0000-00-00' ? $model->construction_date = date('d-m-Y', strtotime($model->construction_date)) : '') : '';
					//echo $form->textField($model,'construction_date');
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model,
						'attribute'=>'construction_date',
						//'mode'=>'datetime',
						'options'=>array(
							'dateFormat' => 'dd-mm-yy',
						),
						'htmlOptions'=>array(
							'class' => 'span-3',
						 ),
					)); ?>
					<?php echo $form->error($model,'construction_date'); ?>
				</div>
			</div>

			<div class="clearfix">
				<label><?php echo $model->getAttributeLabel('construction_text')?> <span class="required">*</span></label>
				<div class="desc">
					<?php echo $form->textArea($model,'construction_text',array('rows'=>6, 'cols'=>50, 'class'=>'span-9 small')); ?>
					<?php echo $form->error($model,'construction_text'); ?>
				</div>
			</div>			
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('construction_twitter')?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'construction_twitter',array('maxlength'=>32, 'class'=>'span-4')); ?>
				<?php echo $form->error($model,'construction_twitter'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_title');?> <span class="required">*</span><br/>
				<span>Give your community a unique name. This will appear in the &lt;title&gt; tag throughout most of your site.</span>
			</label>
			<div class="desc">
				<?php echo $form->textField($model,'site_title',array('maxlength'=>256, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'site_title'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label><?php echo $model->getAttributeLabel('site_url')?> <span class="required">*</span></label>
			<div class="desc">
				<?php echo $form->textField($model,'site_url',array('maxlength'=>32, 'class'=>'span-5')); ?>
				<?php echo $form->error($model,'site_url'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_description');?> <span class="required">*</span><br/>
				<span>Enter a brief, concise description of your community. Include any key words or phrases that you want to appear in search engine listings.</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'site_description',array('rows'=>6, 'cols'=>50, 'class'=>'span-9', 'maxlength'=>256)); ?>
				<?php echo $form->error($model,'site_description'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('site_keywords');?> <span class="required">*</span><br/>
				<span>Provide some keywords (separated by commas) that describe your community. These will be the default keywords that appear in the tag in your page header. Enter the most relevant keywords you can think of to help your community's search engine rankings.</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'site_keywords',array('rows'=>6, 'cols'=>50, 'class'=>'span-9', 'maxlength'=>256)); ?>
				<?php echo $form->error($model,'site_keywords'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>Date Format <span class="required">*</span></label>
			<div class="desc">
				<?php 
				$dateformat = "1986-08-11 16:25:50";
				echo $form->dropDownList($model,'site_dateformat', array(
					'n/j/Y' => date('n/j/Y', strtotime($dateformat)),
					'n-j-Y' => date('n-j-Y', strtotime($dateformat)),
					'm/j/Y' => date('m/j/Y', strtotime($dateformat)),
					'm-j-Y' => date('m-j-Y', strtotime($dateformat)),		
					'Y/n/j' => date('Y/n/j', strtotime($dateformat)),
					'Y-n-j' => date('Y-n-j', strtotime($dateformat)),
					'Y/m/j' => date('Y/m/j', strtotime($dateformat)),
					'Y-m-d' => date('Y-m-d', strtotime($dateformat)),
					'j/n/Y' => date('j/n/Y', strtotime($dateformat)),
					'j-n-Y' => date('j-n-Y', strtotime($dateformat)),
					'j/m/Y' => date('j/m/Y', strtotime($dateformat)),
					'j-m-Y' => date('j-m-Y', strtotime($dateformat)),
					'Y-F-j' => date('Y-F-j', strtotime($dateformat)),
					'j-F-Y' => date('j-F-Y', strtotime($dateformat)),
					'Y-M-j' => date('Y-M-j', strtotime($dateformat)),
					'j-M-Y' => date('j-M-Y', strtotime($dateformat)),
					'F j, Y' => date('F j, Y', strtotime($dateformat)),
					'j F Y' => date('j F Y', strtotime($dateformat)),
					'M. j, Y' => date('M. j, Y', strtotime($dateformat)),
					'j M Y' => date('j M Y', strtotime($dateformat)),
					'l, F j, Y' => date('l, F j, Y', strtotime($dateformat)),
					'l j F Y' => date('l j F Y', strtotime($dateformat)),
					'D j F Y' => date('D j F Y', strtotime($dateformat)),
					'D j M Y' => date('D j M Y', strtotime($dateformat)),
				)); ?>
				<?php 
				echo $form->dropDownList($model,'site_timeformat', array(
					'g:i A' => date('g:i A', strtotime($dateformat)),
					'h:i A' => date('h:i A', strtotime($dateformat)),
					'g:i' => date('g:i', strtotime($dateformat)),
					'h:i' => date('h:i', strtotime($dateformat)),
					'H:i' => date('H:i', strtotime($dateformat)),
					'H\hi' => date('H\hi', strtotime($dateformat)),
				)); ?>
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
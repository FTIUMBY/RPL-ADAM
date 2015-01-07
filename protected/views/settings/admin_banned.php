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

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('banned_ips');?>
				<span>To ban users by their IP address, enter their address into the field below. Addresses should be separated by commas, like 123.456.789.123, 23.45.67.89</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'banned_ips',array('rows'=>6, 'cols'=>50, 'class'=>'span-10')); ?>
				<?php echo $form->error($model,'banned_ips'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('banned_emails');?>
				<span>To ban users by their email address, enter their email into the field below. Emails should be separated by commas, like user1@domain1.com, user2@domain2.com. Note that you can ban all email addresses with a specific domain as follows: *@domain.com</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'banned_emails',array('rows'=>6, 'cols'=>50, 'class'=>'span-10')); ?>
				<?php echo $form->error($model,'banned_emails'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('banned_usernames');?>
				<span>Enter the usernames that are not permitted on your social network. Usernames should be separated by commas, like username1, username2</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'banned_usernames',array('rows'=>6, 'cols'=>50, 'class'=>'span-10')); ?>
				<?php echo $form->error($model,'banned_usernames'); ?>
			</div>
		</div>

		<div class="clearfix">
			<label>
				<?php echo $model->getAttributeLabel('banned_words');?>
				<span>Enter any words that you you want to censor on your users' profiles as well as any plugins you have installed. These will be replaced with asterisks (*). Separate words by commas like word1, word2</span>
			</label>
			<div class="desc">
				<?php echo $form->textArea($model,'banned_words',array('rows'=>6, 'cols'=>50, 'class'=>'span-10')); ?>
				<?php echo $form->error($model,'banned_words'); ?>
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